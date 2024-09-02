<?php

namespace App\Repositories\Contracts;

use App\DTO\StoreContractDTO;
use App\Models\Contract;

interface ContractRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array;
    public function getAll(string $filter): array;
    public function getById(int $id): Contract|null;
    public function create(StoreContractDTO $dto): Contract;
    public function update(array $data, int $id): Contract|null;
    public function delete(int $id): bool;
}
