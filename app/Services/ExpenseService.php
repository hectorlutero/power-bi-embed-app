<?php

namespace App\Services;

use App\DTO\StoreExpenseDTO;
use App\DTO\UpdateExpenseDTO;
use App\Mail\ExpenseStored;
use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use stdClass;

class ExpenseService
{
    protected ExpenseRepositoryInterface $expenseRepository;
    public function __construct(ExpenseRepositoryInterface $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        return [];
    }
    public function getAll(?string $filter = null): array
    {
        $filter = $filter ?? '';
        $expenses = $this->expenseRepository->getAll($filter);
        return $expenses;
    }

    public function getById(int $id): Expense | null
    {
        $expense = $this->expenseRepository->getById($id);
        return $expense ? (object) $expense : null;
    }

    public function create(StoreExpenseDTO $dto): Expense
    {
        $expense = $this->expenseRepository->create($dto);
        if (!$expense)
            Log::error('Expense is null.');

        Mail::to(auth()->user()->email)->send(new ExpenseStored($expense));

        return $expense; // Return the expense
    }

    public function update($data, int $id): Expense
    {
        $expense = $this->expenseRepository->update($data, $id);
        return (object) $expense;
    }

    public function delete(int $id): bool
    {
        return $this->expenseRepository->delete($id);
    }
}
