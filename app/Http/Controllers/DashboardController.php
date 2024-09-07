<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
      $n_pastes = Paste::where('user_id', Auth::id())->count();
      return view('admin.dashboard', compact('n_pastes'));
    }
}
