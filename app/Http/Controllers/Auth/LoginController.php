<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // Ensure this is imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
bat    | This controller handles authenticating users for the application and
    | redirecting them to their respective dashboards based on their role.
    |
    */

    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login attempt
    public function login(Request $request)
    {
        // Validate the request
        $credentials = $request->validate([
            'id_user' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt(['id_user' => $credentials['id_user'], 'password' => $credentials['password']])) {
            // Authentication successful, redirect based on role
            if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            }
            else if (Auth::user()->role == 'student') {
                return redirect('/student');
            }
            else if (Auth::user()->role == 'staff') {
                return redirect('/staff');
            }
            else if (Auth::user()->role == 'kaprodi') {
                return redirect('/kaprodi');
            }
        }

        // Authentication failed, redirect back with error
        return redirect()->back()
            ->withInput($request->only('id_user', 'remember'))
            ->withErrors(['id_user' => 'These credentials do not match our records.']);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}