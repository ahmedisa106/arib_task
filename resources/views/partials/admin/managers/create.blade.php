@extends('layouts.master')
@section('css')
@endsection

@section('breadcrumb')
    <h1>
        Managers
        <small>{{$section_title}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{route('admin.managers.index')}}"><i class="fa fa-user-circle"></i> {{@$section_title}}</a></li>
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
                <form role="form" method="post" action="{{route('admin.managers.store')}}">
                    @csrf
                    <div class="box-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name * </label>
                                    <input name="name" value="{{old('name')}}" type="text" class="form-control @error('name') invalid  @enderror" id="name" placeholder="Enter Name" required>
                                    @error('name')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email address *</label>
                                    <input name="email" value="{{old('email')}}" type="email" class="form-control" id="email" placeholder="Enter email" required>
                                    @error('email')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone * <span class="text-danger">( must start with one of the following: 010, 015, 011., must have at least 9 digits. )</span> </label>
                                    <input name="phone" value="{{old('phone')}}" type="number" class="form-control" id="phone" placeholder="Phone" required>
                                    @error('phone')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password * <span class="text-danger">(at least 8 characters., one uppercase and one lowercase letter.,and one symbol. )</span> </label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
                                    @error('password')
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
                    window.location.href = '{{route('admin.managers.index')}}'
                }
            }
        })
    </script>
@endpushonce
