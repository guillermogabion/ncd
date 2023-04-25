<?php

namespace App\Http\Controllers;
use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store (Request $request){
        $data = new Patient();
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->age = $request->age;
        $data->address = $request->address;
        $data->disease = $request->disease;
        $data->medicine = $request->medicine;
        $data->quantity = $request->quantity;

        $data->save();

        return $data;
    }

    public function update ($id, Request $request){
        $data = Patient::find($id);
        $data->first_name = $request->first_name;
        $data->last_name = $request->last_name;
        $data->birthdate = $request->birthdate;
        $data->gender = $request->gender;
        $data->age = $request->age;
        $data->address = $request->address;
        $data->disease = $request->disease;
        $data->medicine = $request->medicine;
        $data->quantity = $request->quantity;
        $data->save();

        return $data;
    } 

    public function get(){
        $data = Patient::get();
        return $data;
    }

    public function delete($id){
        $data = Patient::where('id', $id)->delete();
        return $data;
    }
}
