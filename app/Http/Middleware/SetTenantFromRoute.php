<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use App\Support\TenantManager;
use Closure;
use Illuminate\Http\Request;

class SetTenantFromRoute
{
    public function handle(Request $request, Closure $next)
    {
        /** @var Tenant|null $tenant */
        $tenant = $request->route('tenant');

        app(TenantManager::class)->set($tenant);

        // Seguridad extra: usuario debe pertenecer al tenant
        if ($request->user() && $tenant) {
            $belongs = $tenant->users()
                ->where('users.id', $request->user()->id)
                ->exists();

            abort_unless($belongs, 403, 'You do not belong to this organization.');
        }

        return $next($request);
    }
}
