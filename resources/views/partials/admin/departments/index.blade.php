@extends('layouts.master')
@section('breadcrumb')
    <h1>
        Home
        <small>{{$section_title}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">{{@$section_title}}</li>
    </ol>
@endsection

@section('content')

    @if($message = session('success'))
        <div class="alert alert-success alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Success!</h4>
            {{$message}}
        </div>
    @endif

    <div class="box">
        <div class="box-header">
            <a href="{{route('admin.departments.create')}}" class="btn btn-success">
                Create new {{\Illuminate\Support\Str::singular($section_title)}}
                <i class="fa fa-plus"></i>
            </a>


            <div class="box-tools">
                <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                    <input type="text" name="table_search" value="{{request('search')}}" class="form-control pull-right table_search" placeholder="Search">

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding data_table">
            <table class="table table-hover text-center table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Manager</th>
                    <th>Number of Employees</th>
                    <th>Sum of Employees Salaries</th>
                    <th>Actions</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@pushonce('js')
    <script>
        let table_data_url = '{{route('admin.departments.data')}}',
            table_search = $('.table_search').val(),
            csrf_token = "{{csrf_token()}}",
            pagination = true,
            perPage = 10,
            columns = ['id', 'name', 'manager_id'],
            relations = ['manager', 'employees'];


        $(document).ready(function () {
            /*fetch data */
            getTableData(table_data_url, table_search, pagination, perPage, columns, relations);

            /*delete row*/
            $(document).on('submit', '.delete_row', function (e) {
                e.preventDefault();
                let confirmation = confirm("are you sure? "),
                    url = $(this).attr('action');
                if (confirmation) {
                    $.ajaxDeleteRow(url, $(this), callback);
                }

                function callback(response) {
                    alert("Error : " + response.responseJSON.message)
                }
            });
        });


    </script>
@endpushonce
