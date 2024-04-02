<?php
namespace App\Http\Middleware;

class CheckSubscription
{
    public function handle($request, $next)
    {
        if ($request->user() && (!$request->user()->parent_id) && $request->user()->type != 'super admin'  && !$request->user()->subscription) {
            // This user is not a paying customer...
            return redirect('subscriptions');
        }
        return $next($request);
    }
}