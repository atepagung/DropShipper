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

    public function update(Request $request)
    {
    	try {
    		DB::beginTransaction();

    		$profile = Profile::find(Auth::user()->profile->id);
    		$profile->name = $request->name;
    		$profile->contact = $request->contact;
    		$profile->address = $request->address;
    		$profile->bank_account = $request->bank_account;

    		$profile->save();

    		DB::commit();
    	} catch (Exception $e) {
    		DB::rollBack();
    		return redirect()->route('profile-detail');
    	}
    	return redirect()->route('profile-detail');
    }
}
