<div>
    <a class="btn btn-green" wire:click="$set('open', true)">
        <i class="fas fa-edit"></i>
    </a>

    <x-dialog-modal wire:model="open">
        <x-slot name='title'>
            Editar el post {{ $post->title }}
        </x-slot>
        <x-slot name='content'>
            <div wire:loading wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">!Imagen Cargando¡</strong>
                <span class="block sm:inline">Espere un momento hasta que la imagen se haya procesado.</span>
            </div>

            {{-- Con else accede a la imagen guardada --}}
            @if ($image)
                <img class="mb-4" src="{{ $image->temporaryUrl() }}" alt="">
            @else
                <img class="mb-4" src="{{ Storage::url($post->image) }}" alt="">
            @endif

            <div class="mb-4">
                <x-label value="Título del post" />
                <x-input wire:model="post.title" type="text" class="w-full"/>
            </div>
            <div>

                <x-label value="Contenido del post" />
                <x-text-area wire:model="post.content" rows="6" class="w-full" />
            </div>
            <div>

                <input type="file" wire:model="image" id="{{ $identificador }}">
                <x-input-error for="image" />
            </div>
        </x-slot>
        <x-slot name='footer'>
            <x-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-4 disabled:opacity-25" wire:click="save" wire:loading.attr="disabled">
                Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>
