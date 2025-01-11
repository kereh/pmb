<div>
    <div class="card">
        <div class="card-header">
            <h4>Line Area Chart - Pendaftar</h4>
        </div>
        <div class="card-body">
            <div id="area"></div>
        </div>
    </div>

    {{-- @dd($timestamps, $seriesData) --}}

    <script>
        document.addEventListener('livewire:navigated', function() {
            var areaOptions = {
                series: @json($seriesData),
                chart: {
                    height: 350,
                    type: "area",
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    curve: "smooth",
                },
                xaxis: {
                    type: "datetime",
                    categories: @json($timestamps),
                },
                tooltip: {
                    x: {
                        format: "yy/MM/dd",
                    },
                },
            };
            var area = new ApexCharts(document.querySelector("#area"), areaOptions);
            area.render();
        });
    </script>
</div>
