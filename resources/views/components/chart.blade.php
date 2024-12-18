<div style="width: 100%; height: 400px;">
  <canvas id="{{ $id }}"></canvas>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('{{ $id }}').getContext('2d');
            new Chart(ctx, {
                type: '{{ $type }}',
                data: {!! json_encode($data) !!},
                options: {!! json_encode($options) !!}
            });
        });
    </script>
 @endpush
