@forelse($data as $manager)
    <tr>
        <td>{{$manager->id}}</td>
        <td>{{$manager->name}}</td>
        <td>{{$manager->email}}</td>
        <td>{{$manager->phone}}</td>
        <td>
            <a href="{{route('admin.managers.edit',$manager->id)}}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
            <form class="delete_row" action="{{route('admin.managers.delete',$manager->id)}}" style="display: inline" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
            </form>
        </td>
    </tr>
@empty

@endforelse
