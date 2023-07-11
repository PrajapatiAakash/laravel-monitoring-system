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
            labels: @json($data->pluck('day')),
            datasets: [{
                label: '{{ $attributes->get('title') }}',
                data: @json($data->pluck('count')),
                fill: false,
                backgroundColor: @json($data->pluck('backgroundcolor')),
                tension: 0.1
            }]
        };
        const config_{{ $canvasElementId }} = {
            type: 'bar',
            data: data_{{ $canvasElementId }},
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        };
        const {{ $canvasElementId }}_Element = document.getElementById('{{ $canvasElementId }}');
        const {{ $canvasElementId }}_Chart = new Chart({{ $canvasElementId }}_Element, config_{{ $canvasElementId }});
    </script>
@endpush
