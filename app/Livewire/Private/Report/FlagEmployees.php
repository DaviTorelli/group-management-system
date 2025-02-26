<?php

namespace App\Livewire\Private\Report;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;
use App\Models\Flag;

//* Importações de services
use App\Services\ReportService;

//* Importação - Gráficos
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class FlagEmployees extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    // Obtém os colaboradores e carrega a relação de unidade e bandeira
    $employees = Employee::with('unit.flag')->get();

    // Agrupa os colaboradores por bandeira e conta o total
    $columnChart = $employees->groupBy(fn($employee) => $employee->unit->flag->name)
      ->reduce(
        function ($columnChart, $data, $flagName) {
          $totalEmployees = $data->count();
          $reportService = new ReportService();

          return $columnChart->addColumn(
            $flagName,
            $totalEmployees,
            $reportService->getRandomColor($flagName)
          );
        },
        (new ColumnChartModel())
          ->setTitle('Total de Colaboradores por Bandeira')
          ->setAnimated(true)
          ->withOnColumnClickEventName('onColumnClick')
          ->setLegendVisibility(false)
          ->setDataLabelsEnabled(true)
          ->setColumnWidth(90)
          ->withGrid()
      );

    // Lista as bandeiras com a contagem de colaboradores
    $flagsEmployeesCount = Flag::with(['units' => function ($query) {
      $query->withCount('employees');
    }])->get()->map(function ($flag) {
      return [
        'id'             => $flag->id,
        'name'           => $flag->name,
        'employeesCount' => $flag->units->sum('employees_count'),
      ];
    });

    return view('livewire.private.report.flag-employees')->with([
      'columnChart' => $columnChart,
      'flags'       => $flagsEmployeesCount
    ]);
  }
}
