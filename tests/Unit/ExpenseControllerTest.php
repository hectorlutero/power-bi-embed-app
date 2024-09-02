<?php

namespace Tests\Unit\API\Admin;

use App\DTO\StoreExpenseDTO;
use App\Http\Controllers\API\Admin\ExpenseController;
use App\Repositories\Contracts\ExpenseRepositoryInterface;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\User;
use App\Policies\ExpensePolicy;
use App\Repositories\ExpenseEloquentORM;
use App\Services\ExpenseService;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    public function testIndex()
    {
        $expenseRepositoryMock = $this->createMock(ExpenseRepositoryInterface::class);
        $controller = new ExpenseController(new ExpenseService($expenseRepositoryMock), new Expense, new User, new ExpensePolicy);
        $data = $controller->index();
        $jsonDecoded = json_decode($data->getContent(), true);
        $this->assertEquals(200, $data->status());
        $this->assertEquals('All expenses', $jsonDecoded['message']);
        $this->assertEquals('array', gettype($jsonDecoded['expenses']));
    }

    public function testStore()
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        Auth::login($user);

        $expenseRepositoryMock = $this->createMock(ExpenseRepositoryInterface::class);

        $expenseRepositoryMock->expects($this->once())
            ->method('create')
            ->willReturn(new Expense());

        $controller = new ExpenseController(new ExpenseService($expenseRepositoryMock), new Expense(), new User(), new ExpensePolicy());

        $request = new StoreExpenseRequest([
            'title' => 'Test Expense',
            'description' => 'Test Expense description',
            'total_amount' => 10.00,
            'date' => '10-01-2024',
            'user_id' => auth()->user()->id,
        ]);

        $response = $controller->store($request);

        $this->assertEquals(200, $response->status());
    }

    public function testShow()
    {
        $user = User::factory()->create();
        Auth::login($user);

        $expenseRepositoryMock = $this->createMock(ExpenseRepositoryInterface::class);
        $controller = new ExpenseController(new ExpenseService($expenseRepositoryMock), new Expense(), new User(), new ExpensePolicy());

        $id = 1; // Set the ID of the expense to be shown

        // Call the show method
        $response = json_decode($controller->show($id));
        // Assert the status code
        $this->assertEquals(null, $response);
    }


    public function testUpdate()
    {
        $expenseRepositoryMock = $this->createMock(ExpenseRepositoryInterface::class);
        $controller = new ExpenseController(new ExpenseService($expenseRepositoryMock), new Expense, new User, new ExpensePolicy);
        $request = new UpdateExpenseRequest([
            'total_amount' => 10.00
        ]);
        $id = '1';
        $response = $controller->update($request, $id);

        $this->assertEquals(403, $response->status());
    }

    public function testDestroy()
    {
        $expenseRepositoryMock = $this->createMock(ExpenseRepositoryInterface::class);
        $controller = new ExpenseController(new ExpenseService($expenseRepositoryMock), new Expense, new User, new ExpensePolicy);
        $id = '1';

        $response = $controller->destroy($id);

        $this->assertEquals(403, $response->status());
    }
}
