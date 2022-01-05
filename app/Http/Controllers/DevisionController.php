<?php

namespace App\Http\Controllers;

use App\Models\Devision;
use App\Models\District;
use App\Models\Thana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisionController extends Controller
{
    public function index()
    {
        $devisions = Devision::latest()->get();
        $result = DB::table('devisions')
                    ->join('districts', 'devisions.id', '=', 'districts.devision_id')
                    ->select('devisions.*', 'districts.*')
                    ->get();
        return view('backend.components.devisions.index', compact('devisions', 'result'));
    }

    public function getDistrict(Request $request)
    {
        $id = $request->input('id');
        $result = DB::table('devisions')
                    ->join('districts','devisions.id','=','districts.devision_id')
                    ->where('devisions.id', $id)
                    ->get();
        return ($result == true) ? $result : false;
    }
    public function create()
    {
        $devisions = Devision::latest()->get();
        $districts = District::latest()->get();
        // $result = Devision::join('districts', 'devisions.id', '=', 'districts.devision_id')
        //             ->select('devisions.*', 'districts.*')
        //             ->get();
        return view('backend.components.devisions.create', compact('devisions', 'districts'));
    }
    public function insert(Request $request)
    {
        Thana::insert([
            'district_id' => $request->district,
            'thana_name' => $request->thana,
        ]);
        return Redirect()->back()->with('status', 'Information added Successfull.');
    }
}
