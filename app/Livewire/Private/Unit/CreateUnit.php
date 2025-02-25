<?php

namespace App\Livewire\Private\Unit;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Flag;
use App\Models\Unit;

class CreateUnit extends Component
{
	#[Layout("components.layouts.private")]

	public string $legal_name = "";
	public string $fantasy_name = "";
	public int $cnpj;
	public int|null $flagId = null;
	public array $flags = [];

	public function mount()
	{
		$this->flags = Flag::all()->toArray();
	}

	public function store()
	{
		$this->validate([
			"legal_name" 	 => "required|min:2|max:100",
			"fantasy_name" => "required|min:2|max:100",
			"cnpj"				 => "required|size:14|cnpj|unique:units",
			"flagId" 			 => "required|exists:flags,id"
		], [
			"required" 			=> "Campo obrigatório",
			"cnpj.size" 		=> "O campo deve ter :size caracteres",
			"cnpj.unique" 	=> "Este CNPJ já está em uso",
			"min" 			  	=> "O campo deve ter no mínimo :min caracteres",
			"max" 			  	=> "O campo deve ter no máximo :max caracteres",
			"flagId.exists" => "A bandeira não foi encontrada"
		]);

		try {
			Unit::create([
				"legal_name" 	 => $this->legal_name,
				"fantasy_name" => $this->fantasy_name,
				"cnpj" 			   => $this->cnpj,
				"flag_id" 		 => $this->flagId
			]);
		} catch (\Exception $e) {
			session()->flash("error", "Erro ao criar unidade");
			return;
		}

		return redirect()->route("units");
	}

	public function render()
	{
		return view('livewire.private.unit.create-unit', [
			'flags' => $this->flags
		]);
	}
}
