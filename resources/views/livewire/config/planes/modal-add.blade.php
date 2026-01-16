<flux:modal wire:model.self="showModalAdd" class="max-w-2xl w-full" :dismissible="false">
    <div class="space-y-6">
        <flux:heading size="lg">{{ isset($form['id']) ? 'Editar' : 'Nuevo' }} plan</flux:heading>

        <form wire:submit.prevent="save" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Nombre del plan" wire:model="form.nombre" />
                <flux:input
                    label="Precio"
                    icon="currency-dollar"
                    mask:dynamic="$money($input)"
                    wire:model.defer="form.precio"
                />
                <flux:input type="number" min="1" label="Cantidad de usuarios" wire:model="form.usuarios" />
                <flux:input type="number" min="1" label="Espacio (GB)" wire:model="form.espacio_gb" />
            </div>

            <flux:textarea label="Descripción" rows="4" wire:model="form.descripcion" placeholder="Describe brevemente lo que incluye el plan" />

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
