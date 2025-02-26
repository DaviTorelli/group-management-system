<?php

namespace App\Livewire\Private\Report;

//* Importações Livewire
use Livewire\Attributes\Layout;
use Livewire\Component;

//* Importações de models
use App\Models\Employee;
use App\Models\Unit;

//* Importações de services
use App\Services\ReportService;

//* Importação - Gráficos
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class UnitEmployees extends Component
{
  #[Layout("components.layouts.private")]

  public function render()
  {
    // Obtém a contagem de funcionários por unidade
    $employees = Employee::with('unit')->get();

    // Agrupa por unidade e conta os funcionários
    $columnChart = $employees->groupBy('unit.fantasy_name')
      ->reduce(
        function ($columnChart, $data) {
          $unitName = $data->first()->unit->fantasy_name;
          $totalEmployees = $data->count();

          $reportService = new ReportService();

          return $columnChart->addColumn(
            $unitName,
            $totalEmployees,
            $reportService->getRandomColor($unitName)
          );
        },
        (new ColumnChartModel())
          ->setTitle('Total de Colaboradores por Unidade')
          ->setAnimated(true)
          ->withOnColumnClickEventName('onColumnClick')
          ->setLegendVisibility(false)
          ->setDataLabelsEnabled(true)
          ->setColumnWidth(90)
          ->withGrid()
      );

    $unitsEmployeesCount = Unit::withCount('employees')->paginate(5);

    return view('livewire.private.report.unit-employees')->with([
      'columnChart' => $columnChart,
      'units'       => $unitsEmployeesCount
    ]);
  }
}
