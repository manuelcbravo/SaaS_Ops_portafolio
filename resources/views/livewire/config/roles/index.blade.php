<div class="p-6 space-y-6">
    <div class="flex justify-between items-center mb-4">
        <flux:heading size="xl">Roles</flux:heading>
        <flux:button wire:click="create" icon="plus">Nuevo Rol</flux:button>
    </div>
    <div class="px-4 pb-6 overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-950">
        <flux:table :paginate="$permisos" class="min-w-full text-sm">
            <flux:table.columns class="bg-gray-50 dark:bg-gray-900/40 border-b border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 font-medium uppercase tracking-wide text-xs">
                <flux:table.column class="pl-2">Rol</flux:table.column>
                <flux:table.column>Última actualización</flux:table.column>
                <flux:table.column class="text-right pr-3">Acciones</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse($permisos as $permiso)
                    <flux:table.row :key="$permiso->id" class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors duration-150">
                        <flux:table.cell class="flex items-center gap-3">
                            <div class="flex items-center gap-3 text-gray-700 dark:text-gray-200">
                                <flux:avatar name="{{ $permiso->name }}" size="sm" />
                                <span class="font-medium">{{ $permiso->name }}</span>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="text-gray-600 dark:text-gray-400">{{ $permiso->updated_at }}</flux:table.cell>
                        <flux:table.cell class="text-right pr-3">
                            <flux:dropdown align="end">
                                <flux:button icon:trailing="chevron-down" class="text-sm" size="sm">Opciones</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil" wire:click="edit({{ $permiso->id }})">Editar
                                    </flux:menu.item>
                                    <flux:menu.separator />
                                    <flux:menu.item variant="danger" icon="trash"
                                        class="text-red-500! [&_[data-flux-menu-item-icon]]:text-red-500"
                                        wire:click="delete({{ $permiso->id }})"
                                        wire:confirm.prompt="¿Estás seguro?\n\nEscribe DELETE para confirmar|DELETE">
                                        Eliminar
                                    </flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    @include('partials.table.table-no-info', ['colspan' => 3])
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>
    {{ $permisos->links() }}    

    <livewire:config.roles.modal-rol/>  

</div>
