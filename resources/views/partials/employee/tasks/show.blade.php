@extends('layouts.master')
@section('breadcrumb')
    <h1>
        Home
        <small>{{$section_sub_title}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('employee.home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li href="{{route('employee.tasks.index')}}">{{@$section_title}}</li>
        <li class="active">{{@$model->name}}</li>
    </ol>
@endsection
@section('content')

    <div class="row">
        <div class="container">
            <table class="table table-bordered table-hover table-striped text-center">
                <tr>
                    <th>ID</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Actions ( change status )</th>
                </tr>
                <tbody>
                <tr>
                    <td>{{$model->id}}</td>
                    <td>{{$model->name}}</td>
                    <td>{{$model->status}}</td>
                    <td>
                        <input class="task_status" data-id="{{$model->id}}" data-status="{{$model->status}}" type="checkbox" @checked($model->status =='done')>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
@endsection
@pushonce('js')
    <script>
        $('.task_status').on('change', function () {
            let task_id = $(this).data('id'),
                task_status = $(this).data('status') == 'pending' ? 'done' : 'pending',
                url = "{{route('employee.tasks.change_status',':id')}}";
            url = url.replace(':id', task_id);

            $.ajax({
                type: "post",
                url: url,
                data: {
                    "_token": "{{csrf_token()}}",
                    status: task_status,
                    id: task_id
                },
                success: function (response) {
                  alert(response.message);
                },
                error: function (response) {
                    alert(response.responseJSON.message)
                }
            })

        })
    </script>
@endpushonce
