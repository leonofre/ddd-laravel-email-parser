<?php

namespace App\Infrastructure\Persistence\Repositories;

use App\Domains\SuccessfulEmail\Entities\SuccessfulEmail;
use App\Domains\SuccessfulEmail\Repositories\SuccessfulEmailRepositoryInterface;
use App\Models\SuccessfulEmail as SuccessfulEmailModel;

class EloquentSuccessfulEmailRepository implements SuccessfulEmailRepositoryInterface {
    public function findById(int $id): SuccessfulEmail {
        $emailModel = SuccessfulEmailModel::findOrFail($id);

        return $this->getEntity($emailModel);
    }

    public function save(SuccessfulEmail $successfulEmail): SuccessfulEmail {
        $emailModel = new SuccessfulEmailModel();
        $emailModel->affiliate_id = $successfulEmail->getAffiliateId();
        $emailModel->envelope = $successfulEmail->getEnvelope();
        $emailModel->from = $successfulEmail->getFrom();
        $emailModel->subject = $successfulEmail->getSubject();
        $emailModel->dkim = $successfulEmail->getDkim();
        $emailModel->spf = $successfulEmail->getSpf();
        $emailModel->spam_score = $successfulEmail->getSpamScore();
        $emailModel->email = $successfulEmail->getEmail();
        $emailModel->sender_ip = $successfulEmail->getSenderIp();
        $emailModel->to = $successfulEmail->getTo();
        $emailModel->timestamp = $successfulEmail->getTimestamp();
        $emailModel->raw_text = $successfulEmail->getRawText();
        $emailModel->save();

        $successfulEmail->setId($emailModel->id);
        $successfulEmail->setRawText($emailModel->raw_text);

        return $successfulEmail;
    }

    public function getAll(): array {
        return SuccessfulEmailModel::all()->toArray();
    }

    public function update(int $id, array $data): SuccessfulEmail {
        $emailModel = SuccessfulEmailModel::findOrFail($id);

        $emailModel->update([
            'affiliate_id' => $data['affiliate_id'],
            'envelope' => $data['envelope'],
            'from' => $data['from'],
            'subject' => $data['subject'],
            'dkim' => $data['dkim'],
            'spf' => $data['spf'],
            'spam_score' => $data['spam_score'],
            'email' => $data['email'],
            'sender_ip' => $data['sender_ip'],
            'to' => $data['to'],
            'timestamp' => $data['timestamp'],
            'raw_text' => isset($data['raw_text']) ? $data['raw_text'] : null,
        ]);

        return $this->getEntity($emailModel);
    }

    public function delete(int $id): bool {
        return SuccessfulEmailModel::destroy($id);
    }

    private function getEntity(SuccessfulEmailModel $emailModel): SuccessfulEmail {
        return new SuccessfulEmail(
            $emailModel->id,
            $emailModel->affiliate_id,
            $emailModel->envelope,
            $emailModel->from,
            $emailModel->subject,
            $emailModel->dkim,
            $emailModel->spf,
            $emailModel->spam_score,
            $emailModel->email,
            $emailModel->sender_ip,
            $emailModel->to,
            $emailModel->timestamp,
            $emailModel->raw_text
        );
    }
}
