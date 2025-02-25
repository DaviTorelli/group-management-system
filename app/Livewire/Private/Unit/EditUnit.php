<?php

namespace App\Livewire\Private\Unit;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Flag;
use App\Models\Unit;

class EditUnit extends Component
{
  #[Layout("components.layouts.private")]

  public int $unitId;
  public string $legal_name = "";
  public string $fantasy_name = "";
  public int $cnpj;
  public int $flagId;
  public array $flags = [];

  public $isLoading = true; // comportamento 'loading' da página

  public function mount($id)
  {
    $unit = Unit::find($id);

    if (!$unit) return redirect()->route("units");

    $this->unitId = $unit->id;
    $this->legal_name = $unit->legal_name;
    $this->fantasy_name = $unit->fantasy_name;
    $this->cnpj = $unit->cnpj;
    $this->flagId = $unit->flag_id;
    $this->flags = Flag::all()->toArray();

    $this->isLoading = false; // depois do 'mount', não está mais carregando
  }

  public function update()
  {
    $this->validate([
      "legal_name"   => "required|min:2|max:100",
      "fantasy_name" => "required|min:2|max:100",
      "cnpj"         => "required", //TODO: validação + digitar mesmo cnpj
      "flagId"       => "required|exists:flags,id"
    ], [
      "required" => "Campo obrigatório",
      "min" => "O campo deve ter no mínimo :min caracteres",
      "max" => "O campo deve ter no máximo :max caracteres",
      "flagId.exists" => "A bandeira não foi encontrada"
    ]);

    try {
      Unit::findOrFail($this->unitId)->update([
        "legal_name"   => $this->legal_name,
        "fantasy_name" => $this->fantasy_name,
        "cnpj"         => $this->cnpj,
        "flag_id"      => $this->flagId
      ]);
    } catch (\Exception $e) {
      session()->flash("error", "Erro ao editar unidade");
      return;
    }

    return redirect()->route("units");
  }

  public function render()
  {
    return view('livewire.private.unit.edit-unit', [
      'flags' => $this->flags
    ]);
  }
}
