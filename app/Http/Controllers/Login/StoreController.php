<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\VerificationLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $user = User::whereEmail($email)->first();

        if (!is_null($user)) {
            $signedUrl = URL::temporarySignedRoute(
                'login.verification.index',
                now()->addHour(),
                [
                    'email' => $user->email,
                ]
            );
            $user->notify(new VerificationLogin($signedUrl));
        }
        return view('login.index');
    }
}
