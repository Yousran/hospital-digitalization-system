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
    <div id="chart-{{ $id ?? 'default' }}" style="height: 300px;"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fetchUrl = "{{ $fetchUrl }}";
        const chartElement = document.getElementById("chart-{{ $id ?? 'default' }}");

        if (chartElement && typeof ApexCharts !== "undefined") {
            fetch(fetchUrl)
                .then(response => response.json())
                .then(data => {
                    const categories = data.map(item => item.date);
                    const seriesData = data.map(item => item.total); // Sesuaikan dengan format data

                    const options = {
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

                    const chart = new ApexCharts(chartElement, options);
                    chart.render();
                })
                .catch(error => console.error("Error loading chart data:", error));
        }
    });
</script>