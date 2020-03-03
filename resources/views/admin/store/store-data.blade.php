@isset($stores)
    @if(count($stores)>0)
    @foreach($stores as $key=>$value)
        <tr>
            <td class="text-center">{{$sl_counter++}}</td>
            <td >{{$value->supplier->name}}</td>
            <td >{{$value->voucher_no}}</td>
            <td >{{$value->total_qty}}</td>
            <td >{{date("d-m-Y",strtotime($value->date))}}</td>
            <td >{{$value->remarks}}</td>
            <td >{{$value->user->name}}</td>
			<td class="text-center"><button type="button" class="btn btn-success btn-sm" id="details_modal" data-toggle="modal" data-id="{{$value->id}}" data-target="#con-close-modal"><i class="ion ion-android-drawer"></i></button></td>
            <td class="text-center" >
                <a  href="{{url("store/edit/".$value->id)}}"  class="text-info btn btn-info btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="Edit" id=""><i class="fa fa-edit"></i></a>
                 @if(is_super_admin())
                    <a onclick="return confirm('Are You Sure?')" href="{{url("store/delete/".$value['id'])}}"  class="btn btn-danger btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
                @endif
            </td>
        </tr>
    @endforeach
    <tr>
        <td colspan="9" class="text-center">{{$stores->links()}}</td>
    </tr>
    @else
    <tr>
        <td colspan="9" class="text-center"><h2><code>No data found!</code></h2></td>
    </tr>
    @endif
@endisset
