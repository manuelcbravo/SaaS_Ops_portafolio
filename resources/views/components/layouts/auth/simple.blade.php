<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-neutral-950 text-neutral-50 antialiased">
        <div class="relative flex min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(215,0,33,0.18),_transparent_55%)]"></div>
            <div class="pointer-events-none absolute inset-0 -z-20 bg-[radial-gradient(circle_at_bottom_right,_rgba(15,23,42,0.9),_rgba(2,6,23,0.95))]"></div>

            <div class="relative hidden flex-1 flex-col justify-between bg-gradient-to-br from-neutral-950 via-neutral-900 to-neutral-950 px-16 py-12 text-white lg:flex" style="background-image: url('{{ asset('assets/img/background.png') }}');">
                <div class="flex items-center gap-3 text-sm uppercase tracking-[0.4em] text-white/60">
                    <img src="{{ asset('assets/img/logos/logo_dark.png') }}" alt="Logo" class="h-12" />
                </div>
                <div class="space-y-6">
                    <p class="text-xs font-semibold uppercase tracking-[0.45em] text-red-400">Bienvenido</p>
                    <h1 class="text-4xl font-semibold tracking-tight">Conecta con el ecosistema premium</h1>
                    <p class="max-w-md text-base text-white/70">Administra inventarios, gestiona leads y ofrece una experiencia de compra inspirada en las vitrinas digitales.</p>
                </div>
                <div class="flex items-center gap-6 text-sm text-white/60">
                    <span class="inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Seguridad empresarial
                    </span>
                    <span class="inline-flex items-center gap-3 rounded-full border border-white/20 bg-white/10 px-4 py-2">
                        <span class="h-2 w-2 rounded-full bg-red-500"></span>
                        Datos en tiempo real
                    </span>
                </div>
            </div>

            <div class="w-full lg:w-1/3 flex items-center justify-center bg-white/5 backdrop-blur-md p-10">
                <div class="w-full max-w-md text-white">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 text-sm font-semibold uppercase tracking-[0.35em] text-white/60 items-center justify-center" wire:navigate>
                        <img src="{{ asset('assets/img/logos/logo_dark.png') }}" alt="Logo" class="h-10" />
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
