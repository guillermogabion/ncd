<?php

namespace App\Http\Controllers;
use App\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    //

    public function store (Request $request){
        $data = new Medicine();
        $data->name = $request->name;
        $data->description = $request->description;

        $data->save();

        return $data;
    }

    public function update ($id, Request $request){
        $data = Medicine::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->save();

        return $data;
    } 

    public function get(){
        $data = Medicine::get();
        return $data;
    }

    public function delete($id){
        $data = Medicine::where('id', $id)->delete();
        return $data;
    }
}
