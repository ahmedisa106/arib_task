@forelse($data as $task)
    <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->name}}</td>

        <td>
            @if($task->status == 'pending')
                <p class=""><i class="fa fa-exclamation-triangle text-warning" title="pending"></i> Pending</p>
            @else
                <i class="fa fa-check-circle text-success"></i> Done
            @endif
        </td>
        <td>
            <a href="{{route('employee.tasks.show',$task->id)}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>

        </td>
    </tr>
@empty

@endforelse
