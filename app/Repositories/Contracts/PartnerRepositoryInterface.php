<?php

namespace App\Repositories\Contracts;

use App\DTO\StorePartnerDTO;
use App\Models\Partner;
use stdClass;

interface PartnerRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array;
    public function getAll(string $filter): array;
    public function getById(int $id): Partner | null;
    public function create(StorePartnerDTO $dto): Partner;
    public function update(array $data, int $id): Partner | null;
    public function delete(int $id): bool;
}
