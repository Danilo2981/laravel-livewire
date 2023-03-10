<div>
    <x-danger-button class="ml-4" wire:click="$set('open', true)">
        Crear nuevo post
    </x-danger-button>

    <x-dialog-modal wire:model="open">

        <x-slot name="title">
            Crear un nuevo post.
        </x-slot>

        <x-slot name="content">

            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">!Imagen Cargando¡</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
            @endif

            <div class="mb-4">
                <x-label value="Título del Post" />
                <x-input type="text" class="w-full" wire:model.defer="title" />

                <x-input-error for="title" />
            </div>
            <div class="mb-4">
                <x-label value="Contenido del Post" />
                <x-text-area rows="6" class="w-full" wire:model.defer="content" />

                <x-input-error for="content" />
            </div>
            <div>
                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for="image" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-4 disabled:opacity-25" wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Crear post
            </x-danger-button>
        </x-slot>

    </x-dialog-modal>
</div>
