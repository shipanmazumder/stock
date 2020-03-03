 <div class="row">
	<div class="col-sm-12">
		<table class="table table-bordered table-striped question_details">
			<thead>
                <tr>
                    <td>Voucher NO.</td>
                    <td colspan="3"><strong>{{$store_details->voucher_no}}</strong></td>
                </tr>
				<tr>
					<th>Sl.</th>
					<th>Product Name</th>
					<th>Short Desc</th>
					<th>Qty</th>
				</tr>
			</thead>
			<tbody>
                @isset($product_list)
                    @foreach($product_list as $key=>$value)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$value->product_name}}</td>
                            <td>{{$value->short_desc}}</td>
                            <td>{{$value->qty}}</td>
                        </tr>
                    @endforeach
                @endisset
                <tr>
                    <td colspan="3" class="text-right">Total:</td>
                    <td><strong>{{$store_details->total_qty}}</strong></td>
                </tr>
			</tbody>
		</table>
	</div>
     <div class="col-md-12 m-t-30">
         <p><strong>Voucher Image:</strong></p>
         @if($store_details->picture!='')
            <img src="{{asset($store_details->picture)}}" alt="" class="img-responsive m-t-22">
         @endif
     </div>
</div>
