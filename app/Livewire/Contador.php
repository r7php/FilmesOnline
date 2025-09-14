<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
class Contador extends Component
{
    public function render()
    {
        use WithPagination;

        return view('livewire.contador'[
            'users' => User::paginate(10)
        ]);
        //return view('livewire.contador');
    }
}
