<?php

namespace App\Livewire\Private\Employee;

//* Importações Livewire
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;

class EmployeesList extends Component
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
  public function employees()
  {
    return Employee::query()
      ->tap(fn($query) => $this->sortBy ? $query->orderBy($this->sortBy, $this->sortDirection) : $query)
      ->paginate(5);
  }

  public function destroy(Int $id)
  {
    try {
      Employee::findOrFail($id)->delete();
      session()->flash("success", "Colaborador excluído com sucesso!");
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao excluir colaborador");
      return;
    }
  }

  public function render()
  {
    return view('livewire.private.employee.employees-list', ['employees' => $this->employees()]);
  }
}
