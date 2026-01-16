<div class="p-6 space-y-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
        <div>
            <flux:heading size="xl">Usuarios</flux:heading>
            @if (! is_null($availableSlots))
                <flux:text class="text-sm text-slate-500">{{ $availableSlots > 0 ? $availableSlots . ' lugares disponibles en tu plan' : 'Sin lugares disponibles en tu plan' }}</flux:text>
            @endif
        </div>
        <div class="flex flex-col gap-2 md:flex-row md:items-center md:gap-3">
            <flux:input placeholder="Buscar" class="w-full md:w-64" wire:model.live="search" size="sm" clearable icon="magnifying-glass" />
            @if(! $canCreateUser && Auth::user()->rol == 0)<flux:button icon="plus" wire:click="create">Nuevo usuario</flux:button>@endif
            <flux:button icon="plus" wire:click="create">Nuevo usuario</flux:button>
        </div>
    </div>

    @if (! $canCreateUser)
        <flux:callout icon="shield-exclamation" color="amber">
            Has alcanzado el límite de usuarios para tu plan actual. Actualiza tu plan o elimina usuarios para crear nuevos perfiles.
        </flux:callout>
    @endif

    <div class="px-4 pb-6 overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-800 dark:bg-gray-950">
        <flux:table :paginate="$users" class="min-w-full text-sm">
            <flux:table.columns class="bg-gray-50 dark:bg-gray-900/40 border-b border-gray-200 dark:border-gray-800 text-gray-600 dark:text-gray-300 font-medium uppercase tracking-wide text-xs">
                <flux:table.column class="pl-2">Nombre</flux:table.column>
                <flux:table.column>Email</flux:table.column>
                <flux:table.column>Empresa</flux:table.column>
                <flux:table.column>Estatus</flux:table.column>
                <flux:table.column class="text-right pr-3">Acciones</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @forelse($users as $user)
                    <flux:table.row :key="$user->id" class="hover:bg-gray-50 dark:hover:bg-gray-900/30 transition-colors duration-150">
                        <flux:table.cell class="whitespace-nowrap">
                            <div class="flex items-center gap-3 text-gray-700 dark:text-gray-200">
                                <flux:avatar name="{{ $user->name }}" size="sm"/>
                                <span class="font-medium">{{ $user->name }}</span>
                            </div>
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $user->email }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-gray-600 dark:text-gray-300">{{ $user->empresa->nombre ?? 'desarrollo' }}</flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap">
                            <flux:switch
                                wire:model.live="estatus.{{ $user->id }}"
                            />
                        </flux:table.cell>
                        <flux:table.cell class="whitespace-nowrap text-right pr-3">
                            <flux:button flat color="gray" size="xs" wire:click="edit({{ $user->id }})">
                                Editar
                            </flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @empty
                    @include('partials.table.table-no-info', ['colspan' => 5])
                @endforelse
            </flux:table.rows>
        </flux:table>
    </div>

    {{ $users->links() }}

    <livewire:config.users.modal-usuarios/>  

</div>
