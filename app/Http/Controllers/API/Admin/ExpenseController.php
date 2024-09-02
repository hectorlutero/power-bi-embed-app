<?php

namespace App\Http\Controllers\API\Admin;

use App\DTO\StoreExpenseDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExpensesRequests\StoreExpenseRequest;
use App\Http\Requests\ExpensesRequests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\User;
use App\Policies\ExpensePolicy;
use App\Services\ExpenseService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    public function __construct(
        protected ExpenseService $service,
        protected Expense $expense,
        protected User $user,
        protected ExpensePolicy $expensePolicy
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $expenses = $this->service->getAll();
        // $expenses = $this->service->paginate();
        return response()->json([
            'message' => "All expenses",
            'expenses' => $expenses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExpenseRequest $request)
    {

        $expense = $this->service->create(StoreExpenseDTO::makeFromRequest($request));

        return response()->json([
            'message' => "New expense",
            'expense' => $expense
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        Log::debug('Id is: ', [intval($id)]);
        $expense = $this->service->getById(intval($id));
        Log::debug([$expense]);

        if (is_null($expense))
            return response()->json(['message' => "Expense with id $id not found"], 404);

        if (!Gate::check('view', $expense))
            return response()->json(['message' => "You are not authorized to view this expense"], 403);

        return response()->json([
            'message' => "Expense with id $id",
            'expense' => $expense
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExpenseRequest $request, string $id)
    {
        if (!Gate::check('update', $this->service->getById($id)))
            return response()->json(['message' => "You are not authorized to update this expense"], 403);

        $expense = $this->service->update($request->all(), $id);
        return response()->json([
            'message' => "Updated expense with id $id",
            'expense' => $expense
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::check('update', $this->service->getById($id)))
            return response()->json(['message' => "You are not authorized to delete this expense"], 403);


        $expense = $this->service->delete($id);
        if (!$expense)
            return response()->json([
                'message' => "Expense with id $id not found"
            ]);

        return response()->json([
            'message' => "Deleted expense with id $id"
        ]);
    }
}
