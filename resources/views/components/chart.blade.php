<div class="flex flex-col w-full h-full">
    @if ($title || $totalData)
    <div class="flex justify-between">
        @if ($title)
            <h5 class="leading-none text-3xl font-bold text-dark-500 dark:text-light-500">{{ $title }}</h5>
        @endif
        @if ($totalData)
            <p class="leading-none text-3xl font-bold text-dark-500 dark:text-light-500">{{ $totalData }}</p>
        @endif
    </div>
    @endif
    <div id="chart-{{ $chartId ?? 'default' }}" class="min-h-[300px] max-h-[350px]"></div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const fetchUrl = "{{ $fetchUrl }}";
            const chartElement = document.getElementById("chart-{{ $chartId ?? 'default' }}");

            if (chartElement && typeof ApexCharts !== "undefined") {
                fetch(fetchUrl)
                    .then(response => response.json())
                    .then(data => {
                        let options;
                        if ("{{ $chartType }}" === "donut") {
                            const labels = data.map(item => item.gender); // Assuming your data has a 'gender' field
                            const seriesData = data.map(item => item.total); // Assuming your data has a 'total' field

                            options = {
                                chart: {
                                    type: "donut",
                                    height: "100%",
                                    fontFamily: "Inter, sans-serif",
                                    toolbar: { show: false },
                                },
                                series: seriesData,
                                labels: labels,
                                tooltip: { enabled: true },
                                stroke: { show: false },
                                legend: { position: 'bottom' },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            size: '65%'
                                        }
                                    }
                                },
                                dataLabels: { enabled: true },
                            };
                        } else {
                            const categories = data.map(item => item.date);
                            const seriesData = data.map(item => item.total); // Adjust according to your data format

                            options = {
                                chart: {
                                    type: "{{ $chartType }}",
                                    height: "100%",
                                    fontFamily: "Inter, sans-serif",
                                    toolbar: { show: false },
                                },
                                series: [
                                    {
                                        name: "{{ $seriesName }}",
                                        data: seriesData,
                                        color: "{{ $color }}",
                                    },
                                ],
                                xaxis: { categories: categories },
                                yaxis: { labels: { show: true } },
                                tooltip: { enabled: true },
                                stroke: { curve: "smooth", width: 3 },
                                grid: { show: false },
                                fill: { type: "gradient" },
                            };
                        }

                        const chart = new ApexCharts(chartElement, options);
                        chart.render();
                    })
                    .catch(error => console.error("Error loading chart data:", error));
            }
        });
    </script>
@endpush