@extends('layouts.app')

@section('title', __('app.titles.dashboard'))

@section('content')
    <div class="m-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="m-portlet">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">Proyectos recientes</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <!--begin::Section-->
                        <div class="m-section">
                            <div class="m-section__content table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre</th>
                                        <th>Empleado</th>
                                        <th>Beneficiario</th>
                                        <th>Concepto</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($projectsLimit as $project)
                                        <tr>
                                            <th scope="row">{{ $project->code }}</th>
                                            <td>{{ $project->name }}</td>
                                            <td>
                                                @if(!is_null($project->employee))
                                                    {{ $project->employee->full_name }}
                                                @else
                                                    NO TIENE DEFINIDO UN EMPLEADO
                                                @endif
                                            </td>
                                            <td>
                                                @if(!is_null($project->beneficiary))
                                                    {{ $project->beneficiary->full_name }}</td>
                                                @else
                                                    NO TIENE DEFINIDO UN BENEFICIARIO
                                                @endif
                                            <td class="text-center">
                                                @if($project->concept == 'APROBADO')
                                                    <span
                                                        class="m-badge m-badge--success m-badge--wide">{{ $project->concept }}</span>
                                                @elseif($project->concept == 'RECHAZADO')
                                                    <span
                                                        class="m-badge m-badge--danger m-badge--wide">{{ $project->concept }}</span>
                                                @else
                                                    <span
                                                        class="m-badge m-badge--warning m-badge--wide">{{ $project->concept }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--end::Section-->
                    </div>
                    <!--end::Form-->
                </div>
            </div>
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Proyectos por mes
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="projects_for_month" style="height:100%;"></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Total por conceptos (Aprobados, Rechazados y
                                    Pendientes)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="concept_project_total" style="height:100%;"></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-6">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                <h3 class="m-portlet__head-text">Porcentaje por conceptos (Aprobados, Rechazados y
                                    Pendientes)</h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="concept_project_percents" style="height:100%;"></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
            <div class="col-lg-12">
                <!--begin::Portlet-->
                <div class="m-portlet m-portlet--tab">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                </span>
                                <h3 class="m-portlet__head-text">
                                    Concepto por mes (Aprobados, Rechazados y Pendientes)
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="concept_project_for_mont" style="height:100%;"></div>
                    </div>
                </div>
                <!--end::Portlet-->
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@endpush

@push('scripts')
    @include('includes.scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script>
        $(function () {
            let months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            const customColor = [
                '#34bfa3',
                '#f4516c',
                '#ffb822',
            ];
            let today = new Date();
            let year = today.getFullYear();
            let $formatProjectForMonth = <?= json_encode($formatProjectForMonth)?>;
            let baseChart = [
                {month: year + '-01', value: 0,},
                {month: year + '-02', value: 0,},
                {month: year + '-03', value: 0,},
                {month: year + '-04', value: 0,},
                {month: year + '-05', value: 0,},
                {month: year + '-06', value: 0,},
                {month: year + '-07', value: 0,},
                {month: year + '-08', value: 0,},
                {month: year + '-09', value: 0,},
                {month: year + '-10', value: 0,},
                {month: year + '-11', value: 0,},
                {month: year + '-12', value: 0,},
            ];

            for (const index in baseChart) {
                for (const column in baseChart[index]) {
                    for (const property in $formatProjectForMonth) {
                        if (baseChart[index][column] === property) {
                            baseChart[index]['value'] = $formatProjectForMonth[property];
                        }
                    }
                }
            }

            new Morris.Line({
                element: 'projects_for_month',
                resize: true,
                data: baseChart,
                xkey: 'month',
                ykeys: ['value'],
                labels: ['Proyectos Registrados'],
                xLabelFormat: function (x) {
                    return months[x.getMonth()];
                },
                dateFormat: function (x) {
                    return months[new Date(x).getMonth()];
                },
            });

            let formatConceptProjectForMonth = <?= json_encode($formatConceptProjectForMonth)?>;
            let baseChartBar = [
                {month: 'Ene', approved: 0, rejected: 0, pending: 0,},
                {month: 'Feb', approved: 0, rejected: 0, pending: 0,},
                {month: 'Mar', approved: 0, rejected: 0, pending: 0,},
                {month: 'Abr', approved: 0, rejected: 0, pending: 0,},
                {month: 'May', approved: 0, rejected: 0, pending: 0,},
                {month: 'Jun', approved: 0, rejected: 0, pending: 0,},
                {month: 'Jul', approved: 0, rejected: 0, pending: 0,},
                {month: 'Ago', approved: 0, rejected: 0, pending: 0,},
                {month: 'Sep', approved: 0, rejected: 0, pending: 0,},
                {month: 'Oct', approved: 0, rejected: 0, pending: 0,},
                {month: 'Nov', approved: 0, rejected: 0, pending: 0,},
                {month: 'Dic', approved: 0, rejected: 0, pending: 0,},
            ];

            for (const index in formatConceptProjectForMonth) {
                for (const project in formatConceptProjectForMonth[index]) {
                    for (const month in formatConceptProjectForMonth[index][project]) {
                        if (project === 'approved') {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['approved'] = formatConceptProjectForMonth[index][project][month];
                                    }
                                }
                            }
                        } else if (project === 'rejected') {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['rejected'] = formatConceptProjectForMonth[index][project][month];
                                    }
                                }
                            }
                        } else {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['pending'] = formatConceptProjectForMonth[index][project][month];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            new Morris.Bar({
                element: 'concept_project_for_mont',
                resize: true,
                data: baseChartBar,
                xkey: 'month',
                ykeys: ['approved', 'rejected', 'pending'],
                labels: ['Aprobado', 'Rechazado', 'Pendiente'],
                barColors: customColor,
            });

            new Morris.Donut({
                element: 'concept_project_percents',
                resize: true,
                data: [
                    {label: 'Aprobados', value: {{ $percents['approved']  }} },
                    {label: 'Rechazados', value: {{ $percents['rejected']  }} },
                    {label: 'Pendientes', value: {{ $percents['pending']  }} },
                ],
                formatter: function (x) {
                    return x + "%"
                },
                colors: customColor,
            });

            new Morris.Donut({
                element: 'concept_project_total',
                resize: true,
                data: [
                    {label: 'Aprobados', value: {{ $conceptApprovedCount  }} },
                    {label: 'Rechazados', value: {{ $conceptRejectedCount  }} },
                    {label: 'Pendientes', value: {{ $conceptPendingCount  }} },
                ],
                colors: customColor,
            });
        });
    </script>
@endpush
