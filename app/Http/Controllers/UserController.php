<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Check if the user is approved.
            if (!$user->is_approved) {
                // If the user is not approved, return with an error message.
                return back()->withErrors([
                    'approval' => 'Your account has not been approved by an administrator yet.',
                ]);
            }

            // If approved, log them in and update last login date
            // $user->last_login_at = now();
            $user->save();

            Auth::login($user);

            // Redirect to a secure page
            return redirect()->intended('domain');
        }

        // If the user is not found or the password doesn't match
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ]);

        // Attempt to create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // No need to set 'email_verified_at' or 'remember_token' for now
        ]);

        if ($user) {
            // Do NOT log the user in. Instead, inform them that their account is pending approval
            return back()->with('success', 'Registration successful. Your account is pending approval by an administrator.');
        }

        // Handle the error if the user wasn't created
        return back()->with('error', 'Unable to register the user. Please try again.');
    }

//    public function showUnapprovedUsers()
//     {
//         // Retrieve all users who have not been approved yet
//         $unapprovedUsers = User::where('is_approved', false)->get();
      
//         // Pass the unapproved users to the view
//         return view('auth.admin', ['unapprovedUsers' => $unapprovedUsers]);
//     }

    public function approveUser(Request $request)
    {
        $user = User::findOrFail($request->approve_user_id);
        $user->is_approved = true;
        $user->save();

        return back()->with('message', 'User approved successfully.');
    }

    public function adminDashboard()
    {

         Log::info('adminDashboard method hit');
        // Fetch unapproved users
        $unapprovedUsers = User::where('is_approved', false)->get();

        // Pass them to the view
        return view('auth.admin', compact('unapprovedUsers'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}

?>