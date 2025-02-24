<?php

namespace App\Livewire\Private\EconomicGroup;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\EconomicGroup;

class EditEconomicGroup extends Component
{
  #[Layout("components.layouts.private")]

  public int $groupId;
  public string $name;

  public $isLoading = true; // comportamento 'loading' da página


  public function mount($id)
  {
    $group = EconomicGroup::find($id);

    // Caso não encontre o grupo, volta para a lista
    if (!$group) return redirect()->route("economic-groups");

    $this->groupId = $group->id;
    $this->name = $group->name;

    $this->isLoading = false; // depois do 'mount', não está mais carregando
  }

  public function update()
  {
    try {
      $this->validate([
        "name" => "required|min:2",
      ], [
        "required" => "Campo obrigatório",
        "min"      => "O campo deve ter no mínimo :min caracteres",
        "max"      => "O campo deve ter no máximo :max caracteres"
      ]);

      EconomicGroup::findOrFail($this->groupId)->update(["name" => $this->name]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao editar grupo econômico");
      return;
    }

    return redirect()->route("economic-groups");
  }

  public function render()
  {
    return view('livewire.private.economic-group.edit-economic-group');
  }
}
