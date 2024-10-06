<?php

namespace App\Http\Controllers\Login\Verification;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $email = $request->input('email');

        $user = User::whereEmail($email)->first();

        if (is_null($user)) {
            return redirect(route('login.index'));
        }

        Auth::login($user);
        $request->session()->regenerate();

        return view('login.verification.success');
    }
}
