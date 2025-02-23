<?php

namespace App\Livewire\Auth;

//* Importações de libs
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

//* Importações de models
use App\Models\User;

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
      "min"      => "O campo deve ter no mínimo :min caracteres",
      "email"    => "E-mail inválido"
    ]);

    $user = User::findByEmail($this->email);
    if (!$user) {
      session()->flash("error", "Credenciais inválidas");
      return;
    }

    // Checando se senhas coincidem
    if (!Hash::check($this->password, $user->password)) {
      session()->flash("error", "Credenciais inválidas");
      return;
    }

    $token = $user->createToken("auth_token")->plainTextToken;

    session(["auth_token" => $token]); // Guarda o token na sessão

    return redirect()->route("dashboard"); // Redireciona após login
  }

  public function render()
  {
    return view("livewire.auth.login");
  }
}
