<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <x-table>
            <div class="px-6 py-4 flex items-center">

                <div class="flex items-center">
                    <span>Mostrar:</span>
                    <select wire:model="cant" class="mx-2 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <span>entradas</span>
                </div>

                <x-input class="flex-1 mx-4" placeholder="Inserte parámetros de busqueda." type="text" wire:model="search" />

                @livewire('create-post')
            </div>

            @if ($posts->count())
                <table class="w-full min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="cursor-pointer py-3 text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2" wire:click="order('id')">
                                ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort mt-1"></i>
                                @endif
                            </th>
                            <th scope="col" class="cursor-pointer py-3 text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2" wire:click="order('title')">
                                Title
                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-1"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-1"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort mt-1"></i>
                                @endif                            
                            </th>
                            <th scope="col" class="cursor-pointer py-3 text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2" wire:click="order('content')">
                                Content
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt mt-"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt mt-"></i>
                                    @endif
                                @else
                                    <i class="fas fa-sort mt-1"></i>
                                @endif
                            </th> 
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2">
                                <span class="sr-only">Acciones</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $item)
                            <tr>
                                <td class="px-6 py-4 border-b-2">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->id }}</div>
                                </td>
                                <td class="px-6 py-4 border-b-2">
                                    <div class="text-sm text-gray-500">{{ $item->title }}</div>
                                </td>
                                <td class="px-6 py-4 border-b-2">
                                    <div class="text-sm text-gray-500">{{ $item->content }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm font-medium border-b-2">
                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                    <a class="btn btn-green" wire:click="edit({{ $item }})">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>   
                        @endforeach                 
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4">No existen parámetros para la busqueda.</div>
            @endif   
            
            @if ($posts->hasPages())
                <div class="px-6 py-3">
                    {{ $posts->links() }}
                </div>                
            @endif
        </x-table>                    
    </div>
    
    {{-- Modal para edicion del post  --}}
    <x-dialog-modal wire:model="open_edit">
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
            <x-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-secondary-button>
            <x-danger-button class="ml-4 disabled:opacity-25" wire:click="update" wire:loading.attr="disabled">
                Actualizar
            </x-danger-button>
        </x-slot>
    </x-dialog-modal>
</div>

