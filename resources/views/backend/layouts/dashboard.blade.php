@extends('backend.app')

@section('title', 'Admin || Dashboard')

@section('content')
    <!--app-content open-->
    <div class="app-content main-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Dashboard</h1>
                    </div>
                    <div class="ms-auto pageheader-btn">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <!-- Total Employees -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $totalEmployees }}</h3>
                                        <p class="text-muted fs-13 mb-0">Total Employees</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $totalWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Total Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Completed Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $completedWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Completed Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $pendingWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Pending Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Rescheduled Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $rescheduledWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Rescheduled Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-danger dash ms-auto box-shadow-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M11 5.5a.5.5 0 0 1 .5-.5h.5a.5.5 0 0 1 0 1h-.5a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-2 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm3 3a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z" />
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Teams -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $totalTeams }}</h3>
                                        <p class="text-muted fs-13 mb-0">Total Teams</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-purple dash ms-auto box-shadow-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Today's Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $todaysWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Today's Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                <path
                                                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- This Month Works -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $thisMonthWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">This Month Works</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Today's Completed -->
                    <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                        <div class="card overflow-hidden">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h3 class="mb-2 fw-semibold">{{ $todaysCompletedWorks }}</h3>
                                        <p class="text-muted fs-13 mb-0">Today's Completed</p>
                                    </div>
                                    <div class="col col-auto top-icn dash">
                                        <div class="counter-icon bg-success dash ms-auto box-shadow-success">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="fill-white"
                                                viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                <path
                                                    d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ROW-1 END-->

                <!-- ROW: Work & Team Analytics -->
                <div class="row">
                    <!-- Work Completion Pie -->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Work Completion</h3>
                            </div>
                            <div class="card-body">
                                <div id="work-completion-piechart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Top Teams Bar Chart -->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Top Teams (Last 30 Days)</h3>
                            </div>
                            <div class="card-body">
                                <div id="top-teams-barchart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Reschedule Requests -->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Reschedule Requests</h3>
                            </div>
                            <div class="card-body">
                                <div id="reschedule-requests-piechart" style="width:100%; height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW: Time Series -->
                <div class="row">
                    <!-- New Works Line Chart -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Works (Last 30 Days)</h3>
                            </div>
                            <div class="card-body">
                                <div id="new-works-linechart" style="width:100%; height:350px;"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Daily Completed Works -->
                    <div class="col-sm-12 col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Completed Works per Day</h3>
                            </div>
                            <div class="card-body">
                                <div id="completed-works-linechart" style="width:100%; height:350px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->
@endsection

@push('scripts')
    <!-- Load required libraries -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.36.3/dist/apexcharts.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Load Google Charts
            google.charts.load('current', {
                'packages': ['corechart', 'bar']
            });
            google.charts.setOnLoadCallback(fetchDashboardData);

            function fetchDashboardData() {
                fetch('/admin/dashboard/data')
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        const contentType = response.headers.get('content-type');
                        if (!contentType || !contentType.includes('application/json')) {
                            throw new Error("Response wasn't JSON");
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Draw all charts
                        drawWorkCompletionPieChart(data.work_completion);
                        drawTopTeamsBarChart(data.top_teams_by_work);
                        drawRescheduleRequestsPieChart(data.reschedule_requests);
                        drawNewWorksLineChart(data.new_works);
                        drawCompletedWorksLineChart(data.daily_completed_works);
                    })
                    .catch(error => {
                        console.error('Error fetching data:', error);
                        alert('Failed to load dashboard data. Please try again later.');
                    });
            }

            // Work Completion Pie Chart
            function drawWorkCompletionPieChart(data) {
                const chartData = [
                    ['Status', 'Count'],
                    ['Completed', data.completed],
                    ['Incomplete', data.incomplete]
                ];
                const gData = google.visualization.arrayToDataTable(chartData);
                const options = {
                    pieHole: 0.4,
                    colors: ['#00E396', '#FF4560'],
                    legend: {
                        position: 'bottom'
                    }
                };
                const chart = new google.visualization.PieChart(document.getElementById(
                    'work-completion-piechart'));
                chart.draw(gData, options);
            }

            // Top Teams Bar Chart
            function drawTopTeamsBarChart(data) {
                const rows = Object.entries(data).map(([team, count]) => [team, count]);
                const chartData = [
                    ['Team', 'Works']
                ].concat(rows);
                const gData = google.visualization.arrayToDataTable(chartData);
                const options = {
                    legend: {
                        position: 'none'
                    },
                    colors: ['#008FFB'],
                    hAxis: {
                        title: 'Number of Works'
                    },
                    vAxis: {
                        title: 'Team'
                    }
                };
                const chart = new google.visualization.BarChart(document.getElementById('top-teams-barchart'));
                chart.draw(gData, options);
            }

            // Reschedule Requests Pie
            function drawRescheduleRequestsPieChart(data) {
                const chartData = [
                    ['Status', 'Count'],
                    ['Pending', data.pending],
                    ['Approved', data.approved],
                    ['Rejected', data.rejected]
                ];
                const gData = google.visualization.arrayToDataTable(chartData);
                const options = {
                    colors: ['#FFA500', '#00E396', '#FF4560'],
                    legend: {
                        position: 'bottom'
                    }
                };
                const chart = new google.visualization.PieChart(document.getElementById(
                    'reschedule-requests-piechart'));
                chart.draw(gData, options);
            }

            // New Works Line Chart (Last 30 Days)
            function drawNewWorksLineChart(data) {
                const dates = Object.keys(data).sort();
                const counts = dates.map(date => data[date] || 0);
                const chartData = [
                    ['Date', 'New Works']
                ].concat(dates.map((d, i) => [d, counts[i]]));
                const gData = google.visualization.arrayToDataTable(chartData);
                const options = {
                    legend: {
                        position: 'none'
                    },
                    colors: ['#008FFB'],
                    hAxis: {
                        title: 'Date'
                    },
                    vAxis: {
                        title: 'Count'
                    }
                };
                const chart = new google.visualization.LineChart(document.getElementById('new-works-linechart'));
                chart.draw(gData, options);
            }

            // Completed Works per Day
            function drawCompletedWorksLineChart(data) {
                const dates = Object.keys(data).sort();
                const counts = dates.map(date => data[date] || 0);
                const chartData = [
                    ['Date', 'Completed']
                ].concat(dates.map((d, i) => [d, counts[i]]));
                const gData = google.visualization.arrayToDataTable(chartData);
                const options = {
                    legend: {
                        position: 'none'
                    },
                    colors: ['#00E396'],
                    hAxis: {
                        title: 'Date'
                    },
                    vAxis: {
                        title: 'Count'
                    }
                };
                const chart = new google.visualization.LineChart(document.getElementById(
                    'completed-works-linechart'));
                chart.draw(gData, options);
            }
        });
    </script>
@endpush
