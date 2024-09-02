<?php

namespace App\Services;

use App\DTO\StorePartnerDTO;
use App\Mail\PartnerStored;
use App\Models\Partner;
use App\Repositories\Contracts\PartnerRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PartnerService
{
    protected PartnerRepositoryInterface $partnerRepository;
    public function __construct(PartnerRepositoryInterface $partnerRepository)
    {
        $this->partnerRepository = $partnerRepository;
    }

    public function paginate(int $page = 1, int $totalPerPage = 10, string $filter = null): array
    {
        return [];
    }
    public function getAll(?string $filter = null): array
    {
        $filter = $filter ?? '';
        $partners = $this->partnerRepository->getAll($filter);
        return $partners;
    }

    public function getById(int $id): Partner | null
    {
        $partner = $this->partnerRepository->getById($id);
        return $partner ? (object) $partner : null;
    }

    public function create(StorePartnerDTO $dto): Partner
    {
        $partner = $this->partnerRepository->create($dto);
        if (!$partner)
            Log::error('Partner is null.');

        Mail::to(auth()->user()->email)->send(new PartnerStored($partner));

        return $partner;
    }

    public function update($data, int $id): Partner
    {
        $partner = $this->partnerRepository->update($data, $id);
        return (object) $partner;
    }

    public function delete(int $id): bool
    {
        return $this->partnerRepository->delete($id);
    }
}
