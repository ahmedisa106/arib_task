@forelse($data as $department)
    <tr>
        <td>{{$department->id}}</td>

        <td>{{$department->name}}</td>
        <td>{{$department->manager->name}}</td>
        <td>{{$department->employees->count()}}</td>
        <td>{{$department->employees->sum('salary')}}</td>

        <td>
            <a href="{{route('admin.departments.edit',$department->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <form class="delete_row" action="{{route('admin.departments.delete',$department->id)}}" style="display: inline" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
@empty

@endforelse
