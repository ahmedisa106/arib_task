@extends('layouts.master')
@section('css')
@endsection

@section('breadcrumb')
    <h1>
        {{$section_title}}
        <small>{{$section_title}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('manager.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('manager.tasks.index')}}"><i class="fa fa-user-circle"></i> {{@$section_title}}</a></li>
        <li class="active">{{@ucwords($section_sub_title)}}</li>
    </ol>
@endsection
@section('content')

    <div class="row">

        <div class="col-md-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{@ucwords($section_sub_title)}}</h3>
                </div>


                <div class=" errors_container d-none">


                </div>


                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('manager.tasks.store')}}">
                    @csrf
                    <input type="hidden" name="manager_id" value="{{auth('manager')->id()}}">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Task Name * </label>
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control @error('name') invalid  @enderror" id="name" placeholder="Enter Name" required>
                                    @error('name')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="employee_id">Employee *</label>
                                    <select name="employee_id" class="form-control" id="employee_id">
                                        @foreach($employees as $employee)
                                            <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Save {{ucfirst(\Illuminate\Support\Str::singular($section_title))}}</button>
                    </div>
                </form>
            </div>

        </div>

    </div>
@endsection

@pushonce('js')
    <script>
        $('form').on('submit', function (e) {
            e.preventDefault();
            var url = $(this).attr('action'),
                data = new FormData(this);
            $.ajaxSubmit(url, data, callBack);

            function callBack(response) {
                if (response.status === 200) {
                    window.location.href = '{{route('manager.tasks.index')}}'
                }
            }
        })
    </script>
@endpushonce
