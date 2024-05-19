<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\About;
use App\Models\Feature;
use App\Models\Documentation;
use App\Models\Team;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'root') {
            $user_page = request()->input('user_page', 5);
            $users = User::orderBy('name','asc')->whereNot('role','root')->paginate($user_page)->setPageName('user_page');
        } else {
            $users = NULL;
        }

        $about_page = request()->input('about_page', 1);
        $abouts = About::paginate($about_page)->setPageName('about_page');

        $feature_page = request()->input('feature_page', 1);
        $features = Feature::paginate($feature_page)->setPageName('feature_page');
        
        $documentation_page = request()->input('documentation_page', 2);
        $documentations = Documentation::paginate($documentation_page)->setPageName('documentation_page');
        
        $team_page = request()->input('team_page', 3);
        $teams = Team::paginate($team_page)->setPageName('team_page');

        return view('admin.dashboard',[
            'users' => $users,
            'abouts' => $abouts,
            'features' => $features,
            'documentations' => $documentations,
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::where('id', $id)->first();
        if ($user->role == 'admin') {
            $user->role = 'guest';
        } else {
            $user->role = 'admin';
        }
        $user->save();

        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
