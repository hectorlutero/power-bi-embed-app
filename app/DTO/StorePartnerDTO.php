<?php

namespace App\DTO;

use App\Http\Requests\PartnersRequests\StorePartnerRequest;

class StorePartnerDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string | null $address,
    ) {
    }

    public static function makeFromRequest(StorePartnerRequest $request): self
    {
        return new self(
            $request->name,
            $request->email,
            $request->address ?? null,
        );
    }
}
