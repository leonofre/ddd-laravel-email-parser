<?php

namespace App\Domains\User\Entities;

class User
{
    private int $id;
    private string $name;
    private string $email;
    private string $password;
    private ?string $token;

    public function __construct(int $id, string $name, string $email, string $password, ?string $token = null) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->token = $token;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getToken(): ?string {
        return $this->token;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function setToken(string $token): void {
        $this->token = $token;
    }
}