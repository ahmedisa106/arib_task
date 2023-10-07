@extends('layouts.master')
@section('css')

@endsection
@section('breadcrumb')
    <h1>
        Dashboard
        <small>{{auth('employee')->user()->name}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
@endsection
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{auth('employee')->user()->doneTasksCount()}}<sup style="font-size: 20px"></sup></h3>
                    <p>Done Tasks</p>
                </div>
                <div class="icon">
                    <i class="fa fa-check-square"></i>
                </div>
                <a href="{{route('employee.tasks.index','search=done')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{auth('employee')->user()->pendingTasksCount()}}</h3>

                    <p>Pending Tasks</p>
                </div>
                <div class="icon">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>
                <a href="{{route('employee.tasks.index','search=pending')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>


    </div>

@endsection
@pushonce('js')

@endpushonce
