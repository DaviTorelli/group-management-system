<?php

namespace App\Livewire\Private\Brand;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

class BrandsList extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    return view('livewire.private.brand.brands-list');
  }
}
