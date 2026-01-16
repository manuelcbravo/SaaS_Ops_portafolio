@props([
    'title' => 'Sección',
    'description' => null,
    'items' => [],
])

<div class="relative overflow-hidden rounded-[2.5rem] border border-slate-200/80 bg-slate-950 px-8 py-12 text-slate-100 shadow-[0_45px_120px_-60px_rgba(15,23,42,0.85)] dark:border-slate-800 dark:bg-slate-950/95">
    <div class="pointer-events-none" aria-hidden="true">
        <div class="absolute -left-24 top-[-6rem] h-64 w-64 rounded-full bg-gradient-to-br from-blue-500/40 via-transparent to-transparent blur-3xl"></div>
        <div class="absolute -right-16 bottom-[-4rem] h-72 w-72 rounded-full bg-gradient-to-br from-slate-400/30 via-transparent to-transparent blur-3xl"></div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(148,163,184,0.18),_transparent_58%)]"></div>
        <div class="absolute inset-x-12 top-24 h-px bg-gradient-to-r from-transparent via-slate-500/40 to-transparent"></div>
    </div>

    <div class="relative z-10 mx-auto flex max-w-5xl flex-col gap-6">
        <div class="flex flex-col items-start gap-4 md:flex-row md:items-center md:justify-between">
            <div class="space-y-3">
                <span class="inline-flex items-center gap-2 rounded-full border border-slate-800/60 bg-white/5 px-4 py-1 text-[0.68rem] font-semibold uppercase tracking-[0.35em] text-slate-300 shadow-[0_10px_30px_rgba(15,23,42,0.35)] dark:border-white/10 dark:bg-white/10">
                    {{ __('Colección') }}
                </span>
                <flux:heading size="2xl" class="text-3xl font-semibold tracking-tight text-white sm:text-4xl">
                    {{ $title }}
                </flux:heading>
                @if ($description)
                    <flux:text class="max-w-2xl text-base text-slate-300">
                        {{ $description }}
                    </flux:text>
                @endif
            </div>
            <div class="flex items-center gap-3 rounded-2xl border border-white/10 bg-white/10 px-4 py-3 backdrop-blur">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-blue-400/80 via-sky-500/70 to-blue-700/80 text-white shadow-[0_20px_45px_rgba(56,189,248,0.45)]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path fill-rule="evenodd" d="M3.75 6A2.75 2.75 0 016.5 3.25h11A2.75 2.75 0 0120.25 6v12A2.75 2.75 0 0117.5 20.75h-11A2.75 2.75 0 013.75 18V6zm3-1.25a1.25 1.25 0 00-1.25 1.25v12A1.25 1.25 0 006.75 19.25h11a1.25 1.25 0 001.25-1.25V6A1.25 1.25 0 0017.75 4.75h-11z" clip-rule="evenodd" />
                        <path d="M8.5 7.75a.75.75 0 01.75-.75h5.5a.75.75 0 010 1.5h-5.5a.75.75 0 01-.75-.75zm0 3.5a.75.75 0 01.75-.75h3.5a.75.75 0 010 1.5h-3.5a.75.75 0 01-.75-.75zm0 3.5a.75.75 0 01.75-.75h4.5a.75.75 0 010 1.5h-4.5a.75.75 0 01-.75-.75z" />
                    </svg>
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">{{ __('Panel') }}</p>
                    <p class="text-sm font-semibold text-white">{{ __('Selecciona una sección para continuar') }}</p>
                </div>
            </div>
        </div>

        <div class="relative mt-6">
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($items as $item)
                    @php
                        $routeParameters = $item['params'] ?? [];
                    @endphp
                    <a
                        href="{{ route($item['url'], $routeParameters) }}"
                        class="group relative flex min-h-[220px] flex-col justify-between overflow-hidden rounded-3xl border border-white/10 bg-white/5 p-6 text-white shadow-[0_35px_80px_-50px_rgba(56,189,248,0.45)] transition-all duration-300 hover:-translate-y-2 hover:border-blue-400/40 hover:bg-white/10 hover:shadow-[0_55px_120px_-60px_rgba(59,130,246,0.55)] focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-400/80"
                        wire:navigate
                    >
                        <span class="pointer-events-none absolute inset-0">
                            <span class="absolute inset-0 bg-gradient-to-br from-white/0 via-white/5 to-white/0 opacity-0 transition duration-300 group-hover:opacity-100"></span>
                            <span class="absolute -right-16 top-8 h-36 w-36 rounded-full bg-gradient-to-br from-sky-400/40 via-transparent to-transparent blur-3xl transition-all duration-300 group-hover:scale-125 group-hover:opacity-90"></span>
                            <span class="absolute -left-20 bottom-0 h-32 w-32 rounded-full bg-gradient-to-tr from-blue-500/20 via-transparent to-transparent blur-3xl"></span>
                        </span>

                        <div class="relative z-10 flex items-start justify-between gap-4">
                            <div class="space-y-3">
                                <p class="text-[0.65rem] uppercase tracking-[0.45em] text-slate-400 group-hover:text-slate-300">{{ __('Sección') }}</p>
                                <h3 class="text-2xl font-semibold tracking-tight text-white">{{ $item['title'] }}</h3>
                            </div>
                            <span class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border border-white/20 bg-white/10 text-white transition-all duration-300 group-hover:border-blue-400/60 group-hover:bg-blue-500/60">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                </svg>
                            </span>
                        </div>

                        <p class="relative z-10 text-sm text-slate-300 transition-colors duration-300 group-hover:text-slate-100">
                            {{ $item['description'] }}
                        </p>

                        <div class="relative z-10 mt-6 flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.35em] text-slate-400">
                            <span class="h-px flex-1 bg-gradient-to-r from-transparent via-slate-500/40 to-transparent"></span>
                            <span>{{ __('Explorar') }}</span>
                            <span class="h-px flex-1 bg-gradient-to-r from-transparent via-slate-500/40 to-transparent"></span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
