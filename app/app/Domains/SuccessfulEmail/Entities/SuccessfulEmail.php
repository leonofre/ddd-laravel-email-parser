<?php

namespace App\Domains\SuccessfulEmail\Entities;

class SuccessfulEmail {
    private int $id;
    private int $affiliate_id;
    private string $envelope;
    private string $from;
    private string $subject;
    private ?string $dkim;
    private ?string $spf;
    private float $spamScore;
    private string $email;
    private string $senderIp;
    private string $to;
    private int $timestamp;
    private ?string $rawText;

    public function __construct(int $id, int $affiliate_id, string $envelope, string $from, string $subject, ?string $dkim, ?string $spf, float $spamScore, string $email, string $senderIp, string $to, int $timestamp, ?string $rawText = null) {
        $this->id = $id;
        $this->affiliate_id = $affiliate_id;
        $this->envelope = $envelope;
        $this->from = $from;
        $this->subject = $subject;
        $this->dkim = $dkim;
        $this->spf = $spf;
        $this->spamScore = $spamScore;
        $this->email = $email;
        $this->senderIp = $senderIp;
        $this->to = $to;
        $this->timestamp = $timestamp;
        $this->rawText = $rawText;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getAffiliateId(): int {
        return $this->affiliate_id;
    }

    public function getEnvelope(): string {
        return $this->envelope;
    }

    public function getFrom(): string {
        return $this->from;
    }

    public function getSubject(): string {
        return $this->subject;
    }

    public function getDkim(): ?string {
        return $this->dkim;
    }

    public function getSpf(): ?string {
        return $this->spf;
    }

    public function getSpamScore(): float {
        return $this->spamScore;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getSenderIp(): string {
        return $this->senderIp;
    }

    public function getTo(): string {
        return $this->to;
    }

    public function getTimestamp(): int {
        return $this->timestamp;
    }

    public function getRawText(): string|null {
        return $this->rawText;
    }

    // Setters
    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setAffiliateId(string $affiliate_id): void {
        $this->affiliate_id = $affiliate_id;
    }

    public function setEnvelope(string $envelope): void {
        $this->envelope = $envelope;
    }

    public function setFrom(string $from): void {
        $this->from = $from;
    }

    public function setSubject(string $subject): void {
        $this->subject = $subject;
    }

    public function setDkim(?string $dkim): void {
        $this->dkim = $dkim;
    }

    public function setSpf(?string $spf): void {
        $this->spf = $spf;
    }

    public function setSpamScore(float $spamScore): void {
        $this->spamScore = $spamScore;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setSenderIp(string $senderIp): void {
        $this->senderIp = $senderIp;
    }

    public function setTo(string $to): void {
        $this->to = $to;
    }

    public function setTimestamp(int $timestamp): void {
        $this->timestamp = $timestamp;
    }

    public function setRawText(string $rawText): void {
        $this->rawText = $rawText;
    }

    public function toArray(): array {
        return [
            'affiliate_id' => $this->getId(),
            'envelope' => $this->getEnvelope(),
            'from' => $this->getFrom(),
            'subject' => $this->getSubject(),
            'dkim' => $this->getDkim(),
            'SPF' => $this->getSpf(),
            'spam_score' => $this->getSpamScore(),
            'email' => $this->getEmail(),
            'raw_text' => $this->getRawText(),
            'sender_ip' => $this->getSenderIp(),
            'to' => $this->getTo(),
            'timestamp' => $this->getTimestamp(),
        ];
    }
}
