<div class="p-6 space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <flux:heading size="xl">Planes</flux:heading>
        <flux:button wire:click="$dispatch('newPlanModal')" icon="plus">Nuevo plan</flux:button>
    </div>

    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <flux:input placeholder="Buscar plan" class="w-full md:w-1/3" wire:model.live="search" size="sm" />
    </div>

    <div class="px-4 pb-6 overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-950">
        <flux:table :paginate="$items" class="min-w-full text-sm">
            <flux:table.columns class="bg-gray-50 dark:bg-gray-900/40 border-b border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 font-medium uppercase tracking-wide text-xs">
                <flux:table.column class="pl-2">Plan</flux:table.column>
                <flux:table.column>Precio</flux:table.column>
                <flux:table.column>Usuarios</flux:table.column>
                <flux:table.column>Espacio</flux:table.column>
                <flux:table.column class="text-right pr-3">Acciones</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse ($items as $item)
                    <flux:table.row :key="$item->id" class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors duration-150">
                        <flux:table.cell>
                            <div class="flex flex-col text-gray-700 dark:text-gray-200">
                                <span class="font-semibold text-gray-900 dark:text-gray-100">{{ $item->nombre }}</span>
                                @if ($item->descripcion)
                                    <span class="text-xs text-gray-500 dark:text-gray-400">{{ \Illuminate\Support\Str::limit($item->descripcion, 90) }}</span>
                                @endif
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap font-semibold text-gray-900 dark:text-gray-100">
                            ${{ Formats::formatCurrency($item->precio) }}
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $item->usuarios }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $item->espacio_gb }} GB</flux:table.cell>
                        <flux:table.cell class="text-right pr-3">
                            <flux:dropdown align="end">
                                <flux:button icon:trailing="chevron-down" class="text-sm" size="sm">Opciones</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" wire:click="$dispatch('editPlanModal', { addId: {{ $item->id }} })">Editar</flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item
                                        variant="danger"
                                        icon="trash"
                                        class="text-red-500! [&_[data-flux-menu-item-icon]]:text-red-500"
                                        wire:click="$dispatch('confirmDelete', {
                                                        title: '¿Eliminar plan?',
                                                        message: 'Esta acción no se puede deshacer.',
                                                        action: 'deletePlan',
                                                        id: {{ $item->id }}
                                                    })">
                                        Eliminar
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    @include('partials.table.table-no-info', ['colspan' => 5])
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    <livewire:config.planes.modal-add />
    <livewire:general.modal-delete />
</div>
