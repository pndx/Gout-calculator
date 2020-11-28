<?php

namespace App\Http\Controllers\Api\V1\Human;

use Exception;
use App\Models\Human;
use App\Http\Controllers\Controller;
use App\Http\Resources\HumanResource;
use App\Http\Requests\Human\HumanStoreRequest;
use App\Http\Requests\Human\HumanUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): AnonymousResourceCollection
    {
        return HumanResource::collection(Human::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HumanStoreRequest $request
     * @return HumanResource
     */
    public function store(HumanStoreRequest $request): HumanResource
    {
        $human = Human::create($request->all());
        return new HumanResource($human);
    }

    /**
     * Display the specified resource.
     *
     * @param Human $human
     * @return HumanResource
     */
    public function show(Human $human): HumanResource
    {
        return new HumanResource($human);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HumanUpdateRequest $request
     * @param Human $human
     * @return HumanResource
     */
    public function update(HumanUpdateRequest $request, Human $human): HumanResource
    {
        $human->update($request->all());
        return new HumanResource($human);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Human $human
     * @return Human
     * @throws Exception
     */
    public function destroy(Human $human): Human
    {
        $human->delete();
        return $human;
    }
}
