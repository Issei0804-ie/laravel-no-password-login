<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\StoreRequest;
use App\Models\User;
use App\Notifications\VerificationEmailIsOwn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $validatedParams = $request->validated();
        $user = User::create([
            'name' => 'sample',
            'email' => $validatedParams['email'],
        ]);

        $signedUrl = URL::temporarySignedRoute(
            'register.verification.index',
             now()->addHour(),
            [
                'hash' => hash('sha256',$validatedParams['email']),
            ]
        );

        $user->notify(new VerificationEmailIsOwn($signedUrl));

        Auth::login($user);

        return view('register.success',[
            'name' => $user->name,
        ]);
    }
}
