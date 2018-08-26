<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class ProfileController extends Controller
{
    public function detail()
    {
    	$profile = Profile::with('user')->find(Auth::user()->profile->id);
    	return view('ProfileDetail', ['profile' => $profile]);
    }
}
