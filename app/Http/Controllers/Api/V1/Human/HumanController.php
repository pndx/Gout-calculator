<?php

namespace App\Http\Controllers\Api\V1\Human;

use Exception;
use App\Models\Human;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
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
     * @param HumanUpdateRequest $request
     * @param int $id
     * @return bool
     */
    public function update(HumanUpdateRequest $request, int $id): bool
    {
        $human = Human::findOrFail($id);

        return $human->update($request->all());
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
