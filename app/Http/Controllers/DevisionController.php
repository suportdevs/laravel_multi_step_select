<?php

namespace App\Http\Controllers;

use App\Models\Devision;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevisionController extends Controller
{
    public function index()
    {
        $devisions = Devision::get()->all();
        return view('backend.components.devisions.index', compact('devisions'));
    }
    public function getDistrict(Request $request)
    {
        $id = $request->input('id');
        // $result = DB::table('devisions')->where('devisions.id', '=', $id)
        //             ->join('districts', 'devisions.id', '=', 'districts.devision_id')
        //             ->get();
        $result = DB::table('devisions')
                    ->join('districts','devisions.id','=','districts.devision_id')
                    ->where('devisions.id', $id)
                    ->get();
        // $result = District::where('devision_id', $id)->get();
        if($result==true){
            return $result;
        }else{
            return false;
        }
    }
    public function new()
    {
        $devisions = Devision::get()->all();
        return view('backend.components.devisions.new', compact('devisions'));
    }
}
