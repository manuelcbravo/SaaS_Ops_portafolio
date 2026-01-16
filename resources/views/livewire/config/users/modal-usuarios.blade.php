<flux:modal wire:model.self="showModalUsuario" class="max-w-4xl w-full" :dismissible="false">
    <div class="space-y-6">
        <flux:heading size="lg"> {{ isset($form['id']) ? 'Editar Usuario' : 'Nuevo Usuario' }} </flux:heading>
        <form wire:submit.prevent="save" class="space-y-12">
            <div class="mb-2">
                <flux:heading>Datos generales</flux:heading>
                <flux:text class="mt-1"></flux:text>
            </div>
            <flux:field class="mb-3" >
                <flux:input label="Nombre" wire:model.defer="form.name" class="mb-0" />
            </flux:field>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input label="Correo electrónico" wire:model.defer="form.email" type="email"/>
                @if ($canManagePassword)
                    <flux:input label="Password" wire:model.defer="form.password" type="password" helper="Déjalo vacío para enviar un enlace de activación al usuario."/>
                @endif
                <flux:select label="Rol" wire:model.defer="form.rol" placeholder="Selecciona el rol..." variant="listbox">
                    @foreach($roles as $rol)
                        <flux:select.option value="{{ $rol->id }}" wire:key="{{ $rol->id }}">{{ $rol->name }}</flux:select.option>
                    @endforeach
                </flux:select>
                @if ($canSelectEmpresa)
                    <flux:select label="Empresas" wire:model.defer="form.id_empresa" placeholder="Selecciona...">
                        @foreach($empresas as $empresa)
                            <flux:select.option value="{{ $empresa->id }}" wire:key="{{ $empresa->id }}">{{ $empresa->nombre }}</flux:select.option>
                        @endforeach
                    </flux:select>
                @else
                    <flux:input label="Empresa" :value="$empresas->first()->nombre ?? ''" disabled />
                    <input type="hidden" wire:model.defer="form.id_empresa" />
                @endif
            </div>


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