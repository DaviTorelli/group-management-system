<?php

namespace App\Livewire\Private\Report;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\EconomicGroup;
use App\Models\Employee;

//* Importações de services
use App\Services\ReportService;

//* Importação - Gráficos
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class EconomicGroupEmployees extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    // Obtém os colaboradores e carrega as relações necessárias
    $employees = Employee::with('unit.flag.economicGroup')->get();

    // Agrupa os colaboradores por grupo econômico e conta o total
    $columnChart = $employees->groupBy(fn($employee) => $employee->unit->flag->economicGroup->name ?? 'Sem Grupo Econômico')
      ->reduce(
        function (ColumnChartModel $columnChart, $data, $groupName) {
          $totalEmployees = $data->count();
          $reportService = new ReportService();

          return $columnChart->addColumn(
            $groupName,
            $totalEmployees,
            $reportService->getRandomColor($groupName)
          );
        },
        (new ColumnChartModel())
          ->setTitle('Total de Colaboradores por Grupo Econômico')
          ->setAnimated(true)
          ->withOnColumnClickEventName('onColumnClick')
          ->setLegendVisibility(false)
          ->setDataLabelsEnabled(true)
          ->setColumnWidth(90)
          ->withGrid()
      );

    // Lista os grupos econômicos com a contagem de colaboradores
    $groupsEmployeesCount = EconomicGroup::with(['flags.units' => function ($query) {
      $query->withCount('employees');
    }])->get()->map(function ($group) {
      return [
        'id'             => $group->id,
        'name'           => $group->name,
        'employeesCount' => $group->flags->flatMap->units->sum('employees_count'),
      ];
    });

    return view('livewire.private.report.economic-group-employees')->with([
      'columnChart' => $columnChart,
      'groups'      => $groupsEmployeesCount
    ]);
  }
}
