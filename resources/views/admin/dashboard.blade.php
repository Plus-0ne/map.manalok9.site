@include('admin.sections.header')
<link rel="stylesheet" href="{{ asset('css/admin/style.css') }}">
</head>

<body>
    @include('admin.sections.nav')

    <div class="wrapper">
        @include('admin.sections.sidebar')

        <div class="main-content py-3">

            <div class="container-fluid container-lg">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    <span class="mdi mdi-home"></span> Dashboard
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4 mb-3">
                        <div class="card p-3">
                            <h5>
                                Total visits
                            </h5>
                            <canvas id="chartId" aria-label="chart"></canvas>
                        </div>
                    </div>

                    <div class="col-12 col-md-8 mb-3">
                        <div class="card p-3">
                            <h5>
                                Visit per month
                            </h5>
                            <canvas id="chartBars" aria-label="chart"></canvas>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card p-3">
                            <h5>
                                Activities
                            </h5>

                            <div class="w-100">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 mb-3">
                        <div class="card p-3">
                            <h5>
                                Logs
                            </h5>
                            <div class="w-100">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start active"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action flex-column align-items-start disabled">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Heading</h5>
                                            <small class="text-muted">Description</small>
                                        </div>
                                        <p class="mb-1">Paragraph</p>
                                        <small class="text-muted">paragraph footer</small>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @include('admin.sections.scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
        // Get top five visits for chart analysis
        let chrt = document.getElementById("chartId").getContext("2d");
        let chartId = new Chart(chrt, {
           type: 'doughnut',
           data: {
            //   labels: ["HTML", "CSS", "JAVASCRIPT", "CHART.JS", "JQUERY", "BOOTSTRP"],
              datasets: [{
                label: "Total",
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
