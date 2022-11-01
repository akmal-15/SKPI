<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class isAdmin
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
        $kuki = $request->cookie("admin");
        if (!$kuki) {
            return redirect("/login-admin");
        }
        $db = Admin::where(["token" => $kuki])->first();
        if (!$db) {
            return redirect("/login-admin")->withoutCookie("admin");
        }
        return $next($request->merge(['authA' => $db->toArray()]));
    }
}
