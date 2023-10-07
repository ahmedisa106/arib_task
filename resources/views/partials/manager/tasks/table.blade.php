@forelse($data as $task)
    <tr>

        <td>{{$task->id}}</td>
        <td>{{$task->name}}</td>
        <td>{{$task->employee->full_name}}</td>
        <td>
            @if($task->status == 'pending')
                <p class=""><i class="fa fa-exclamation-triangle text-warning" title="pending"></i> Pending</p>
            @else
                <i class="fa fa-check-circle text-success"></i> Done
            @endif
        </td>
        <td>
            <a href="{{route('manager.tasks.edit',$task->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <form class="delete_row" action="{{route('manager.tasks.delete',$task->id)}}" style="display: inline" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
@empty

@endforelse
