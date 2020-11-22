<?php

namespace App\Http\Controllers\Api\V1\Food;

use Exception;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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
     * @param Request $request
     * @return Food|Model
     */
    public function store(Request $request)
    {
        return Food::create([
            'name'   => $request->input('name'),
            'purine' => $request->input('purine'),
        ]);
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
     * @param Request $request
     * @param int $id
     * @return bool
     */
    public function update(Request $request, int $id): bool
    {
        $food = Food::findOrFail($id);

        $food->name   = $request->input('name');
        $food->purine = $request->input('purine');

        return $food->save();
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
