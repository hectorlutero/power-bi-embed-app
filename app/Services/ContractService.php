<?php

namespace App\Services;

use App\DTO\StoreContractDTO;
use App\Models\Contract;
use App\Repositories\Contracts\ContractRepositoryInterface;

class ContractService
{
    protected ContractRepositoryInterface $contractRepository;

    public function __construct(ContractRepositoryInterface $contractRepository)
    {
        $this->contractRepository = $contractRepository;
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        return $this->contractRepository->paginate($page, $totalPerPage, $filter);
    }

    public function getAll(?string $filter = null): array
    {
        $filter = $filter ?? '';
        $contracts = $this->contractRepository->getAll($filter);
        return $contracts;
    }

    public function getById(int $id): Contract|null
    {
        $contract = $this->contractRepository->getById($id);
        return $contract ? (object) $contract : null;
    }

    public function create(StoreContractDTO $dto): Contract
    {
        $contract = $this->contractRepository->create($dto);
        return $contract;
    }

    public function update($data, int $id): Contract
    {
        $contract = $this->contractRepository->update($data, $id);
        return (object) $contract;
    }

    public function delete(int $id): bool
    {
        return $this->contractRepository->delete($id);
    }
}
