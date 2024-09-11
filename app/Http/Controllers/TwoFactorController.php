<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendTwoFactorCode;
use App\Models\User;

class TwoFactorController extends Controller
{
  public function index()
  {
    return view('auth.two-factor');
  }
  public function store(Request $request)
  {
    $request->validate([
      'two_factor_code' => ['integer', 'required'],
    ], [
      'two_factor_code.required' => 'Inserire il codice',
      'two_factor_code.integer' => 'Il codice a due fattori deve essere un numero',
    ]);

    $user = User::find(Auth::id());

    if ($request->input('two_factor_code') !== $user->two_factor_code) {
      return redirect()->back()->withErrors([
        'two_factor_code' => __('Il codice inserito non corrisponde'),
      ])->withInput();
    }

    $user->timestamps = false;
    $user->two_factor_code = null;
    $user->two_factor_expires_at = null;
    $user->save();

    return redirect()->to(RouteServiceProvider::HOME);
  }
  public function resend()
  {
    $user = User::find(Auth::id());

    $user->timestamps = false;
    $user->two_factor_code = rand(100000, 999999);
    $user->two_factor_expires_at = now()->addMinutes(10);
    $user->save();

    Mail::to($user->email)->send(new SendTwoFactorCode($user->two_factor_code, $user->two_factor_expires_at));

    return redirect()->back()->withStatus(__('Il codice è stato inviato nuovamente'));
  }
}
