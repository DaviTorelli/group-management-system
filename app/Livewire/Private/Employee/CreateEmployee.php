<?php

namespace App\Livewire\Private\Employee;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;
use App\Models\Unit;

class CreateEmployee extends Component
{
  #[Layout("components.layouts.private")]

  public string $name = "";
  public string $email = "";
  public int $cpf;
  public int $unitId;
  public array $units = [];

  public function mount()
  {
    $this->units = Unit::all()->toArray();
  }

  public function store()
  {
    $this->validate([
      "name"   => "required|min:2|max:100",
      "email"  => "required|email|min:2|max:100|unique:employees",
      "cpf"     => "required|size:11|cpf|unique:employees",
      "unitId" => "required|exists:units,id"
    ], [
      "required"      => "Campo obrigatório",
      "email.email"   => "E-mail inválido",
      "email.unique"  => "Este e-mail já está em uso",
      "cpf.size"       => "O campo deve ter :size caracteres",
      "cpf.unique"     => "Este CPF já está em uso",
      "min"           => "O campo deve ter no mínimo :min caracteres",
      "max"           => "O campo deve ter no máximo :max caracteres",
      "unitId.exists" => "A unidade não foi encontrada"
    ]);

    try {
      Employee::create([
        "name"    => $this->name,
        "email"   => $this->email,
        "cpf"     => $this->cpf,
        "unit_id" => $this->unitId
      ]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao criar colaborador");
      return;
    }

    return redirect()->route("employees");
  }

  public function render()
  {
    return view('livewire.private.employee.create-employee', [
      'units' => $this->units
    ]);
  }
}
