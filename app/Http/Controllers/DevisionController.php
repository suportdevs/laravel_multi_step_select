<?php

namespace App\Http\Controllers;

use App\Models\Devision;
use App\Models\District;
use App\Models\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisionController extends Controller
{
    public function index()
    {
        $devisions = Devision::latest()->get();
        $result = DB::table('devisions')
                    ->join('districts', 'devisions.id', '=', 'districts.devision_id')
                    ->join('upazilas', 'districts.id', '=', 'upazilas.district_id')
                    ->select('devisions.*', 'districts.*', 'upazilas.*')
                    ->get();
        return view('backend.components.devisions.index', compact('devisions', 'result'));
    }

    public function getDistrict(Request $request)
    {
        $id = $request->input('id');
        $result = Devision::join('districts','devisions.id','=','districts.devision_id')
                    ->where('devisions.id', $id)
                    ->get();
        return ($result == true) ? $result : false;
    }
    public function create()
    {
        $devisions = Devision::latest()->get();
        return view('backend.components.devisions.create', compact('devisions'));
    }
    public function insert(Request $request)
    {
        Upazila::insert([
            'district_id' => $request->district,
            'upazila_name' => $request->upazila,
        ]);
        return Redirect()->back()->with('status', 'Information added Successfull.');
    }
    public function getUpazila(Request $request)
    {
        $id = $request->input('id');
        $result = Devision::join('districts','devisions.id','=','districts.devision_id')
                    ->join('upazilas', 'districts.id', '=', 'upazilas.district_id')
                    ->where('districts.id', $id)
                    ->get();
        return ($result == true) ? $result : false;
    }
}
