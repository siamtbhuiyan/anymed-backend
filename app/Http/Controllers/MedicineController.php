<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;


class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Medicine::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'manufacturer' => 'required',
            'dosage' => 'required',
            'group' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required',
            'pharmacy' => 'required'
        ]);
        $input = $request->all();
        if($request->hasfile('image'))
        {
            $destination_path = 'public/images/medicines';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path,$image_name);

            $input['image'] = $image_name;
        }
        return Medicine::create($input);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Medicine::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $medicine = Medicine::find($id);
        $medicine->update($request->all());
        return $medicine;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Medicine::destroy($id);
    }

    /**
     * Search for a name.
     */
    public function search(string $name)
    {
        return Medicine::where('name', 'like', '%'.$name.'%')->get();
    }
}
