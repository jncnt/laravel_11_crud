<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('products.index');
        }
    
        return view('auth.login');
    }
    public function login(Request $request)
    {
  
          $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

 
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
           
            $request->session()->regenerate();

          
            return redirect()->intended(route('products.index'));
        }

      
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput(); 
  

}

   
}