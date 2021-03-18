@extends('layouts.app')

@section('title', __('app.titles.dashboard'))

@section('content')
    <div class="m-content">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            Cursos recientes
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <!--begin::Section-->
                <div class="m-section">
                    <div class="m-section__content table-responsive">
                        <table class="table table-bordered m-table">
                            <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre</th>
                                <th>Teacher</th>
                                <th class="text-center">Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coursesLimit as $index => $course)
                                <tr>
                                    <th scope="row">{{ $course->code }}</th>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->teacher->full_name }}</td>
                                    <td class="text-center">
                                        @if ($course->state == 'DISPONIBLE')
                                            <span class="m-badge m-badge--success m-badge--wide">{{ $course->state }}</span>
                                        @else
                                            <span class="m-badge m-badge--danger m-badge--wide">{{ $course->state }}</span>
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
                                    Cursos por mes
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="courses_for_month" style="height:100%;"></div>
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
                                   Estado por mes (Dispobible y cerrado)
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div id="state_course_for_month" style="height:100%;"></div>
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
            let formatCourseForMonth = <?= json_encode($formatCourseForMonth)?>;
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
                    for (const property in formatCourseForMonth) {
                        if (baseChart[index][column] === property) {
                            baseChart[index]['value'] = formatCourseForMonth[property];
                        }
                    }
                }
            }

            new Morris.Line({
                element: 'courses_for_month',
                resize: true,
                data: baseChart,
                xkey: 'month',
                ykeys: ['value'],
                labels: ['Cursos Rgistrados'],
                xLabelFormat: function(x) {
                    return months[x.getMonth()];
                },
                dateFormat: function(x) {
                    return months[new Date(x).getMonth()];
                },
            });

            let formatStateCourseForMonth = <?= json_encode($formatStateCourseForMonth)?>;
            let baseChartBar = [
                { month: 'Ene', available: 0, closed: 0,},
                { month: 'Feb', available: 0, closed: 0,},
                { month: 'Mar', available: 0, closed: 0,},
                { month: 'Abr', available: 0, closed: 0,},
                { month: 'May', available: 0, closed: 0,},
                { month: 'Jun', available: 0, closed: 0,},
                { month: 'Jul', available: 0, closed: 0,},
                { month: 'Ago', available: 0, closed: 0,},
                { month: 'Sep', available: 0, closed: 0,},
                { month: 'Oct', available: 0, closed: 0,},
                { month: 'Nov', available: 0, closed: 0,},
                { month: 'Dic', available: 0, closed: 0,},
            ];

            for (const index in formatStateCourseForMonth) {
                for (const course in formatStateCourseForMonth[index]) {
                    for (const month in formatStateCourseForMonth[index][course]) {
                        if (course === 'available') {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['available'] = formatStateCourseForMonth[index][course][month];
                                    }
                                }
                            }
                        } else {
                            for (const options in baseChartBar) {
                                for (const column in baseChartBar[options]) {
                                    if (baseChartBar[options][column] === month) {
                                        baseChartBar[options]['closed'] = formatStateCourseForMonth[index][course][month];
                                    }
                                }
                            }
                        }
                    }
                }
            }

            new Morris.Bar({
                element: 'state_course_for_month',
                resize: true,
                data: baseChartBar,
                xkey: 'month',
                ykeys: ['available', 'closed'],
                labels: ['Disponible', 'Cerrado'],
                barColors : [
                    '#34bfa3',
                    '#f4516c',
                ],
            });

        });
    </script>
@endpush
