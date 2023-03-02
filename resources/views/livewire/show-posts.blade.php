<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="px-6 py-4 whitespace-nowrap border-b-2">
            <x-input type="text" wire:model="search">
                {{ $search }}
            </x-input>            
        </div>

        <x-table>
            <table class="w-full min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2">
                            Title
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2">
                            Content
                        </th> 
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b-2">
                            <span class="sr-only">Acciones</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border-b-2">
                                <div class="text-sm font-medium text-gray-900">{{ $post->id }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b-2">
                                <div class="text-sm text-gray-500">{{ $post->title }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border-b-2">
                                <div class="text-sm text-gray-500">{{ $post->content }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium border-b-2">
                                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </td>
                        </tr>   
                    @endforeach                 
                </tbody>
            </table>    
        </x-table>                    
    </div>                
</div>

