// Perbaikan fungsi getChartColorsArray dengan validasi
function getChartColorsArray(selector) {
    const element = document.querySelector(selector);
    if (!element) {
        console.warn(`Element ${selector} not found`);
        return ['#556ee6', '#34c38f']; // Default colors
    }
    
    const colorsAttr = element.getAttribute("data-colors");
    if (!colorsAttr || colorsAttr === "undefined") {
        console.warn(`data-colors attribute not found or undefined for ${selector}`);
        return ['#556ee6', '#34c38f']; // Default colors
    }
    
    try {
        const colors = JSON.parse(colorsAttr);
        return colors.map(function(color) {
            color = color.replace(" ", "");
            if (color.indexOf("--") === -1) return color;
            color = getComputedStyle(document.documentElement).getPropertyValue(color);
            return color || undefined;
        });
    } catch (error) {
        console.error(`Error parsing colors for ${selector}:`, error);
        return ['#556ee6', '#34c38f']; // Default colors
    }
}

// Perbaikan inisialisasi chart dengan validasi elemen
document.addEventListener('DOMContentLoaded', function() {
    // Mini Chart 1
    const miniChart1 = document.querySelector("#mini-chart1");
    if (miniChart1) {
        var barchartColors = getChartColorsArray("#mini-chart1");
        var options = {
            series: [60, 40],
            chart: { type: "donut", height: 110 },
            colors: barchartColors,
            legend: { show: false },
            dataLabels: { enabled: false }
        };
        var chart = new ApexCharts(miniChart1, options);
        chart.render();
        ChartColorChange(chart, "#mini-chart1");
    }

    // Mini Chart 2
    const miniChart2 = document.querySelector("#mini-chart2");
    if (miniChart2) {
        var barchartColors = getChartColorsArray("#mini-chart2");
        var options = {
            series: [30, 55],
            chart: { type: "donut", height: 110 },
            colors: barchartColors,
            legend: { show: false },
            dataLabels: { enabled: false }
        };
        var chart = new ApexCharts(miniChart2, options);
        chart.render();
        ChartColorChange(chart, "#mini-chart2");
    }

    // Mini Chart 3
    const miniChart3 = document.querySelector("#mini-chart3");
    if (miniChart3) {
        var barchartColors = getChartColorsArray("#mini-chart3");
        var options = {
            series: [65, 45],
            chart: { type: "donut", height: 110 },
            colors: barchartColors,
            legend: { show: false },
            dataLabels: { enabled: false }
        };
        var chart = new ApexCharts(miniChart3, options);
        chart.render();
        ChartColorChange(chart, "#mini-chart3");
    }

    // Mini Chart 4
    const miniChart4 = document.querySelector("#mini-chart4");
    if (miniChart4) {
        var barchartColors = getChartColorsArray("#mini-chart4");
        var options = {
            series: [30, 70],
            chart: { type: "donut", height: 110 },
            colors: barchartColors,
            legend: { show: false },
            dataLabels: { enabled: false }
        };
        var chart = new ApexCharts(miniChart4, options);
        chart.render();
        ChartColorChange(chart, "#mini-chart4");
    }

    // Market Overview Chart
    const marketOverview = document.querySelector("#market-overview");
    if (marketOverview) {
        var barchartColors = getChartColorsArray("#market-overview");
        var options = {
            series: [
                { name: "Profit", data: [12.45, 16.2, 8.9, 11.42, 12.6, 18.1, 18.2, 14.16, 11.1, 8.09, 16.34, 12.88] },
                { name: "Loss", data: [-11.45, -15.42, -7.9, -12.42, -12.6, -18.1, -18.2, -14.16, -11.1, -7.09, -15.34, -11.88] }
            ],
            chart: { type: "bar", height: 400, stacked: true, toolbar: { show: false } },
            plotOptions: { bar: { columnWidth: "20%" } },
            colors: barchartColors,
            fill: { opacity: 1 },
            dataLabels: { enabled: false },
            legend: { show: false },
            yaxis: {
                labels: {
                    formatter: function(val) {
                        return val.toFixed(0) + "%";
                    }
                }
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                labels: { rotate: -90 }
            }
        };
        var chart = new ApexCharts(marketOverview, options);
        chart.render();
        ChartColorChange(chart, "#market-overview");
    }

    // Sales by Locations Map
    const salesByLocations = document.querySelector("#sales-by-locations");
    if (salesByLocations) {
        var vectormapColors = getChartColorsArray("#sales-by-locations");
        $("#sales-by-locations").vectorMap({
            map: "world_mill_en",
            normalizeFunction: "polynomial",
            hoverOpacity: 0.7,
            hoverColor: false,
            regionStyle: {
                initial: { fill: "#e9e9ef" }
            },
            markerStyle: {
                initial: {
                    r: 9,
                    fill: vectormapColors,
                    "fill-opacity": 0.9,
                    stroke: "#fff",
                    "stroke-width": 7,
                    "stroke-opacity": 0.4
                },
                hover: {
                    stroke: "#fff",
                    "fill-opacity": 1,
                    "stroke-width": 1.5
                }
            },
            backgroundColor: "transparent",
            markers: [
                { latLng: [41.9, 12.45], name: "USA" },
                { latLng: [12.05, -61.75], name: "Russia" },
                { latLng: [1.3, 103.8], name: "Australia" }
            ]
        });
    }
});