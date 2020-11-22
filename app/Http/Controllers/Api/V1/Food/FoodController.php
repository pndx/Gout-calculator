<?php

namespace App\Http\Controllers\Api\V1\Food;

use Exception;
use App\Models\Food;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\Food\FoodStoreRequest;
use App\Http\Requests\Food\FoodUpdateRequest;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return Food::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FoodStoreRequest $request
     * @return Food|Model
     */
    public function store(FoodStoreRequest $request)
    {
        return Food::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param Food $food
     * @return Food
     */
    public function show(Food $food): Food
    {
        return $food;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FoodUpdateRequest $request
     * @param Food $food
     * @return Food
     */
    public function update(FoodUpdateRequest $request, Food $food): Food
    {
        $food->update($request->all());
        return $food;
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
