<?php

namespace App\Repositories\Contracts;

use App\DTO\StoreExpenseDTO;
use App\DTO\UpdateExpenseDTO;
use App\Models\Expense;
use stdClass;

interface ExpenseRepositoryInterface
{
    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array;
    public function getAll(string $filter): array;
    public function getById(int $id): Expense | null;
    public function create(StoreExpenseDTO $dto): Expense;
    public function update(array $data, int $id): Expense | null;
    public function delete(int $id): bool;
}
