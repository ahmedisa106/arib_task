@forelse($data as $employee)


    <tr>
        <td>{{$employee->id}}</td>

        <td>{{$employee->first_name}}</td>
        <td>{{$employee->last_name}}</td>
        <td>{{$employee->full_name}}</td>
        <td>{{$employee->salary}}</td>
        <td>{{@$employee->department->name}}</td>
        <td>{{@$employee->department->manager->name}}</td>
        <td>
            <img src="{{getFile($employee->image)}}" width="50" height="50" alt="">
        </td>

        <td>
            <a href="{{route('admin.employees.edit',$employee->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <form class="delete_row" action="{{route('admin.employees.delete',$employee->id)}}" style="display: inline" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
@empty

@endforelse
