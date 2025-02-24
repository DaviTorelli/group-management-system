<flux:main container>
  <flux:heading size="xl" level="1">Editar bandeira</flux:heading>
  <flux:subheading size="lg" class="mb-6">Faça alterações na bandeira <strong>"{{ $this->name }}"</strong>. Ao finalizar, clique em <strong>atualizar</strong>.</flux:subheading>

  <flux:separator variant="subtle" />

  <div wire:loading wire:target="mount">
    <span class="text-gray-500">Loading...</span>
  </div>

  <form wire:submit.prevent="update" class="flex flex-col w-full gap-6 pt-4" wire:loading.remove>
    <flux:input
      label="Nome"
      placeholder="Ex: Bandeira ABC"
      wire:model="name" />

    @if (session()->has('error'))
    <div class="flex items-center gap-2 p-4 text-red-700 transition-opacity bg-red-100 border border-red-500 rounded-lg dark:bg-red-900 dark:text-red-300 dark:border-red-700">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500 dark:text-red-400" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M18 10A8 8 0 112 10a8 8 0 0116 0zm-9-3a1 1 0 112 0v4a1 1 0 11-2 0V7zm1 7a1.25 1.25 0 110-2.5A1.25 1.25 0 0110 14z" clip-rule="evenodd" />
      </svg>
      <span class="text-sm font-medium">{{ session("error") }}</span>
    </div>
    @endif

    <div class="flex items-center justify-end gap-2">
      <flux:button
        class="w-24"
        href="{{ route('flags') }}"
        icon="arrow-uturn-left">
        Voltar
      </flux:button>
      <flux:button class="w-24" variant="primary" type="submit">
        Atualizar
      </flux:button>
    </div>
  </form>
</flux:main>