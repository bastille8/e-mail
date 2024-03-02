<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class EmailVerificationController extends Controller
{
    /**
     * 確認メール送信画面
     * @param  Request  $request
     * @return RedirectResponse|View
     */
    public function index(Request $request): RedirectResponse|View
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended(RouteServiceProvider::HOME)
            : view('auth.addresscheck');
    }

    /**
     * 確認メール送信
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function notification(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        // メール確認済みの場合はトップへ
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // メール送信
        $user->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }

    /**
     * メールリンクの検証
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function verification(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(RouteServiceProvider::HOME . '?verified=1');
    }
}
