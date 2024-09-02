<?php

namespace App\Http\Controllers\API\Admin;

use App\DTO\StoreContractDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContractsRequests\StoreContractRequest;
use App\Http\Requests\ContractsRequests\UpdateContractRequest;
use App\Policies\ContractPolicy;
use App\Services\ContractService;

class ContractController extends Controller
{
    public function __construct(
        protected ContractPolicy $contractPolicy,
        protected ContractService $contractService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contracts = $this->contractService->getAll();

        return response()->json($contracts, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreContractRequest $request)
    {
        $contract = $this->contractService->create(StoreContractDTO::makeFromRequest($request));

        return response()->json($contract, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $contract = $this->contractService->getById($id);

        if (!$contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        return response()->json($contract, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContractRequest $request, $id)
    {
        $contract = $this->contractService->getById($id);

        if (!$contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        $contract = $this->contractService->update($request->all(), $id);

        return response()->json($contract, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $contract = $this->contractService->getById($id);

        if (!$contract) {
            return response()->json(['message' => 'Contract not found'], 404);
        }

        $this->contractService->delete($id);

        return response()->json(['message' => 'Contract deleted successfully'], 204);
    }
}
