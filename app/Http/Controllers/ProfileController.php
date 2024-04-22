<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{
    public function __construct(){
        // Protecting the routes
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    /*
    public function index()
    {
        //
    }
    */
    /**
     * Show the form for creating a new resource.
     */
    /*
    public function create()
    {
        //
    }
    */
    /**
     * Store a newly created resource in storage.
     */
    /*
    public function store(Request $request)
    {
        //
    }
    */
    /**
     * Display the specified resource.
     */
    
     public function show(Profile $profile)
    {
        $articles = Article::where([
            ['user_id', $profile->user_id], 
            ['status', '1']])->simplePaginate(8);

            return view('subscriber.profiles.show', compact('profile', 'articles'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view', $profile);
        // We only return a view
        return view('subscriber.profiles.edit', compact('profile'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $this->authorize('update', $profile);
        /*
            We import the classes at the beginning:
                use Illuminate\Support\Facades\Auth;
                use Illuminate\Support\Facades\File;
        */
        $user = Auth::user();
        /* We check if the user has uploaded a photo. */
        if($request->hasFile('photo')){
            // We delete the preview photo
            File::delete(public_path('storage/' . $profile->photo));
            // We assign the new photo and it will save in the folder called profiles and will delete the image
            // that exists.
            $photo = $request['photo']->store('profiles');
        }else{
            // If we are not anything photo on the other hand we let the actual photo
            $photo = $user->profile->photo;
        }

        // Let's assign name and email
        $user->full_name = $request->full_name;
        $user->email = $request->email;
        // Let's assign additional fields
        $user->profile->profession = $request->profession;
        $user->profile->about = $request->about;
        // Let's assign the photo
        $user->profile->photo = $photo;
        $user->profile->twitter = $request->twitter;
        $user->profile->linkedin = $request->linkedin;
        $user->profile->facebook = $request->facebook; 
        // Let's save the user fields
        $user->save();
        // Let's save fields from profile
        $user->profile->save();

        return redirect()->route('profiles.edit', $user->profile->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    /*
    public function destroy(Profile $profile)
    {
        //
    }
    */
}
