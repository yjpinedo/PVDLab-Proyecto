@extends('layouts.app')

@section('title', __('app.titles.dashboard'))

@section('content')
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <!--begin::Total Profit-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">Beneficiarios</h4>
                                <br>
                                <span class="m-widget24__desc">Total</span>
                                <span class="m-widget24__stats m--font-brand">{{ $totalBeneficiary }}</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-brand" role="progressbar" style="width: {{ $percents['beneficiary'] }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="{{ $totalUser }}"></div>
                                </div>
                                <span class="m-widget24__change">Porcentaje</span>
                                <span class="m-widget24__number">{{ $percents['beneficiary'] }}%</span>
                            </div>
                        </div>
                        <!--end::Total Profit-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <!--begin::New Feedbacks-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">Empleados</h4>
                                <br>
                                <span class="m-widget24__desc">Total</span>
                                <span class="m-widget24__stats m--font-info">{{ $totalEmployee }}</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-info" role="progressbar" style="width: {{ $percents['employee'] }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="{{ $totalUser }}"></div>
                                </div>
                                <span class="m-widget24__change">Porcentaje</span>
                                <span class="m-widget24__number">{{ $percents['employee'] }}%</span>
                            </div>
                        </div>
                        <!--end::New Feedbacks-->
                    </div>
                    <div class="col-md-12 col-lg-6 col-xl-4">
                        <!--begin::New Orders-->
                        <div class="m-widget24">
                            <div class="m-widget24__item">
                                <h4 class="m-widget24__title">Docentes</h4>
                                <br>
                                <span class="m-widget24__desc">Total</span>
                                <span class="m-widget24__stats m--font-danger">{{ $totalTeacher }}</span>
                                <div class="m--space-10"></div>
                                <div class="progress m-progress--sm">
                                    <div class="progress-bar m--bg-danger" role="progressbar" style="width: {{ $percents['teacher'] }}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="{{ $totalUser }}"></div>
                                </div>
                                <span class="m-widget24__change">Porcentaje</span>
                                <span class="m-widget24__number">{{ $percents['teacher'] }}%</span>
                            </div>
                        </div>
                        <!--end::New Orders-->
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Usuarios más recientes
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content">
                        <table class="table table-bordered m-table">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th class="text-center">Rol</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userLimit as $index => $limit)
                                <tr>
                                <th scope="row" class="text-center">{{ ($index+1) }}</th>
                                    <td>{{ $limit->name }}</td>
                                    <td>{{ $limit->email }}</td>
                                    <td class="text-center">
                                    @if(count($limit->role) > 0)
                                        @if ($limit->role[0] == 'teachers')
                                            <span class="m-badge m-badge--brand m-badge--wide">{{ $limit->role[0] }}</span>
                                        @elseif ($limit->role[0] == 'beneficiaries')
                                            <span class="m-badge m-badge--accent m-badge--wide">{{ $limit->role[0] }}</span>
                                        @else
                                            <span class="m-badge m-badge--success m-badge--wide">{{ $limit->role[0] }}</span>
                                        @endif
                                    @else
                                        <span class="m-badge m-badge--danger m-badge--wide">Sin rol</span>
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
        <div class="row">
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
                                    Registro de usuarios por mes
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="users_for_month" style="height:100%;"></div>
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
                                    Registro de tipo de usuario por mes (Beneficiarios, docentes y empleados)
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="type_user_for_mont" style="height:100%;"></div>
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
        $(function() {
            let months = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            let today = new Date();
            let year = today.getFullYear();
            let formatUserForMonth = <?= json_encode($formatUserForMonth)?>;
            let baseChart = [
                { month: year + '-01', value: 0, },
                { month: year + '-02', value: 0, },
                { month: year + '-03', value: 0, },
                { month: year + '-04', value: 0, },
                { month: year + '-05', value: 0, },
                { month: year + '-06', value: 0, },
                { month: year + '-07', value: 0, },
                { month: year + '-08', value: 0, },
                { month: year + '-09', value: 0, },
                { month: year + '-10', value: 0, },
                { month: year + '-11', value: 0, },
                { month: year + '-12', value: 0, },
             ];

            for (const index in baseChart) {
                for (const column in baseChart[index]) {
                    for (const property in formatUserForMonth) {
                        if (baseChart[index][column] === property) {
                            baseChart[index]['value'] = formatUserForMonth[property];
                        }
                    }
                }
            }

            new Morris.Line({
                element: 'users_for_month',
                resize: true,
                data: baseChart,
                xkey: 'month',
                ykeys: ['value'],
                labels: ['Usuarios Rgistrados'],
                xLabelFormat: function(x) {
                    return months[x.getMonth()];
                },
                dateFormat: function(x) {
                    return months[new Date(x).getMonth()];
                },
            });

            let formatTypeUserForMonth = <?= json_encode($formatTypeUserForMonth)?>;
            let baseChartBar = [
                { month: 'Ene', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Feb', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Mar', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Abr', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'May', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Jun', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Jul', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Ago', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Sep', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Oct', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Nov', beneficiary: 0, teacher: 0, employee: 0,},
                { month: 'Dic', beneficiary: 0, teacher: 0, employee: 0,},
            ];

            for (const index in formatTypeUserForMonth) {
                for (const user in formatTypeUserForMonth[index]) {
                    for (const month in formatTypeUserForMonth[index][user]) {
                        if (user === 'beneficiary') {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['beneficiary'] = formatTypeUserForMonth[index][user][month];
                                    }
                                }
                            }
                        } else if (user === 'employee') {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['employee'] = formatTypeUserForMonth[index][user][month];
                                    }
                                }
                            }
                        } else {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['teacher'] = formatTypeUserForMonth[index][user][month];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            new Morris.Bar({
                element: 'type_user_for_mont',
                resize: true,
                data: baseChartBar,
                xkey: 'month',
                ykeys: ['beneficiary', 'employee', 'teacher'],
                labels: ['Beneficiarios', 'Empleados', 'Docentes'],
            });
        });
    </script>
@endpush
