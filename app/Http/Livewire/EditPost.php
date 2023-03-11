<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditPost extends Component
{
    use WithFileUploads;
    
    public $open = false;
    public $post, $image, $identificador;

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
    ];

    public function mount(Post $post){
        $this->post = $post;
        // Identificador creado de la imagen
        $this->identificador = rand(); 
    }

    public function save(){
        
        $this->validate();

        // Eliminar la imagen guardada para almacenar la nueva
        if ($this->image) {
            Storage::delete([$this->post->image]);

            // Codigo que remplaza la nueva imagen
            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open', 'image']);
        $this->identificador = rand();
        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se actualizó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
