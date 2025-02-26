<flux:main container>
  <flux:heading size="xl" level="1">Colaboradores por Grupo Econômico</flux:heading>

  <flux:separator variant="subtle" />

  <div class="w-full p-4 h-96">
    <livewire:livewire-column-chart
      key="{{ $columnChart->reactiveKey() }}"
      :column-chart-model="$columnChart" />
  </div>

  <flux:separator />

  <table class="w-full my-5 text-left border-collapse">
    <thead>
      <tr class="text-sm leading-normal text-gray-600 bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
        <th class="px-6 py-3">Grupo Econômico</th>
        <th class="px-6 py-3 text-center">Número de Colaboradores</th>
      </tr>
    </thead>
    <tbody class="text-sm text-gray-700 divide-y divide-gray-200 dark:text-gray-300 dark:divide-gray-600">
      @foreach ($groups as $group)
      <tr class="hover:bg-gray-50 dark:hover:bg-gray-600" key="{{ $group['id'] }}">
        <td class="px-6 py-3">{{ $group['name'] }}</td>
        <td class="px-6 py-3 text-center">{{ $group['employeesCount'] }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <flux:button
    class="w-24"
    href="{{ route('units') }}"
    icon="arrow-uturn-left">
    Grupos
  </flux:button>
</flux:main>