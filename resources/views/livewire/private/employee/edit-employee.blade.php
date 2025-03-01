<flux:main container>
  <flux:heading size="xl" level="1">Editar colaborador</flux:heading>
  <flux:subheading size="lg" class="mb-6">Faça alterações no(a) colaborador(a) <strong>"{{ $this->name }}"</strong>. Ao finalizar, clique em <strong>atualizar</strong>.</flux:subheading>

  <flux:separator variant="subtle" />

  <div wire:loading wire:target="mount">
    <span class="text-gray-500">Loading...</span>
  </div>

  <form wire:submit.prevent="update" class="flex flex-col w-full gap-6 pt-4" wire:loading.remove>
    <flux:input
      label="Nome"
      placeholder="Ex: John Doe"
      wire:model="name" />

    <flux:input
      label="E-mail"
      placeholder="Ex: johndoe@example.com"
      wire:model="email" />

    <div>
      <flux:input
        label="CPF"
        type="text"
        placeholder="Ex: 123.456.789-10"
        wire:model="cpf"
        inputmode="numeric"
        pattern="[0-9]*"
        oninput="this.value = this.value.replace(/\D/g, '')" />
      <p class="text-sm text-gray-500">Digite apenas os números, exemplo: 12345678910</p>
    </div>

    <flux:select
      label="Unidade"
      wire:model="unitId">
      <option value="">Selecione uma unidade</option>
      @foreach ($units as $unit)
      <option value="{{ $unit['id'] }}" {{ $unitId == $unit['id'] ? 'selected' : '' }}>
        {{ $unit['legal_name'] }}
      </option>
      @endforeach
    </flux:select>

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
        href="{{ route('employees') }}"
        icon="arrow-uturn-left">
        Voltar
      </flux:button>
      <flux:button class="w-24" variant="primary" type="submit">
        Atualizar
      </flux:button>
    </div>
  </form>
</flux:main>