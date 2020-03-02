@isset($stores)
    @foreach($stores as $key=>$value)
        <tr>
            <td class="text-center">{{++$key}}</td>
            <td >{{$value->supplier->name}}</td>
            <td >{{$value->voucher_no}}</td>
            <td >{{$value->total_qty}}</td>
            <td >{{date("d-m-Y",strtotime($value->date))}}</td>
            <td >{{$value->remarks}}</td>
            <td >{{$value->user->name}}</td>
            <td class="text-center" >
                <a  href="{{url("user/user-edit/".$value->id)}}"  class="text-info btn btn-info btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>
                 @if(is_super_admin())
                    <a onclick="return confirm('Are You Sure?')" href="{{url("user/delete/".$value['id'])}}"  class="btn btn-danger btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="8" class="text-center">{{$stores->links()}}</td>
    </tr>
@endisset
