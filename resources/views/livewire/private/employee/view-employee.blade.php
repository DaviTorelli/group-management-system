<flux:main container>
  <flux:heading size="xl" level="1">Ver colaborador</flux:heading>
  <flux:subheading size="lg" class="mb-6">Veja com detalhes mais informações sobre o(a) colaborador(a) <strong>"{{ $this->employee->name }}"</strong>.</flux:subheading>

  <flux:separator variant="subtle" />

  <div wire:loading wire:target="mount">
    <span class="text-neutral-500">Loading...</span>
  </div>

  <div class="py-2" wire:loading.remove>
    <dl>
      <div class="px-4 py-5 bg-neutral-50 dark:bg-neutral-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.user class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          Nome
        </dt>
        <dd class="mt-1 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          {{ $this->employee->name }}
        </dd>
      </div>
      <div class="px-4 py-5 bg-white dark:bg-neutral-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.envelope class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          E-mail
        </dt>
        <dd class="mt-1 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          {{ $this->employee->email }}
        </dd>
      </div>
      <div class="px-4 py-5 bg-neutral-50 dark:bg-neutral-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.identification class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          CPF
        </dt>
        <dd class="mt-1 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          {{ $this->employee->cpf }}
        </dd>
      </div>
      <div class="px-4 py-5 bg-white dark:bg-neutral-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.building-office class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          Unidade
        </dt>
        <dd class="mt-1 space-y-2 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          <p>
            <span class="font-semibold">Razão Social:</span> {{ $this->employee->unit->legal_name }}
          </p>
          <p>
            <span class="font-semibold">Nome Fantasia:</span> {{ $this->employee->unit->fantasy_name }}
          </p>
          <p>
            <span class="font-semibold">CNPJ:</span> {{ $this->employee->unit->cnpj }}
          </p>
        </dd>
      </div>
      <div class="px-4 py-5 bg-neutral-50 dark:bg-neutral-800 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.flag class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          Bandeira
        </dt>
        <dd class="mt-1 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          {{ $this->employee->unit->flag->name }}
        </dd>
      </div>
      <div class="px-4 py-5 bg-white dark:bg-neutral-900 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="flex items-center text-sm font-medium text-neutral-500 dark:text-neutral-300">
          <flux:icon.wallet class="mr-2 text-neutral-400 dark:text-neutral-500 size-5" />
          Grupo Econômico
        </dt>
        <dd class="mt-1 text-sm text-neutral-900 dark:text-neutral-100 sm:mt-0 sm:col-span-2">
          {{ $this->employee->unit->flag->economicGroup->name }}
        </dd>
      </div>
    </dl>
  </div>

  <flux:button
    class="w-24"
    href="{{ route('employees') }}"
    icon="arrow-uturn-left">
    Voltar
  </flux:button>

</flux:main>