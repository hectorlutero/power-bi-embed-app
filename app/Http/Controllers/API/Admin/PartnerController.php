<?php

namespace App\Http\Controllers\API\Admin;

use App\DTO\StorePartnerDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\PartnersRequests\StorePartnerRequest;
use App\Http\Requests\PartnersRequests\UpdatePartnerRequest;
use App\Models\User;
use App\Policies\PartnerPolicy;
use App\Services\PartnerService;

class PartnerController extends Controller
{

    public function __construct(
        protected PartnerPolicy $partnerPolicy,
        protected PartnerService $partnerService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!$this->partnerPolicy->viewAny(User::find(auth()->user()->id)))
            return response()->json(['message' => "You are not authorized to view any partners",], 403);

        $partners = $this->partnerService->getAll();

        return response()->json($partners, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnerRequest $request)
    {
        $partner = $this->partnerService->create(StorePartnerDTO::makeFromRequest($request));

        return response()->json($partner, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $partner = $this->partnerService->getById($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        return response()->json($partner, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnerRequest $request, $id)
    {

        $partner = $this->partnerService->getById($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $partner->update($request->all());

        return response()->json($partner, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partner = $this->partnerService->getById($id);

        if (!$partner) {
            return response()->json(['message' => 'Partner not found'], 404);
        }

        $partner->delete();

        return response()->json(['message' => 'Partner deleted successfully'], 204);
    }
}
