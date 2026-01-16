@props([
    'title',
    'description',
])

<div class="space-y-3 text-center">
    <p class="text-xs font-semibold uppercase tracking-[0.45em] text-red-400">Acceso seguro</p>
    <h2 class="text-2xl font-semibold tracking-tight text-white">{{ $title }}</h2>
    <p class="text-sm text-white/60">{{ $description }}</p>
</div>
