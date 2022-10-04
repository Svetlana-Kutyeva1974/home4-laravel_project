<?php

namespace App\Http\Controllers;

use App\Models\Car;
//use Illuminate\Http\Request;
use App\Http\Requests\CarRequest;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Car::paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarRequest $request)
    {
        return Car::create($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Car::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    /*public function edit(Car $car)
    {
        //
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CarRequest $request
     * @param  \App\Models\Car  $car
     * @return boolean
     */
    public function update(CarRequest $request, Car $car)
    {
        $car->fill($request->validated());
        return $car->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        if ($car->delete()) {
            return response(null, Response::HTTP_NO_CONTENT);
        }
        return null;
    }
}
