<flux:main container>
  <flux:heading size="xl" level="1">Bandeiras</flux:heading>
  <flux:subheading size="lg" class="mb-6">Veja todas as bandeiras cadastradas em seu sistema.</flux:subheading>

  <flux:separator variant="subtle" />

  @if (session()->has('error'))
  <div
    x-data="{ show: true }"
    x-show="show"
    class="flex items-center justify-between p-4 mb-4 border rounded-lg text-rose-700 bg-rose-100 border-rose-400 dark:bg-rose-900 dark:text-rose-300">
    <span>{{ session('error') }}</span>
    <flux:button icon="x-mark" variant="ghost" @click="show = false" class="text-rose-900 dark:text-rose-300 hover:text-rose-700" />
  </div>
  @endif

  @if (session()->has('success'))
  <div
    x-data="{ show: true }"
    x-show="show"
    class="flex items-center justify-between p-4 mb-4 text-green-700 bg-green-100 border border-green-400 rounded-lg dark:bg-green-900 dark:text-green-300">
    <span>{{ session('success') }}</span>
    <flux:button icon="x-mark" variant="ghost" @click="show = false" class="text-green-900 dark:text-green-300 hover:text-green-700" />
  </div>
  @endif

  <div class="container pt-4">
    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-neutral-900">
      <div class="flex items-center justify-end p-4">
        <a class="px-4 py-2 font-bold text-white rounded bg-lime-600 hover:bg-lime-700" href="{{ route('flags.create') }}">
          + Adicionar Bandeira
        </a>
      </div>

      @if ($flags->isEmpty())
      <div class="p-4 text-center text-gray-600 dark:text-gray-300">
        Nenhuma bandeira encontrada.
      </div>
      @else
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="text-sm leading-normal text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('id')">
              <span class="flex flex-row items-center gap-1">
                ID
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('name')">
              <span class="flex flex-row items-center gap-1">
                Nome
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3">
              Grupo Econômico
            </th>
            <th class="px-6 py-3">
              Unidades
            </th>
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('created_at')">
              <span class="flex flex-row items-center gap-1">
                Criado em
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('updated_at')">
              <span class="flex flex-row items-center gap-1">
                Última atualização
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3 text-end">
              Ações
            </th>
          </tr>
        </thead>
        <tbody class="text-sm text-gray-700 divide-y divide-gray-200 dark:text-gray-300 dark:divide-gray-600">
          @foreach ($flags as $flag)
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-600" key="{{ $flag->id }}">
            <td class="px-6 py-3">{{ $flag->id }}</td>
            <td class="px-6 py-3">{{ $flag->name }}</td>
            <td>
              <div class="flex items-center gap-2 px-6 py-3">
                <flux:icon.wallet class="size-4" />
                {{ $flag->economicGroup->name }}
              </div>
            </td>
            <td>
              <div class="flex items-center gap-2 px-6 py-3">
                <flux:icon.building-office class="size-4" />
                {{ $flag->units->count() }}
              </div>
            </td>
            <td class="px-6 py-3">{{ $flag->created_at->format('d/m/Y - H:i') }}</td>
            <td class="px-6 py-3">{{ $flag->updated_at->format('d/m/Y - H:i') }}</td>
            <td class="p-2 text-right">
              <span class="flex items-center justify-end gap-2">
                <flux:button
                  href="/flags/edit/{{ $flag->id }}"
                  icon="pencil-square"
                  variant="primary" />

                <flux:modal.trigger :name="'delete-flag-'.$flag->id">
                  <flux:button icon="trash" variant="danger" />
                </flux:modal.trigger>
              </span>

            </td>
          </tr>
          <flux:modal :name="'delete-flag-'.$flag->id" class="min-w-[22rem] space-y-6">
            <div>
              <flux:heading size="lg">Deletar bandeira?</flux:heading>

              <flux:subheading>
                <p>Essa é uma ação irreversível.</p>
              </flux:subheading>
            </div>

            <div class="flex gap-2">
              <flux:spacer />

              <flux:modal.close>
                <flux:button variant="ghost">Cancelar</flux:button>
              </flux:modal.close>

              <flux:button wire:click="destroy({{ $flag->id }})" variant="danger">Excluir</flux:button>
            </div>
          </flux:modal>
          @endforeach
        </tbody>
      </table>
      <div class="p-4">{{ $flags->links() }}</div>
      @endif
    </div>
  </div>

</flux:main>