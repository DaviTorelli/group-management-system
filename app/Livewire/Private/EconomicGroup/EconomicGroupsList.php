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

      if ($economicGroup->flags()->exists()) {
        session()->flash("error", "Não é possível excluir este grupo econômico, pois existem bandeiras vinculadas a ele.");
        return;
      }

      $economicGroup->delete();
      session()->flash("success", "Grupo econômico excluído com sucesso!");
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao excluir grupo econômico");
    }
  }

  public function render()
  {
    return view('livewire.private.economic-group.economic-groups-list', ['economicGroups' => $this->economicGroups()]);
  }
}
