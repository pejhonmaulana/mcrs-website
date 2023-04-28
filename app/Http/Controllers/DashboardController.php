<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
	public function index()
	{
		$users = User::with('user_profile')->orderByDesc('id')->get();
		return Inertia::render('Dashboard', [
			'users' => $users
		]);
	}

	public function verif(Request $request)
	{
		$dateNow = date('Y-m-d H:i:s');
		User::whereId($request->id)->update([
			'email_verified_at' => $dateNow
		]);
		return redirect()->back()->with('success', 'Akun berhasil terverifikasi!');
	}
}