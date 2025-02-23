<?php

namespace App\Livewire\Private;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de libs
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
  #[Layout("components.layouts.private")]

  public string $name = "";

  public function mount()
  {
    $this->name = Auth::user()->name ?? 'Usuário';
  }

  public function render()
  {
    return view('livewire.private.home');
  }
}
