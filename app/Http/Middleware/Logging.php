<?php namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Request;
use App\Models\Log;

class Logging {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($request->is('api/*'))
        {
            $this->logging($request);
        }

		return $next($request);
	}

    public function logging($request)
    {
        $time = Carbon::now();
        $url = $request->path();
        $params = $request->all() ? json_encode($request->all()) : '';
        Log::create(compact('time', 'url', 'params'));
    }

}
