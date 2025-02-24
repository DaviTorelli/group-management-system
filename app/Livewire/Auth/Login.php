<?php

namespace App\Livewire\Auth;

//* Importações Livewire
use Livewire\Component;

//* Importações de libs
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
  public string $email = "";
  public string $password = "";

  public function login()
  {
    $this->validate([
      "email"    => "required|email",
      "password" => "required|min:6",
    ], [
      "required" => "Campo obrigatório",
      "email"    => "E-mail inválido",
      "min"      => "O campo deve ter no mínimo :min caracteres",
    ]);
    if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
      session()->flash("error", "Credenciais inválidas");
      return;
    }

    if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
      session()->regenerate(); // Impedindo sessões inválidas
      return redirect()->route("home");
    }
  }

  public function render()
  {
    return view("livewire.auth.login");
  }
}
