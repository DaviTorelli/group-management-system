<?php

namespace App\Livewire\Private\EconomicGroup;

//* Importações Livewire
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\EconomicGroup;

class EconomicGroupsList extends Component
{
  #[Layout("components.layouts.private")]

  public $sortBy = 'name';
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
  public function economicGroups()
  {
    return EconomicGroup::query()
      ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
      ->paginate(5);
  }

  public function destroy(Int $id)
  {
    try {
      $economicGroup = EconomicGroup::findOrFail($id);

      //TODO: Adicionar validação: caso tenham bandeiras no grupo, não deixar excluir
      $economicGroup->delete();
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao excluir grupo econômico");
      return;
    }
  }

  public function render()
  {
    return view('livewire.private.economic-group.economic-groups-list', ['economicGroups' => $this->economicGroups()]);
  }
}
