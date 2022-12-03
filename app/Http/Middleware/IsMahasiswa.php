<?php

namespace App\Http\Middleware;

use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;

class IsMahasiswa
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
	 * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
	 */
	public function handle(Request $request, Closure $next)
	{
		$kuki = $request->cookie("mahasiswa");
		if (!$kuki) return redirect("/login-mahasiswa");
		$db = Mahasiswa::where(["token" => $kuki])->first();
		if (!$db) return redirect("/login-mahasiswa")->withoutCookie("mahasiswa");
		return $next($request->merge(['authM' => $db->toArray()]));
	}
}
