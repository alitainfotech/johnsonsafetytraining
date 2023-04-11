<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Http\Requests\Admin\PasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @author Jayesh
     * 
     * @uses Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * @author Jayesh
     * 
     * @uses Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Profile and Password page / form display
     *
     * @return void
     */
    public function profile()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Updates user profile
     *
     * @param  mixed $request
     * @return void
     */
    public function profileUpdate(ProfileRequest $request)
    {
        try {
            $user = auth()->user();
            $user->update($request->except(['_token']));
            return redirect(route('admin.users.profile'))->with(['type' => 'success', 'message' => 'Profile updated successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.users.profile'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Updates user password
     *
     * @param  mixed $request
     * @return void
     */
    public function passwordUpdate(PasswordRequest $request)
    {
        try {
            $user = auth()->user();
            $user->update(['password' => bcrypt($request->new_password)]);
            return redirect(route('admin.users.profile'))->with(['type' => 'success', 'message' => 'Password updated successfully.']);
        } catch (\Exception $e) {
            return redirect(route('admin.users.profile'))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }
}
