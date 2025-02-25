<?php

namespace App\Livewire\Private\Employee;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;
use App\Models\Unit;

class EditEmployee extends Component
{
  #[Layout("components.layouts.private")]

  public int $employeeId;
  public string $name = "";
  public string $email = "";
  public int $cpf;
  public int $unitId;
  public array $units = [];

  public $isLoading = true; // comportamento 'loading' da página

  public function mount($id)
  {
    $employee = Employee::find($id);

    if (!$employee) return redirect()->route("employees");

    $this->employeeId = $employee->id;
    $this->name = $employee->name;
    $this->email = $employee->email;
    $this->cpf = $employee->cpf;
    $this->unitId = $employee->unit_id;
    $this->units = Unit::all()->toArray();

    $this->isLoading = false; // depois do 'mount', não está mais carregando
  }

  public function update()
  {
    $this->validate([
      "name"   => "required|min:2|max:100",
      "email"  => "required|email|min:2|max:100", //TODO unique + digitar mesmo e-mail
      "cpf"    => "required", //TODO: validação + unique + digitar mesmo cpf
      "unitId" => "required|exists:units,id"
    ], [
      "required" => "Campo obrigatório",
      "email"    => "E-mail inválido",
      "min"      => "O campo deve ter no mínimo :min caracteres",
      "max"      => "O campo deve ter no máximo :max caracteres",
      "unitId.exists" => "A unidade não foi encontrada"
    ]);

    try {
      Employee::findOrFail($this->employeeId)->update([
        "name"    => $this->name,
        "email"   => $this->email,
        "cpf"     => $this->cpf,
        "unit_id" => $this->unitId
      ]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao editar colaborador");
      return;
    }

    return redirect()->route("employees");
  }

  public function render()
  {
    return view('livewire.private.employee.edit-employee', [
      'units' => $this->units
    ]);
  }
}
