<?php

namespace App\Http\Controllers\Api\V1\Human;

use App\Models\Human;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        return response();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return bool
     */
    public function store(Request $request): bool
    {
        $human = new Human();

        $human->name       = $request->input('name');
        $human->age        = $request->input('age');
        $human->address    = $request->input('address');
        $human->is_painful = $request->input('is_painful');
        $human->purine     = $request->input('purine');

        return $human->save();
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
     * @param  int  $id
     * @return Response
     */
    public function destroy(int $id): Response
    {
        return response();
    }
}
