<?php

namespace App\Http\Controllers\Register;

use App\Http\Controllers\Controller;
use App\Http\Requests\Register\StoreRequest;
use App\Models\User;
use App\Notifications\VerificationEmailIsOwn;
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
            name:'email.verification',
            expiration: now()->addHour(),
        );

        $user->notify(new VerificationEmailIsOwn($signedUrl));

        return view('register.success',[
            'name' => $user->name,
        ]);
    }
}
