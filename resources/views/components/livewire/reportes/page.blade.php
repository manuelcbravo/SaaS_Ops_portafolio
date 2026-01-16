@props([
    'title',
    'description' => null,
    'downloadRoute' => null,
    'fields' => [],
])

<div class="p-6 space-y-4">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <div>
            <flux:heading size="xl">{{ $title }}</flux:heading>
            @if ($description)
                <flux:text class="text-sm text-slate-500">{{ $description }}</flux:text>
            @endif
        </div>
        @if ($downloadRoute)
            <flux:button tag="a" href="{{ $downloadRoute }}" icon="arrow-down-tray" variant="primary">
                Descargar Excel
            </flux:button>
        @endif
    </div>

    <flux:callout color="blue" icon="document-arrow-down">
        Los datos se descargan desde Matweb Excel y solo incluyen información de tu empresa actual.
    </flux:callout>

    @if (! empty($fields))
        <flux:card class="p-4 space-y-2">
            <flux:text class="text-sm text-slate-500">Columnas incluidas</flux:text>
            <div class="flex flex-wrap gap-2 text-sm">
                @foreach ($fields as $field)
                    <flux:badge color="slate">{{ $field }}</flux:badge>
                @endforeach
            </div>
        </flux:card>
    @endif
</div>
