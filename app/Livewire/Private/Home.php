<?php

namespace App\Livewire\Private;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

class Home extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    return view('livewire.private.home');
  }
}
