<?php

namespace App\Http\Controllers\Api\V1\Food;

use Exception;
use App\Models\Food;
use App\Http\Controllers\Controller;
use App\Http\Resources\FoodResource;
use App\Http\Requests\Food\FoodStoreRequest;
use App\Http\Requests\Food\FoodUpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): AnonymousResourceCollection
    {
        return FoodResource::collection(Food::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FoodStoreRequest $request
     * @return FoodResource
     */
    public function store(FoodStoreRequest $request): FoodResource
    {
        $food = Food::create($request->all());
        return new FoodResource($food);
    }

    /**
     * Display the specified resource.
     *
     * @param Food $food
     * @return FoodResource
     */
    public function show(Food $food): FoodResource
    {
        return new FoodResource($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FoodUpdateRequest $request
     * @param Food $food
     * @return FoodResource
     */
    public function update(FoodUpdateRequest $request, Food $food): FoodResource
    {
        $food->update($request->all());
        return new FoodResource($food);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Food $food
     * @return Food
     * @throws Exception
     */
    public function destroy(Food $food): Food
    {
        $food->delete();
        return $food;
    }
}
