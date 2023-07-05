<h3 class="mb-2 text-center">{{ $attributes->get('title') }}</h2>
@php
    $canvasElementId = $attributes->get('id');
    $canvasElementId = str_replace(' ', '_', $canvasElementId);
    $canvasElementId = str_replace('-', '_', $canvasElementId);
@endphp
<canvas id="{{ $canvasElementId }}">
</canvas>
@push('scripts')
    <script>
        const data_{{ $canvasElementId }} = {
            labels: @json($data->pluck('log_level')),
            datasets: [{
                label: '{{ $attributes->get('title') }}',
                data: @json($data->pluck('count')),
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
                    'rgb(255, 100, 86)',
                    'rgb(100, 205, 86)',
                    'rgb(255, 150, 145)',
                    'rgb(150, 205, 125)',
                    'rgb(255, 185, 212)',
                ],
                hoverOffset: 4
            }]
        };
        const config_{{ $canvasElementId }} = {
            type: 'doughnut',
            data: data_{{ $canvasElementId }},
            options: {
                responsive: true,
                plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Chart.js Doughnut Chart'
                }
                }
            },
        };
        // Graphs
        const {{ $canvasElementId }}_Element = document.getElementById('{{ $canvasElementId }}');
        const {{ $canvasElementId }}_Chart = new Chart({{ $canvasElementId }}_Element, config_{{ $canvasElementId }});
    </script>
@endpush
