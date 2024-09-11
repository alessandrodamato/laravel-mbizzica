<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TwoFactorMiddleware
{
  public function handle(Request $request, Closure $next)
  {
    $user = User::find(Auth::id());
    if (auth()->check() && $user->two_factor_code) {
      if ($user->two_factor_expires_at < now()) {

        $user->timestamps = false;
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        auth()->logout();
        return redirect()->route('login')
        ->withStatus('Codice di verfica scaduto. Accedi nuovamente');
      }
      if (!$request->is('verify*')) {
        return redirect()->route('verify.index');
      }
    }
    return $next($request);
  }
}
