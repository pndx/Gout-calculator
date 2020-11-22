<?php

namespace App\Http\Controllers\Api\V1\Food;

use Exception;
use App\Models\Food;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
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
     * @param int $id
     * @return Food|Food[]|Collection|Model
     */
    public function show(int $id)
    {
        return Food::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FoodUpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(FoodUpdateRequest $request, int $id): bool
    {
        $food = Food::findOrFail($id);

        return $food->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool|null
     * @throws Exception
     */
    public function destroy(int $id): ?bool
    {
        return Food::findOrFail($id)->delete();
    }
}
