<?php

namespace App\Http\Controllers;

use App\Maker;
use App\Store;
use App\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function vehicle()
    {
        $makers = Maker::all();

    	return view('admin.vehicle', compact('makers'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        return view('admin.store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function data_master()
    {
        $vehicles = Vehicle::all();
        $stores = Store::all();
        $makers = Maker::all();

        return view('admin.data_master', compact('vehicles', 'stores', 'makers'));
    }
}
