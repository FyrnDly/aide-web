<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::paginate(1);
        
        return view('admin.feature.index',[
            'features' => $features,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageFile = $request->file('image');
        $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs(
            'public/feature',
            $imageName
        );

        Feature::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'path' => $path,
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('admin.feature.edit',[
            'feature' => $feature
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($feature->path) {
                Storage::delete($feature->path);
            }
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
            $path = $imageFile->storeAs(
                'public/feature',
                $imageName
            );
            $feature->path = $path;
        }

        $feature->name = $request['name'];
        $feature->description = $request['description'];
        $feature->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        Storage::delete($feature->path);
        $feature->delete();

        return redirect()->route('admin.index');
    }
}
