@extends('layouts.app')

<script defer src="{{ asset('js/highcharts.js') }}"></script>
<script defer src="{{ asset('js/accessibility.js') }}"></script>
<script defer src="{{ asset('js/export-data.js') }}"></script>
<script defer src="{{ asset('js/offline-exporting.js') }}"></script>
<script defer src="{{ asset('js/exporting.js') }}"></script>

@section('title', 'Gráficos')

@section('content')
<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="container-md">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                <div class="card rounded-3 shadow-lg border-0">
                    <div class="card-header bg-dark text-white">
                        <h3 class="text-center fw-bold mt-3 mb-3">Painel Geral</h3>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center d-flex flex-wrap g-4">
                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card shadow-sm rounded-3 border-0">
                                    <div class="card-body text-center p-4">
                                        <h5 class="text-danger mb-4" style="font-size: 1.2rem; font-weight: 600;">Suportes por Tipo</h5>
                                        <div id="suportesChart" class="chart-container" style="height: 300px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 mb-4">
                                <div class="card shadow-sm rounded-3 border-0">
                                    <div class="card-body text-center p-4">
                                        <h5 class="text-success mb-4" style="font-size: 1.2rem; font-weight: 600;">Feedbacks por Nível de Satisfação</h5>
                                        <div id="feedbacksChart" class="chart-container" style="height: 300px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
            const feedbacksData = @json($feedbacksData);
            const suportesData = @json($suportesData);

            Highcharts.chart('feedbacksChart', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Feedbacks por Nível de Satisfação'
                },
                xAxis: {
                    categories: feedbacksData.map(item => item.name),
                },
                yAxis: {
                    title: {
                        text: 'Quantidade'
                    }
                },
                series: [{
                    name: 'Nível de Satisfação',
                    data: feedbacksData.map(item => item.y),
                    color: '#32CD32',
                }]
            });

            Highcharts.chart('suportesChart', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Suportes por Tipo de Dúvida'
                },
                series: [{
                    name: 'Tipo de Dúvida',
                    colorByPoint: true,
                    data: suportesData,
                }]
            });
        });
        </script>
    </div>
</div>
@endsection
