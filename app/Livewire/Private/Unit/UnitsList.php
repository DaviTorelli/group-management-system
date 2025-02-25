<?php

namespace App\Livewire\Private\Unit;

//* Importações Livewire
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Unit;

class UnitsList extends Component
{
	#[Layout("components.layouts.private")]

	public $sortBy = 'legal_name';
	public $sortDirection = 'desc';

	public function sort($column)
	{
		if ($this->sortBy === $column) {
			$this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
		} else {
			$this->sortBy = $column;
			$this->sortDirection = 'asc';
		}
	}

	#[Computed()]
	public function units()
	{
		return Unit::query()
			->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
			->paginate(5);
	}

	public function destroy(Int $id)
	{
		try {
			$unit = Unit::findOrFail($id);

			//TODO: Adicionar validação: caso tenham colaboradores na unidade, não deixar excluir
			$unit->delete();
		} catch (\Exception $e) {
			session()->flash("error", "Erro ao excluir unidade");
			return;
		}
	}

	public function render()
	{
		return view('livewire.private.unit.units-list', ['units' => $this->units()]);
	}
}
