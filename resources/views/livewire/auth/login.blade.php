<?php

use App\Http\Middleware\EnsureEmpresaSubscriptionIsActive;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        $authenticatedUser = Auth::user();

        //if (! $authenticatedUser?->estatus) {
            //Auth::logout();

            //throw ValidationException::withMessages([
                //'email' => __('Tu cuenta aún no ha sido activada. Revisa tu correo electrónico.'),
            //]);
        //}

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        //$subscriptionChecker = app(EnsureEmpresaSubscriptionIsActive::class);

        //if ($subscriptionChecker->shouldBypassSubscriptionCheck($authenticatedUser)) {
            $defaultRoute = route('dashboard', absolute: false);
        //} else {
            //$subscriptionState = $subscriptionChecker->determineSubscriptionState($authenticatedUser);

            //$defaultRoute = match ($subscriptionState) {
                //'active' => route('dashboard', absolute: false),
                //'expired' => route('subscription.renewal', absolute: false),
                //default => route('subscription.welcome', absolute: false),
            //};
        //}

        $this->redirectIntended(default: $defaultRoute, navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-6 text-white">
    <x-auth-header :title="__('Log in to your account')" :description="__('Ingresa tus credenciales para continuar')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center text-sm text-red-400" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <div class="space-y-2 text-left text-xs uppercase tracking-[0.35em] text-white/40">Credenciales</div>

        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-xs uppercase tracking-[0.3em] text-white/50" :href="route('password.request')" wire:navigate>
                    {{ __('Forgot your password?') }}
                </flux:link>
            @endif
        </div>

        <div class="flex items-center justify-between text-sm text-white/60">
            <flux:checkbox wire:model="remember" :label="__('Remember me')" />
        </div>

        <flux:button variant="primary" type="submit" class="w-full justify-center bg-red-500 hover:bg-red-600 focus-visible:ring-2 focus-visible:ring-red-500">
            {{ __('Log in') }}
        </flux:button>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <p>{{ __('¿Aún no tienes una cuenta?') }}</p>
            <flux:link :href="route('register')" wire:navigate class="font-semibold text-white hover:text-red-400">{{ __('Sign up') }}</flux:link>
        </div>
    @endif
</div>
