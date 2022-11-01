<?php

namespace App\Http\Middleware;

use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Closure;
use Illuminate\Http\Request;

class IsKaprodi
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
        $kuki = $request->cookie("kaprodi");
        if (!$kuki) {
            return redirect("/login-kaprodi");
        }
        $db = Kaprodi::where(["token" => $kuki])->first();
        if (!$db) {
            return redirect("/login-kaprodi")->withoutCookie("kaprodi");
        }
        return $next($request->merge(['authK' => $db->toArray()]));
    }
}
