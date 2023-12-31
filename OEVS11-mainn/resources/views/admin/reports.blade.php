@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ __('Reports') }}</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Chart and analytics cards -->
                    <div class="row">
                        <!-- Chart card -->
                        <div class="col-lg-4">
                            <div class="card" >
                                <div class="card-body">
                                    <canvas id="enrollmentStatusChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Line chart card -->
                        <div class="col-lg-4">
                            <div class="card" style="height:340px">
                                <div class="card-body">
                                    <canvas id="enrollmentCoursesChart"></canvas>
                                </div>
                            </div>
                        </div>
                        <!-- Assessment Remarks Bar Chart Card -->
                        <div class="col-lg-4">
                            <div class="card" style="height:340px">
                                <div class="card-body">
                                    <canvas id="assessmentRemarksChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 lg-4">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalEnrollments }}</h3>
                                    <p style="font-size:25px;">Total Enrollments</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-6 lg-4">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ $totalInProgress }}</h3>
                                    <p style="font-size:25px;">Incomplete Requirements</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-spinner"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                        <div class="card-footer clearfix"></div>
                    </div><!--firtcard body-->
                    {{-- data in the table --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enrollments Report</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="enrollmentsTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Enrolled Students</th>
                                        <th>Course</th>
                                        <th>Status</th>
                                        <th>Enrollment Type</th>
                                        <th>Scholarship Grant</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($enrollments as $enrollment)
                                        <tr>
                                            <td>{{ $enrollment->id }}</td>
                                            <td>{{ $enrollment->user->name ?? 'None' }}</td>
                                            <td>{{ $enrollment->course->name }}</td> <!-- Changed from course_id -->
                                            <td>{{ $enrollment->status }}</td>
                                            <td>{{ $enrollment->enrollment_type }}</td>
                                            <td>{{ $enrollment->scholarship_grant }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h3 class="card-title">Enrollments Report</h3>
                            <button class="btn btn-primary" onclick="printTable('enrollmentsTable')">Print</button>
                        </div>
                         <div class="card-footer clearfix"></div>
                    </div>   <!--end second card sg 12--> 
                </div><!--col sg 12-->
            </div><!--row-->
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function printTable(tableId) {
            const printWindow = window.open('', '_blank');
            printWindow.document.write('<html><head><title>Print<img src=./" alt="Girl in a jacket" width="500" height="600"></title></head><body>');
            printWindow.document.write('<h1>' + document.title + '</h1>');
            printWindow.document.write(document.getElementById(tableId).outerHTML);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }
    </script>
    <script>
    // Enrollment Courses Line Chart
    const enrollmentCourseData = @json($enrollmentCourseData);
    const courseLabels = enrollmentCourseData.map(e => e.course);
    const enrollmentCounts = enrollmentCourseData.map(e => e.enrollments);

    const lineCtx = document.getElementById('enrollmentCoursesChart').getContext('2d');
    const enrollmentCoursesChart = new Chart(lineCtx, {
    type: 'line',
    data: {
        labels: courseLabels,
        datasets: [{
            label: 'Enrollments per Course',
            data: enrollmentCounts,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            maintainAspectRatio: false,
            responsive: true
        }
    });

    </script>
    <script>
        // Enrollment Types Pie Chart
       // Get the enrollment data from the server-side template
const enrollmentTypeData = @json($enrollmentTypeData);

// Extract the enrollment type labels and counts from the data
const enrollmentTypeLabels = enrollmentTypeData.map(e => e.enrollment_type);
const enrollmentTypeCounts = enrollmentTypeData.map(e => e.count);

// Calculate total count
const totalCount = enrollmentTypeCounts.reduce((sum, count) => sum + count, 0);

// Calculate percentages
const percentages = enrollmentTypeCounts.map(count => ((count / totalCount) * 100).toFixed(2));

// Get the canvas element
const pieCtx = document.getElementById('enrollmentStatusChart').getContext('2d');

// Create the pie chart
const enrollmentStatusChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: enrollmentTypeLabels.map((label, index) => `${label} (${percentages[index]}%)`),
        datasets: [{
            data: enrollmentTypeCounts,
            backgroundColor: ['#FF6384', '#36A2EB'],
            hoverBackgroundColor: ['#FF6384', '#36A2EB']
        }]
    },
    options: {
        maintainAspectRatio: false,
        responsive: true,
        tooltips: {
            callbacks: {
                label: function (tooltipItem, data) {
                    const dataIndex = tooltipItem.index;
                    const label = data.labels[dataIndex];
                    const count = data.datasets[0].data[dataIndex];
                    return `${label}: ${count} (${percentages[dataIndex]}%)`;
                }
            }
        }
    }
});

        // Student Assessment Remarks Bar Chart
        const assessmentRemarksData = @json($assessmentRemarksData);
        const assessmentRemarksLabels = assessmentRemarksData.map(e => e.remarks);
        const assessmentRemarksCounts = assessmentRemarksData.map(e => e.count);

        const barCtx = document.getElementById('assessmentRemarksChart').getContext('2d');
        const assessmentRemarksChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: assessmentRemarksLabels,
                datasets: [{
                    label: 'Student Assessments by Remarks',
                    data: assessmentRemarksCounts,
                    backgroundColor: ['#42A5F5', '#66BB6A'],
                    borderColor: ['#42A5F5', '#66BB6A'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    },
                    x: {
                        barPercentage: 0.1, // Controls the width of individual bars (0 to 1)
                        categoryPercentage: 0.5 // Controls the width of the category containing the bars (0 to 1)
                    }
                },
                maintainAspectRatio: false,
                responsive: true
            }
        });
    </script>
    <!-- /.content -->
    <script>
        function applyFilters() {
        let url = new URL(window.location.href);
        let searchParams = new URLSearchParams(url.search);

        let status = document.getElementById('status').value;
        let dateFrom = document.getElementById('date_from').value;
        let dateTo = document.getElementById('date_to').value;
        let trainingDateFrom = document.getElementById('training_date_from').value;
        let trainingDateTo = document.getElementById('training_date_to').value;

        searchParams.set('_token', '{{ csrf_token() }}');

        if (status) {
            searchParams.set('status', status);
        } else {
            searchParams.delete('status');
        }

        if (dateFrom) {
            searchParams.set('date_from', dateFrom);
        } else {
            searchParams.delete('date_from');
        }

        if (dateTo) {
            searchParams.set('date_to', dateTo);
        } else {
            searchParams.delete('date_to');
        }

        if (trainingDateFrom) {
            searchParams.set('training_date_from', trainingDateFrom);
        } else {
            searchParams.delete('training_date_from');
        }

        if (trainingDateTo) {
            searchParams.set('training_date_to', trainingDateTo);
        } else {
            searchParams.delete('training_date_to');
        }

        url.search = searchParams.toString();
        window.location.href = url.toString();
    }

    </script>


@endsection