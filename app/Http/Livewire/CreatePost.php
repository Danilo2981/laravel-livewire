<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;

    public $open = false;

    public $title, $content, $image, $identificador;

    public function mount(){
        $this->identificador = rand(); 
    }

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required|image|max:2048'
    ];

    // public function updated($propiertyName){
    //     $this->validateOnly($propiertyName);
    // }

    public function save(){

        $this->validate();

        $image = $this->image->store('public/posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'image' => $image,
        ]);

        $this->reset([
            'open', 'title', 'content', 'image'
        ]);

        $this->identificador = rand();

        $this->emitTo('show-posts','render');
        $this->emit('alert', 'El post se creó satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    // Funcion para que cuando se de click fuera del modal se borre la info al volverlo a abrir
    public function updatingOpen() {
        if ($this->open == false) {
            $this->reset(['content', 'title', 'image']);
            $this->identificador = rand();
            $this->emit('resetCKEditor');
        }
    }

}
