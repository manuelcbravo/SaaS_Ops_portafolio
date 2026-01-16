<flux:modal wire:model.self="showModalRol" class="max-w-4xl w-full" :dismissible="false">
    <div class="space-y-6">
        <flux:heading size="lg"> {{ isset($form['id']) ? 'Editar Rol' : 'Nuevo Rol' }} </flux:heading>
        <form wire:submit.prevent="save" class="space-y-12">
            <flux:input label="Rol" wire:model.defer="form.name"/>

            <flux:separator />

            <div class="mb-2">
                <flux:heading>Permisos</flux:heading>
                <flux:text class="mt-1">Permisos del cliente.</flux:text>
            </div>
            <flux:checkbox.group wire:model.defer="form.permissions">
                <div class="px-4 pb-4 overflow-x-auto rounded-xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-gray-950">
                    <flux:table class="min-w-full text-sm">
                        <flux:table.columns class="bg-gray-50 dark:bg-gray-900/40 border-b border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 font-medium uppercase tracking-wide text-xs">
                            <flux:table.column class="pl-2">
                                <flux:checkbox.all />
                            </flux:table.column>
                            <flux:table.column>Módulo</flux:table.column>
                            <flux:table.column>Descripción</flux:table.column>
                        </flux:table.columns>
                        <flux:table.rows>
                            @forelse ($permisos as $permiso)
                                <flux:table.row :key="$permiso->id" class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors duration-150">
                                    <flux:table.cell class="whitespace-nowrap">
                                        <flux:checkbox value="{{ $permiso->id }}" />
                                    </flux:table.cell>
                                    <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $permiso->modulo }}</flux:table.cell>
                                    <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $permiso->description }}</flux:table.cell>
                                </flux:table.row>
                            @empty
                                @include('partials.table.table-no-info', ['colspan' => 3])
                            @endforelse
                        </flux:table.rows>
                    </flux:table>
                </div>
            </flux:checkbox.group>

            <div class="flex gap-2">
                <flux:spacer />
                <flux:button type="submit" icon="check">Guardar</flux:button>
                <flux:modal.close>
                    <flux:button variant="ghost" icon="x-mark">Cancelar</flux:button>
                </flux:modal.close>
            </div>
        </form>
    </div>

</flux:modal>