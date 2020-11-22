<?php

namespace App\Http\Controllers\Api\V1\Human;

use Exception;
use App\Models\Human;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

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
     * @param Request $request
     * @return Human|Model
     */
    public function store(Request $request)
    {
        return Human::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Human|Human[]|Collection|Model
     */
    public function show(int $id)
    {
        return Human::findOrFail($id);
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
        $human = Human::findOrFail($id);

        $human->name       = $request->input('name');
        $human->age        = $request->input('age');
        $human->address    = $request->input('address');
        $human->is_painful = $request->input('is_painful');
        $human->purine     = $request->input('purine');

        return $human->save();
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
        return Human::findOrFail($id)->delete();
    }
}
