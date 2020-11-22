<?php

namespace App\Http\Controllers\Api\V1\Human;

use Exception;
use App\Models\Human;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Human\HumanStoreRequest;
use App\Http\Requests\Human\HumanUpdateRequest;

class HumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Human::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HumanStoreRequest $request
     * @return Human|Model
     */
    public function store(HumanStoreRequest $request)
    {
        return Human::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Human $human
     * @return Human
     */
    public function show(Human $human): Human
    {
        return $human;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HumanUpdateRequest $request
     * @param Human $human
     * @return Human
     */
    public function update(HumanUpdateRequest $request, Human $human): Human
    {
        $human->update($request->all());
        return $human;
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
