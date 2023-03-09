<div>
    <x-danger-button class="ml-4" wire:click="$set('open', true)">
        Crear nuevo post
    </x-danger-button>

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear un nuevo post.
        </x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <x-label value="Título del Post" />
                <x-input type="text" class="w-full" wire:model.defer="title" />
            </div>
            <div class="mb-4">
                <x-label value="Contenido del Post" />
                <x-text-area rows="6" class="w-full" wire:model.defer="content" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-4" wire:click="save">
                Crear post
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
</div>
