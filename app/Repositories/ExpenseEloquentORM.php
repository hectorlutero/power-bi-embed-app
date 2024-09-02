<?php

namespace App\Repositories;

use App\DTO\StoreExpenseDTO;
use App\Models\Expense;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use Illuminate\Support\Facades\Log;
use stdClass;

class ExpenseEloquentORM implements ExpenseRepositoryInterface
{
    public function __construct(
        protected Expense $expense,
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        return [];
    }

    public function getAll(string $filter = null): array
    {
        $expenses = $this->expense->with('user')->where(function ($query) use ($filter) {
            if ($filter) {
                $query->where('description', 'like', "%$filter%");
                $query->orWhere('title', 'like', "%$filter%");
            }
            $query->where('user_id', 'like', auth()->user()->id);
        })->get()->toArray();

        return $expenses;
    }

    public function getById(int $id): Expense | null
    {
        $expense = $this->expense->with('user')->where('id', $id)->first();
        return $expense;
    }

    public function create(StoreExpenseDTO $dto): Expense
    {
        $expense = $this->expense->create((array) $dto);
        return $expense;
    }

    public function update(array $data, int $id): Expense | null
    {
        $expense = $this->expense->find($id);
        $expense->update((array) $data);
        return (object) $expense;
    }

    public function delete(int $id): bool
    {
        $expense = $this->expense->where('id', $id)->first();
        if (!$expense)
            return false;

        $expense->delete();
        return true;
    }
}
