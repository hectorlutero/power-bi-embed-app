<?php

namespace App\Repositories;

use App\DTO\StoreContractDTO;
use App\Models\Contract;
use App\Repositories\Contracts\ContractRepositoryInterface;

class ContractEloquentORM implements ContractRepositoryInterface
{
    public function __construct(
        protected Contract $contract
    ) {
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        $query = $this->contract->query();

        if ($filter) {
            $query->where('contract_number', 'like', "%$filter%");
        }

        return (array) $query->paginate($totalPerPage, ['*'], 'page', $page);
    }

    public function getAll(string $filter = null): array
    {
        $query = $this->contract->query();

        if ($filter) {
            $query->where('contract_number', 'like', "%$filter%");
        }

        return $query->get()->toArray();
    }

    public function getById(int $id): Contract|null
    {
        return $this->contract->with('partner')->find($id);
    }

    public function create(StoreContractDTO $dto): Contract
    {
        $contract = $this->contract->create((array) $dto);
        return $contract;
    }

    public function update(array $data, int $id): Contract|null
    {
        $contract = $this->contract->find($id);
        if (!$contract) {
            return null;
        }

        $contract->update($data);
        return $contract;
    }

    public function delete(int $id): bool
    {
        $contract = $this->contract->find($id);
        if (!$contract) {
            return false;
        }

        $contract->delete();
        return true;
    }
}
