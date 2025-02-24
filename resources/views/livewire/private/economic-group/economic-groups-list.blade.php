<flux:main container>
  <flux:heading size="xl" level="1">Grupos Econômicos</flux:heading>
  <flux:subheading size="lg" class="mb-6">Veja todos os grupos econômicos cadastrados em seu sistema.</flux:subheading>

  <flux:separator variant="subtle" />

  <div class="container pt-4">
    <div class="overflow-hidden bg-white rounded-lg shadow-md dark:bg-neutral-900">
      <div class="flex items-center justify-end p-4">
        <a class="px-4 py-2 font-bold text-white rounded bg-lime-600 hover:bg-lime-700" href="{{ route('economic-groups.create') }}">
          + Adicionar Grupo
        </a>
      </div>

      @if ($economicGroups->isEmpty())
      <div class="p-4 text-center text-gray-600 dark:text-gray-300">
        Nenhum grupo econômico cadastrado.
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
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('id')">
              <span class="flex flex-row items-center gap-1">
                Nome
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('id')">
              <span class="flex flex-row items-center gap-1">
                Criado em
                <flux:icon.arrows-up-down variant="micro" />
              </span>
            </th>
            <th class="px-6 py-3 cursor-pointer" wire:click="sort('id')">
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
          @foreach ($economicGroups as $group)
          <tr class="hover:bg-gray-50 dark:hover:bg-gray-600" key="{{ $group->id }}">
            <td class="px-6 py-3">{{ $group->id }}</td>
            <td class="px-6 py-3">{{ $group->name }}</td>
            <td class="px-6 py-3">{{ $group->created_at->format('d/m/Y - H:i') }}</td>
            <td class="px-6 py-3">{{ $group->updated_at->format('d/m/Y - H:i') }}</td>
            <td class="p-2 text-right">
              <span class="flex items-center justify-end gap-2">
                <flux:button
                  href="/economic-groups/edit/{{ $group->id }}"
                  icon="pencil-square"
                  variant="primary" />

                <flux:modal.trigger :name="'delete-economic-group-'.$group->id">
                  <flux:button icon="trash" variant="danger" />
                </flux:modal.trigger>
              </span>

            </td>
          </tr>
          <flux:modal :name="'delete-economic-group-'.$group->id" class="min-w-[22rem] space-y-6">
            <div>
              <flux:heading size="lg">Deletar grupo econômico?</flux:heading>

              <flux:subheading>
                <p>Essa é uma ação irreversível.</p>
              </flux:subheading>
            </div>

            <div class="flex gap-2">
              <flux:spacer />

              <flux:modal.close>
                <flux:button variant="ghost">Cancelar</flux:button>
              </flux:modal.close>

              <flux:button wire:click="destroy({{ $group->id }})" variant="danger">Excluir</flux:button>
            </div>
          </flux:modal>
          @endforeach
        </tbody>
      </table>
      <div class="p-4">{{ $economicGroups->links() }}</div>
      @endif
    </div>
  </div>

</flux:main>