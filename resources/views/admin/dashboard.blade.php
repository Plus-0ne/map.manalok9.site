<!DOCTYPE html>
<html lang="en">

<head>
    <x-meta title="{{ $title }}"></x-meta>

    <x-links></x-links>
    <link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
</head>

<body>
    <div class="wrapper">
        <x-admin.sidebar></x-admin.sidebar>
        <div class="main">
            <x-admin.navigation></x-admin.navigation>

            <div class="container-fluid">
                <div class="row p-3">
                    <div class="col-12 col-sm-12 col-md-4 p-1">
                        <div class="p-5">
                            <canvas id="chartId" aria-label="chart"></canvas>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-8 p-1">
                        <div class="p-5">
                            <canvas id="chartBars" aria-label="chart"></canvas>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 p-1">
                        <div class="p-5">
                            <div class="lead">
                                Activities
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-12 col-md-6 p-1">
                        <div class="p-5">
                            <div class="lead">
                                Logs
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-footer></x-footer>
    <x-scripts></x-scripts>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script>
        var chrt = document.getElementById("chartId").getContext("2d");
        var chartId = new Chart(chrt, {
           type: 'doughnut',
           data: {
              labels: ["HTML", "CSS", "JAVASCRIPT", "CHART.JS", "JQUERY", "BOOTSTRP"],
              datasets: [{
                label: "online tutorial subjects",
                data: [20, 40, 13, 35, 20, 38],
                backgroundColor: ['yellow', 'aqua', 'pink', 'lightgreen', 'gold', 'lightblue'],
                hoverOffset: 5
              }],
           },
           options: {
              responsive: true,
           },
        });
    </script>

    <script>
        const ctx = document.getElementById("chartBars");

            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    datasets: [{
                        label: '# of Votes',
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                }
            });
    </script>

</body>

</html>
