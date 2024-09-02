<?php

namespace App\DTO;

use App\Http\Requests\ContractsRequests\StoreContractRequest;

class StoreContractDTO
{
    public function __construct(
        public string $contract_number,
        public int $partner_id,
    ) {
    }

    public static function makeFromRequest(StoreContractRequest $request): self
    {
        return new self(
            $request->contract_number,
            $request->partner_id,
        );
    }
}
