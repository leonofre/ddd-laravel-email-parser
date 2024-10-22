<?php

namespace App\Domains\SuccessfulEmail\Services;

use App\Domains\SuccessfulEmail\Entities\SuccessfulEmail;
use App\Domains\SuccessfulEmail\Repositories\SuccessfulEmailRepositoryInterface;
use Exception;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SuccessfulEmailService {
    private SuccessfulEmailRepositoryInterface $successfulEmailRepository;

    public function __construct(SuccessfulEmailRepositoryInterface $successfulEmailRepository) {
        $this->successfulEmailRepository = $successfulEmailRepository;
    }

    public function createEmail(array $data): SuccessfulEmail {
        $validatedData = $this->validateStoreData($data);

        $successfulEmail = new SuccessfulEmail(
            0,
            $validatedData['affiliate_id'],
            $validatedData['envelope'],
            $validatedData['from'],
            $validatedData['subject'],
            $validatedData['dkim'],
            $validatedData['spf'],
            $validatedData['spam_score'],
            $validatedData['email'],
            $validatedData['sender_ip'],
            $validatedData['to'],
            $validatedData['timestamp'],
            isset($validatedData['raw_text']) ? $validatedData['raw_text'] : null,
        );

        return $this->successfulEmailRepository->save($successfulEmail);
    }

    public function updateEmail(int $id, array $data): SuccessfulEmail|false {
        $validatedData = $this->validateStoreData($data);
        try {
            $email = $this->successfulEmailRepository->update($id, $data);
        } catch(Exception $e) {
            return false;
        }

        return $email;
    }

    public function getById(int $id): ?SuccessfulEmail
    {
        return $this->successfulEmailRepository->findById($id);
    }

    public function delete(int $id): bool
    {
        try {
            $this->successfulEmailRepository->findById($id);
        } catch(Exception $e) {
            return false;
        }
        return $this->successfulEmailRepository->delete($id);
    }

    public function getAll(): array
    {
        return $this->successfulEmailRepository->getAll();
    }

    public function validateStoreData(array $data): array
    {
        return validator($data, [
            'affiliate_id' => 'required|integer',
            'envelope' => 'required|string',
            'from' => 'required|string|max:255',
            'subject' => 'required|string',
            'dkim' => 'nullable|string|max:255',
            'spf' => 'nullable|string|max:255',
            'spam_score' => 'nullable|numeric',
            'email' => 'required|string',
            'sender_ip' => 'nullable|string|max:50',
            'to' => 'required|string',
            'timestamp' => 'required|integer',
            'raw_text' => 'nullable|string',
        ])->validate();
    }
}
