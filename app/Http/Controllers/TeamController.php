<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::orderBy('name')->paginate(3);
        
        return view('admin.team.index',[
            'teams' => $teams,
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
            'nim' => 'required',
            'linkedin' => 'required|active_url',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        $imageFile = $request->file('image');
        $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
        $path = $imageFile->storeAs(
            'public/team',
            $imageName
        );

        Team::create([
            'name' => $request['name'],
            'nim' => $request['nim'],
            'linkedin' => $request['linkedin'],
            'path' => $path,
        ]);

        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Team $team)
    {
        return view('admin.team.edit',[
            'team' => $team
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required',
            'nim' => 'required',
            'linkedin' => 'required|active_url',
            'image' => 'required|image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('image')) {
            if ($team->path) {
                Storage::delete($team->path);
            }
            $imageFile = $request->file('image');
            $imageName = date('Y-m-d').'-'.uniqid().'.'.$imageFile->getClientOriginalExtension();
            $path = $imageFile->storeAs(
                'public/team',
                $imageName
            );
            $team->path = $path;
        }

        $team->name = $request['name'];
        $team->nim = $request['nim'];
        $team->linkedin = $request['linkedin'];
        $team->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        Storage::delete($team->path);
        $team->delete();

        return redirect()->route('admin.index');
    }
}
