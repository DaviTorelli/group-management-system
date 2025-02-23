<?php

namespace App\Livewire\Private\Unit;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

class UnitsList extends Component
{
	#[Layout("components.layouts.private")]

	public function render()
	{
		return view('livewire.private.unit.units-list');
	}
}
