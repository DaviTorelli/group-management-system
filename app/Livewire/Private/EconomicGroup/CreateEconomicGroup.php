<?php

namespace App\Livewire\Private\EconomicGroup;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\EconomicGroup;

class CreateEconomicGroup extends Component
{
  #[Layout("components.layouts.private")]

  public string $name = "";

  public function store()
  {
    $this->validate([
      "name" => "required|min:2|max:100",
    ], [
      "required" => "Campo obrigatório",
      "min"      => "O campo deve ter no mínimo :min caracteres",
      "max"      => "O campo deve ter no máximo :max caracteres"
    ]);

    try {
      EconomicGroup::create(["name" => $this->name]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao criar grupo econômico");
      return;
    }

    return redirect()->route("economic-groups");
  }

  public function render()
  {
    return view('livewire.private.economic-group.create-economic-group');
  }
}
