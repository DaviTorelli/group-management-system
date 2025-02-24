<?php

namespace App\Livewire\Private\Flag;

//* Importações Livewire
use App\Models\EconomicGroup;
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Flag;

class CreateFlag extends Component
{
  #[Layout("components.layouts.private")]

  public string $name = "";
  public int|null $economicGroupId = null;
  public array $economicGroups = [];

  public function mount()
  {
    $this->economicGroups = EconomicGroup::all()->toArray();
  }

  public function store()
  {
    $this->validate([
      "name" => "required|min:2|max:100",
      "economicGroupId" => "required|exists:economic_groups,id"
    ], [
      "required" => "Campo obrigatório",
      "min" => "O campo deve ter no mínimo :min caracteres",
      "max" => "O campo deve ter no máximo :max caracteres",
      "economicGroupId.exists" => "O grupo econômico não foi encontrado"
    ]);

    try {
      Flag::create([
        "name" => $this->name,
        "economic_group_id" => $this->economicGroupId
      ]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao criar bandeira");
      return;
    }

    return redirect()->route("flags");
  }

  public function render()
  {
    return view('livewire.private.flag.create-flag', [
      'economicGroups' => $this->economicGroups
    ]);
  }
}
