<?php

namespace App\Repositories;

use App\DTO\StorePartnerDTO;
use App\Models\Partner;
use App\Repositories\Contracts\PartnerRepositoryInterface;
use Illuminate\Support\Facades\Log;
use stdClass;

class PartnerEloquentORM implements PartnerRepositoryInterface
{
    public function __construct(
        protected Partner $partner,
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        return [];
    }

    public function getAll(string $filter = null): array
    {
        $partners = $this->partner
            ->with('users')
            ->with('contracts')
            ->where(function ($query) use ($filter) {
                if ($filter) {
                    $query->where('description', 'like', "%$filter%");
                    $query->orWhere('title', 'like', "%$filter%");
                }
            })->get()->toArray();

        return $partners;
    }

    public function getById(int $id): Partner | null
    {
        $partner = $this->partner
            ->with('users')
            ->with('contracts')
            ->where('id', $id)->first();
        return $partner;
    }

    public function create(StorePartnerDTO $dto): Partner
    {
        $partner = $this->partner->create((array) $dto);
        return $partner;
    }

    public function update(array $data, int $id): Partner | null
    {
        $partner = $this->partner->find($id);
        $partner->update((array) $data);
        return (object) $partner;
    }

    public function delete(int $id): bool
    {
        $partner = $this->partner->where('id', $id)->first();
        if (!$partner)
            return false;

        $partner->delete();
        return true;
    }
}
