<?php

namespace App\Support;

use App\Models\Tenant;

class TenantManager
{
    protected ?Tenant $tenant = null;

    public function set(?Tenant $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function get(): ?Tenant
    {
        return $this->tenant;
    }

    public function id(): ?string
    {
        return $this->tenant?->id;
    }

    public function required(): Tenant
    {
        return $this->tenant ?? throw new \RuntimeException('Tenant not resolved.');
    }
}
