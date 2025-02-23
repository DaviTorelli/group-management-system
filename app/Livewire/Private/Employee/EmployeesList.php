<?php

namespace App\Livewire\Private\Employee;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

class EmployeesList extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    return view('livewire.private.employee.employees-list');
  }
}
