@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-6">
            <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                             <h3 style="font-size:35px;">{{ $enrollmentsCount }}</h3>

                            <p style="font-size:23px;">Enrolled</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <a href="/application" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
            <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                             <h3 style="font-size:33px;">{{ $scheduledAssessmentsCount }}</h3>

                            <p style="font-size:23px;">Scheduled for Assessment</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        <a href="/student-assessments" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-6">
            <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 style="font-size:33px;">{{ $enrollmentsCount }}</h3>

                            <p style="font-size:23px;">Completed Requirements</p>
                        </div>
                        <div class="icon">
                        <i class="ion ion-bag"></i>
                        </div>
                        
                        <a href="http://127.0.0.1:8000/application" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
               
            </div>
         

            
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    {{-- <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">
                                {{ __('You are logged in!') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content -->
@endsection