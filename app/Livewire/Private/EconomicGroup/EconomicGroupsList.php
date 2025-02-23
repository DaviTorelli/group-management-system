<?php

namespace App\Livewire\Private\EconomicGroup;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

class EconomicGroupsList extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    return view('livewire.private.economic-group.economic-groups-list');
  }
}
