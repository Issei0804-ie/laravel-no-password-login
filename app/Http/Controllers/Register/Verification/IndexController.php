<?php

namespace App\Http\Controllers\Register\Verification;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sha256HashedEmail = $request->input('hash');
        $user = auth()->user();

        if (hash('sha256', $user->email) !== $sha256HashedEmail) {
            return redirect(route('register.index'));
        }

        $user->markEmailAsVerified();

        return view('register.verification.success');
    }
}
