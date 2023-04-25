<?php

namespace App\Http\Controllers;
use App\Disease;
use Illuminate\Http\Request;

class DiseaseController extends Controller
{
    //

    public function store (Request $request){
        $data = new Disease();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->symptoms = $request->symptoms;

        $data->save();

        return $data;
    }

    public function update ($id, Request $request){
        $data = Disease::find($id);
        $data->name = $request->name;
        $data->symptoms = $request->symptoms;
        $data->save();

        return $data;
    } 

    public function get(){
        $data = Disease::get();
        return $data;
    }

    public function delete($id){
        $data = Disease::where('id', $id)->delete();
        return $data;
    }
}
