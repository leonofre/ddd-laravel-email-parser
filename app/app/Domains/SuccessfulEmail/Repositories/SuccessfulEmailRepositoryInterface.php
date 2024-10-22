<?php

namespace App\Domains\SuccessfulEmail\Repositories;

use App\Domains\SuccessfulEmail\Entities\SuccessfulEmail;

interface SuccessfulEmailRepositoryInterface {
    public function findById(int $id): ?SuccessfulEmail;
    public function save(SuccessfulEmail $successfulEmail): SuccessfulEmail;
    public function getAll(): array;
    public function update(int $id, array $data): SuccessfulEmail;
    public function delete(int $id): bool;
}
