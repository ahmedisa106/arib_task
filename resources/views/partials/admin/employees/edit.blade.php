@extends('layouts.master')
@section('css')
@endsection

@section('breadcrumb')
    <h1>
        {{$section_title}}
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
                <form role="form" method="post" action="{{route('admin.employees.update',$model->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{$model->id}}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name * </label>
                                    <input name="first_name" value="{{old('first_name',$model->first_name)}}" type="text" class="form-control @error('first_name') invalid  @enderror" id="first_name" placeholder="Enter first name" required>
                                    @error('first_name')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name * </label>
                                    <input name="last_name" value="{{old('last_name',$model->last_name)}}" type="text" class="form-control @error('last_name') invalid  @enderror" id="last_name" placeholder="Enter last name" required>
                                    @error('last_name')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email * </label>
                                    <input name="email" value="{{old('email',$model->email)}}" type="text" class="form-control @error('email') invalid  @enderror" id="email" placeholder="Enter Email" required>
                                    @error('email')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone * <span class="text-danger">( must start with one of the following: 010, 015, 011., must have at least 9 digits. )</span> </label>
                                    <input name="phone" value="{{old('phone',$model->phone)}}" type="text" class="form-control @error('phone') invalid  @enderror" id="phone" placeholder="Enter Phone" required>
                                    @error('phone')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Password * <span class="text-danger">(at least 8 characters., one uppercase and one lowercase letter.,and one symbol. )</span> </label>
                                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Keep it blank if you want" >
                                    @error('password')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="department_id">Department *</label>
                                    <select name="department_id" class="form-control" id="department_id">
                                        @foreach($departments as $department)
                                            <option @selected($department->id == $model->department_id) value="{{$department->id}}">{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="salary">Salary * </label>
                                    <input name="salary" value="{{old('salary',$model->salary)}}" type="number" class="form-control @error('salary') invalid  @enderror" id="salary" placeholder="Enter salary" required>
                                    @error('salary')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo">Photo * </label>
                                    <input name="image" accept="image/*" type="file" class="form-control image @error('photo') invalid  @enderror" id="photo" placeholder="Enter photo" value="{{$model->image}}">
                                    @error('photo')
                                    <span class="text-danger"> {{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" style=" margin: auto;width: 100px">
                                    <label for="photo_preview">Photo Preview </label>
                                    <img src="{{getFile($model->image)}}" class="image_preview" width="100" height="50" alt="">
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
                    window.location.href = '{{route('admin.employees.index')}}'
                }
            }
        });
    </script>
@endpushonce
