<div class="flex items-center justify-center min-h-screen">
  <form wire:submit.prevent="login" class="flex flex-col w-full max-w-md gap-6 p-8 rounded-lg shadow-md">

    <h2 class="mb-6 text-2xl font-semibold text-center">Login</h2>

    <flux:input
      label="E-mail"
      placeholder="email@example.com"
      wire:model="email" />

    <flux:input
      label="Senha"
      placeholder="********"
      wire:model="password"
      type="password" />

    <flux:button variant="primary" class="w-full" type="submit">
      Login
    </flux:button>

    @if (session()->has('error'))
    <div class="flex items-center gap-2 p-4 text-red-700 transition-opacity bg-red-100 border border-red-500 rounded-lg dark:bg-red-900 dark:text-red-300 dark:border-red-700">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 dark:text-red-400" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10A8 8 0 112 10a8 8 0 0116 0zm-9-3a1 1 0 112 0v4a1 1 0 11-2 0V7zm1 7a1.25 1.25 0 110-2.5A1.25 1.25 0 0110 14z" clip-rule="evenodd" />
      </svg>
      <span class="text-sm font-medium">{{ session("error") }}</span>
    </div>
    @endif

  </form>
</div>