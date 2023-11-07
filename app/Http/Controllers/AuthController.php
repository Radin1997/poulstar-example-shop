<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function login(Request $request): View|RedirectResponse
    {
        if(Auth::check()) {
            return redirect()->route('pages.home');
        }

        return view('auth.login');
    }

    /**
     * @param Request $request
     * @return View
     */
    public function register(Request $request): View
    {
        return view('auth.register');
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function processLogin(Request $request): View|RedirectResponse
    {
        $request->validate([
            'phone' => 'bail|required|digits:11',
            'password' => 'bail|required|min:8|max:20',
        ], [
            // We use default error messages
        ], [
            'phone' => 'شماره تلفن',
            'password' => 'کلمه عبور',
        ]);

        $credentials = [
            'phone_number' => $request->input('phone'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('pages.home'));
        }

        session()->flash('message', 'با این اطلاعات کاربری وجود ندارد');
        return back();
    }

    /**
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function processRegistration(Request $request): View|RedirectResponse
    {
        $request->validate([
            'name' => 'bail|required|string|min:3|max:55',
            'phone' => 'bail|required|digits:11',
            'email' => 'bail|required|email|unique:users,email',
            'password' => 'bail|required|min:8|max:20',
        ], [
            // We use default error messages
        ], [
            'name' => 'نام',
            'phone' => 'شماره تلفن',
            'email' => 'ایمیل',
            'password' => 'کلمه عبور',
        ]);

        $newUser = User::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        if($newUser) {
            session()->flash('message', 'کاربر جدید با موفقیت ساخته شد');
            return redirect()->route('login');
        }

        session()->flash('message', 'مشکلی پیش آمده است');
        return back();
    }
}
