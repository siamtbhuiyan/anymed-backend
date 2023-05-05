<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Pharmacy::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'rating' => 'required',
            'image' => 'required'
        ]);
        $input = $request->all();
        if($request->hasfile('image'))
        {
            $destination_path = 'public/images/pharmacies';
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination_path,$image_name);

            $input['image'] = $image_name;
        }
        return Pharmacy::create($input);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Pharmacy::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pharmacy = Pharmacy::find($id);
        $pharmacy->update($request->all());
        return $pharmacy;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Pharmacy::destroy($id);
    }

    /**
     * Search for a name.
     */
    public function search(string $name)
    {
        return Pharmacy::where('name', 'like', '%'.$name.'%')->get();
    }
}
