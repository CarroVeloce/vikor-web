<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Penilaian;

class CheckPenilaian
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $penilaians = Penilaian::all();
        
        if ($penilaians->isEmpty()) {
            return redirect()->route('inputdata.index')->with('error', 'Anda harus mengisi penilaian terlebih dahulu.');
        }

        return $next($request);
    }
}
