<?php

namespace App\Livewire\Private\Flag;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Flag;

class EditFlag extends Component
{
  #[Layout("components.layouts.private")]

  public int $flagId;
  public string $name;
  public int $economicGroupId;

  public $isLoading = true; // comportamento 'loading' da página


  public function mount($id)
  {
    $flag = Flag::find($id);

    // Caso não encontre o grupo, volta para a lista
    if (!$flag) return redirect()->route("flags");

    $this->flagId = $flag->id;
    $this->name = $flag->name;
    $this->economicGroupId = $flag->economic_group_id;

    $this->isLoading = false; // depois do 'mount', não está mais carregando
  }

  public function update()
  {
    $this->validate([
      "name" => "required|min:2|max:100",
      "economicGroupId" => "required|in:economic_groups,id"
    ], [
      "required" => "Campo obrigatório",
      "min"      => "O campo deve ter no mínimo :min caracteres",
      "max"      => "O campo deve ter no máximo :max caracteres",
      "economicGroupId.in" => "O grupo econômico não foi encontrado"
    ]);

    try {
      Flag::findOrFail($this->flagId)->update([
        "name"              => $this->name,
        "economic_group_id" => $this->economicGroupId
      ]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao editar bandeira");
      return;
    }

    return redirect()->route("flags");
  }

  public function render()
  {
    return view('livewire.private.flag.edit-flag');
  }
}
