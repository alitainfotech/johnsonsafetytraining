<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyLoginRequest;
use App\Mail\ResetPasswordEmail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{    
    /**
     * @author Jayesh
     * 
     * @uses Login form
     *  
     * @param  mixed $request
     * @return void
     */
    public function login()
    {
        return view('admin.auth.login');
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Login form varification
     * 
     * @param  mixed $request
     * @return void
     */
    public function verifyLogin(VerifyLoginRequest $request)
    {
        try {
            $remember_me = $request->has('remember_me') ? true : false;
            if (Auth::attempt($request->except(['_token', 'remember_me']), $remember_me)) {
                $request->session()->regenerate();
                $user = Auth::user();
                if($user->types == 1){
                    return redirect()->intended(route('user.products.studentcourse'));
                }
                return redirect()->intended(route('admin.dashboard'));
            }
            return redirect()->back()->with(['type' => 'danger', 'message' => 'The provided credentials do not match our records.']);
        } catch (\Exception $e) {
            return redirect()->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Forgot password form
     * 
     * @param  mixed $request
     * @return void
     */
    public function forgotPassword(Request $request)
    {
        return view('admin.auth.forgot-password');
    }

    public function sendResetPasswordLink(ForgotPasswordRequest $request)
    {
        try {
            $token = base64_encode($request->email);
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);
            Mail::send(new ResetPasswordEmail($token, $request->email));
            return redirect(route('admin.forgot-password'))->with(['type' => 'success', 'message' => 'We have e-mailed your password reset link!']);
        } catch (\Exception $e) {
            return redirect(route('admin.forgot-password'))->with(['type' => 'danger', 'message' => $e]);
        }
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Reset password form
     * 
     * @param  mixed $request
     * @return void
     */
    public function resetPassword($token)
    {
        return view('admin.auth.reset-password', compact('token'));
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Reset new password
     *
     * @param  mixed $request
     * @return void
     */
    public function resetNewPassword(ResetPasswordRequest $request)
    {
        try {
            $email = base64_decode($request->token);
            $password_resets = DB::table('password_resets')->where(['email' => $email, 'token' => $request->token])->first();
            if(is_null($password_resets)) {
                return redirect(route('admin.reset-password', $request->token))->with(['type' => 'danger', 'message' => 'Invalid token!']);
            } else {
                User::where('email', $email)->update(['password' => bcrypt($request->new_password)]);
                DB::table('password_resets')->where(['email'=> $email])->delete();
                return redirect(route('admin.login'))->with(['type' => 'success', 'message' => 'Password has been reset successfully.']);
            }
        } catch (\Exception $e) {
            return redirect(route('admin.reset-password', $request->token))->with(['type' => 'danger', 'message' => 'Something went wrong. Please try again later.']);
        }
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Logout from admin panel
     * 
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        $userTypes = Auth::user()->types;
        if($userTypes == 1){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('user.login'));
        }else
        {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect(route('admin.login'));
        }
    
    }
    
    /**
     * @author Jayesh
     * 
     * @uses Dashboard page
     *
     * @return void
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}