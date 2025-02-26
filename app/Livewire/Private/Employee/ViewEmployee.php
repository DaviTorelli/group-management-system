<?php

namespace App\Livewire\Private\Employee;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;

class ViewEmployee extends Component
{
  #[Layout("components.layouts.private")]

  public Employee $employee;

  public $isLoading = true; // comportamento 'loading' da página

  public function mount($id)
  {
    $employee = Employee::find($id);

    if (!$employee) return redirect()->route("employees");

    $this->employee = $employee;

    $this->isLoading = false; // depois do 'mount', não está mais carregando
  }

  public function render()
  {
    return view('livewire.private.employee.view-employee');
  }
}
