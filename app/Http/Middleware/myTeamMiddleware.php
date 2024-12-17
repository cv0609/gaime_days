<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ApiFootballService;

class MyTeamMiddleware
{
    protected $apiFootballService;

    public function __construct(ApiFootballService $apiFootballService)
    {
        $this->apiFootballService = $apiFootballService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $count = $this->apiFootballService->getCurrentTeamCount(); 
        
        if ($count == 11) {
            return $next($request);
        }

        return redirect()->back()->with('error', 'Your team does not have exactly 11 players.');
    }
}

