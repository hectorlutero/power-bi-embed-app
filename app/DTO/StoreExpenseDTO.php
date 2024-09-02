<?php

namespace App\DTO;

use App\Http\Requests\ExpensesRequests\StoreExpenseRequest;

class StoreExpenseDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public string $date,
        public float $total_amount,
        public int $user_id
    ) {
    }

    public static function makeFromRequest(StoreExpenseRequest $request): self
    {
        return new self(
            $request->title,
            $request->description,
            $request->date,
            $request->total_amount,
            auth()->user()->id
        );
    }
}
