<?php

namespace App\Livewire\Private\Flag;

//* Importações Livewire
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Flag;

class FlagsList extends Component
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
  public function flags()
  {
    return Flag::query()
      ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
      ->paginate(5);
  }

  public function destroy(Int $id)
  {
    try {
      $economicGroup = Flag::findOrFail($id);

      //TODO: Adicionar validação: caso tenham unidades no grupo, não deixar excluir
      $economicGroup->delete();
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao excluir bandeira");
      return;
    }
  }

  public function render()
  {
    return view('livewire.private.flag.flags-list', ['flags' => $this->flags()]);
  }
}
