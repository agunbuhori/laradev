<?php

namespace App\Http\Controllers;

use App\Track;
use App\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('product_id'))
            $vehicles = Vehicle::where('product_id', request()->product_id);
        else
            $vehicles = Vehicle::select('*');

        if (request()->has('q'))
            $vehicles = $vehicles->where('number', 'like', '%'.request()->input('q').'%')->get();
        else
            $vehicles = $vehicles->get();

        foreach ($vehicles as $vehicle) {
            $vehicle->store = $vehicle->tracks()->whereNull('out')->first()['store']['name'];
        }
        
        return $vehicles;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'number' => 'required',
            'product' => 'required',
            'color' => 'required',
        ]);

        $vehicle = new Vehicle;

        $vehicle->number = $request->number;
        $vehicle->product_id = $request->product;
        $vehicle->color = $request->color;

        $vehicle->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $this->validate($request,[
            'picture' => 'required',
            'number' => 'required',
            'product' => 'required',
        ]);

        $vehicle->number = $request->number;
        $vehicle->product = $request->maker;

        if ($request->file('picture')) {
            $picture = $request->file('picture');
            $pictureName = date('Ym/').date('Ymdhis').".".$picture->getClientOriginalExtension();

            if (! File::exists(public_path('pics/'.date('Ym'))))
                File::makeDirectory(public_path('pics/'.date('Ym')));

            $img = Image::make($picture->getRealPath());
            $img->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save(public_path('pics/'.$pictureName));

            $vehicle->picture = $pictureName;
        }

        $vehicle->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->delete();
    }
}
