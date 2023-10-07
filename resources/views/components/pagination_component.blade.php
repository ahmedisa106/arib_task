@if(isset($data) && method_exists($data,'links'))

    <div class="box-footer pagination_component text-center">
        {!! $data->links() !!}
    </div>
@endif
