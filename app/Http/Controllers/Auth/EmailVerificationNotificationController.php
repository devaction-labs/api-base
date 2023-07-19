<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\{JsonResponse, RedirectResponse, Request};

class EmailVerificationNotificationController extends Controller
{
    /**
     * Store method.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function store(Request $request): JsonResponse|RedirectResponse
    {
        if ($request->user() !== null && $request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        if ($request->user() !== null) {
            $request->user()->sendEmailVerificationNotification();
        }

        return response()->json(['status' => 'verification-link-sent']);
    }
}
