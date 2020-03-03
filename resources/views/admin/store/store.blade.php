@extends('admin.layout.default')
@section('title_area')
    Product Store
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    @isset($add)
                    <form id="product_store" enctype="multipart/form-data">
                        @csrf
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                Product Store
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div id="product_part">
                                                <div class="product_append" id="1">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="product_id">Product</label><small class="req">*</small>
                                                             <select id="product_id" required name="product_id[]" class="form-control selectpicker" data-live-search="true">
                                                            <option value="">--Select--</option>
                                                                @if(count($products)>0)
                                                                    @foreach($products as $value)
                                                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="short_desc">Short Description </label>
                                                            <input disabled   name="short_desc" placeholder="Short Description" type="text" class="form-control" id="short_desc">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="qty">Qty </label><small class="req">*</small>
                                                        <div class="input-group">
                                                        <input  name="qty[]" type="text" required class="form-control" id="qty"  placeholder="Product Qty">
                                                            <div class="input-group-btn">
                                                                <button class="btn btn-info" id="product_add_button" type="button">
                                                                    <i class="md md-add"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="supplier_id">Supplier</label><small class="req">*</small>
                                                     <select id="supplier_id" required name="supplier_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select--</option>
                                                        @if(count($suppliers)>0)
                                                            @foreach($suppliers as $value)
                                                                <option value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="voucher_no">Voucher No. </label><small class="req">*</small>
                                                    <input  name="voucher_no" id="voucher_no" type="text" placeholder="Voucher No." required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="picture">Voucher Image </label><small class="req">*</small>(<code>JPG PNG MAX 500 KB</code>)
                                                    <input  data-max-file-size="500K" required data-allowed-file-extensions="jpg png" name="picture" type="file" class="form-control" id="picture">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="date">Date </label><small class="req">*</small>
                                                    <input  name="date" type="text" value="{{date("d-m-Y")}}" placeholder="01-03-2020" required class="form-control" id="date" autocomplete="false" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="remarks">Remarks </label>
                                                    <input  name="remarks" type="text" placeholder="Remarks"  class="form-control" id="remarks" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Store" name="submit" />
                                                </div>
                                            </div>
                                        </div> <!-- panel-body -->
                                    </div>
                                </div> <!-- panel -->
                            </div>
                        </div> <!-- col -->
                        {!! Form::close() !!}
                    @endisset

                    @isset($edit)
                    {!! Form::open(['url' => 'store','files' => true]) !!}
                        @method("post")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                Product Store
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                            <div id="product_part">
                                                @foreach($product_list as $key=>$p_value)
                                                    <div class="product_append" id="{{++$key}}">
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="product_id">Product</label><small class="req">*</small>
                                                                 <select id="product_id" required name="product_id[]" class="form-control selectpicker" data-live-search="true">
                                                                <option value="">--Select--</option>
                                                                    @if(count($products)>0)
                                                                        @foreach($products as $value)
                                                                            <option {{$value->id==$p_value->product_id?"selected":""}} value="{{$value->id}}">{{$value->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="short_desc">Short Description </label>
                                                                <input disabled  value="{{$p_value->short_desc}}" name="short_desc" placeholder="Short Description" type="text" class="form-control" id="short_desc">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="qty">Qty </label><small class="req">*</small>
                                                            <div class="input-group">
                                                            <input  name="qty[]" type="text" value="{{$p_value->qty}}" required class="form-control" id="qty"  placeholder="Product Qty">
                                                                @if($key==1)
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-info" id="product_add_button" type="button">
                                                                        <i class="md md-add"></i>
                                                                    </button>
                                                                </div>
                                                                @else
                                                                <div class="input-group-btn">
                                                                    <button class="btn btn-danger" id="product_remove_button" type="button">
                                                                        <i class="fa fa-minus"></i>
                                                                    </button>
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="supplier_id">Supplier</label><small class="req">*</small>
                                                     <select id="supplier_id" required name="supplier_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select--</option>
                                                        @if(count($suppliers)>0)
                                                            @foreach($suppliers as $value)
                                                                <option  {{$value->id==$single->supplier_id?"selected":""}}  value="{{$value->id}}">{{$value->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="voucher_no">Voucher No. </label><small class="req">*</small>
                                                    <input  name="voucher_no"  id="voucher_no" value="{{$single->voucher_no}}" type="text" placeholder="Voucher No." required class="form-control">
                                                    <input  name="id" value="{{$single->id}}" type="hidden">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="picture">Voucher Image </label><small class="req">*</small>(<code>JPG PNG MAX 500 KB</code>)
                                                    <input  data-max-file-size="500K" data-default-file="{{asset($single->picture)}}"  data-allowed-file-extensions="jpg png" name="picture" type="file" class="form-control" id="picture">
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="date">Date </label><small class="req">*</small>
                                                    <input  name="date" type="text" value="{{date("d-m-Y",strtotime($single->date))}}" placeholder="01-03-2020" required class="form-control" id="date" autocomplete="false" readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="remarks">Remarks </label>
                                                    <input  name="remarks" type="text" placeholder="Remarks" value="{{$single->remarks}}"  class="form-control" id="remarks" >
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Store" name="submit" />
                                                </div>
                                            </div>
                                        </div> <!-- panel-body -->
                                    </div>
                                </div> <!-- panel -->
                            </div>
                        </div> <!-- col -->
                        {!! Form::close() !!}
                    @endisset
            </div> <!-- End row -->
            <div class="row">
               <div class="col-sm-12">
                    <div class="panel-group panel-group-joined" id="accordion-test">
                        <div class="panel panel-border panel-info">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                        Product Store List
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">

                                    <div class="row">
                                        <div class="col-md-4 m-b-10 pull-right  m-t-22">
                                            <div class="">
                                                <div class="col-md-12 m-b-10 pull-right">
                                                    <div class="input-group">
                                                        <input type="text" name="search_key" placeholder="Search Voucher No" id="search_key" class="form-control">
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-info" id="add_button" type="button">
                                                                <i class="md md-search"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <div id="product_store_loading">
                                                <div class="cv-spinner">
                                                    <span class="spinner"></span>
                                                </div>
                                            </div>
                                            <table id="datatable" class="table table-responsive table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Supplier Name</th>
                                                        <th>Voucher No</th>
                                                        <th>Total Qty</th>
                                                        <th>Date</th>
                                                        <th>Remarks</th>
                                                        <th>Store By</th>
                                                        <th>Details</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div> <!-- panel-body -->

                                </div>
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        </div> <!-- container -->
    </div>

  <div id="con-close-modal" style="z-index: 9999" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <!-- <form id="item_add"> -->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title">Store Details</h4>
                    </div>
                    <div class="modal-body">
                       <div id="show_details">
					   </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
    </div><!-- /.modal -->
<script src="{{asset("admin/vendors")}}/timepicker/bootstrap-datepicker.js"></script>
<script src="{{asset("admin/vendors")}}/notifications/notify.min.js"></script>
<script src="{{asset("admin/vendors")}}/notifications/notify-metro.js"></script>
<script src="{{asset("admin/vendors")}}/notifications/notifications.js"></script>
    <script>
     $(document).ready(function(){
        $('#date').datepicker({
            autoclose: true,
            format: "dd-mm-yyyy",
            immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
        });
         $("#product_part").on("change",'#product_id',function() {
             var id = $(this).closest(".product_append").attr("id");
             var product_id = $(this).val();
             $.ajax({
                 url: "{{route("product_desc")}}",
                 type: "get",
                 dataType: "json",
                 data: {"product_id": product_id},
                 success: function (data) {
                     var short_desc = $("#" + id + " #short_desc");
                     $(short_desc).val(data);
                 }
             });
         });
         $("#datatable").on("click",'.pagination li a',function () {
                var page_url=$(this).attr("href");
                if(page_url=="javascript:void(0)")
                {
                    return false;
                }
                get_view(page_url);
                return false;
            });
         $("#search_key").on("change",function () {
			    get_view(false);
                return false;
            });
         get_view(false);
         function get_view(page_url)
        {
			var filter_by=$("#filter_by").val();
        	var search_key=$("#search_key").val();
        	var base_url="{{route("store/view")}}";
        	if(page_url)
			{
				base_url=page_url;
			}
            $.ajax({
                url:base_url,
                type:"get",
                dataType:"json",
				data:{
                	"search_key":search_key,
					"filter_by":filter_by
				},
                beforeSend: function(){
                		$("#product_store_loading").fadeIn(300);　
                },
                success:function(data){
                   $("#datatable tbody").html(data.html);
                	$("#product_store_loading").fadeOut(300);　
                },
                error:function (e) {
                	$("#product_store_loading").fadeOut(300);
				}
            });
        }

        $("#product_store").on("submit",function(e){
            e.preventDefault();
            var url="{{url("store")}}";
            $.ajax({
                url:url,
                type:"post",
				data: new FormData(this),
				 dataType: 'json',
				 contentType: false,
				 cache: false,
				 processData: false,
				 beforeSend:function(){
                	$("#overlay").fadeIn(300);　
				 },
                success:function(data){
                    if(data.status==true)
                    {
                        $.Notification.autoHideNotify('success', 'top right',"Successfully");

                        $('.dropify-clear').click();
                         $(".product_append_2").remove();
                        $("#qty").val('');
                        $("#voucher_no").val('');
                        $("#remarks").val('');
                        get_view(false);
                    }
                    else{
                          $.Notification.autoHideNotify('error', 'top right',data.message);
                    }
                	$("#overlay").fadeOut(300);　
                },
				error:function (e) {
                    if(e.status==400)
                    {
                     var responseMsg = JSON.parse(e.responseText);
                        $.each( responseMsg, function( key, value) {
                            if(value.hasOwnProperty("voucher_no"))
                                $.Notification.autoHideNotify('error', 'top right',value.voucher_no);
                            if(value.hasOwnProperty("date"))
                                $.Notification.autoHideNotify('error', 'top right',value.date);
                            if(value.hasOwnProperty("picture"))
                                $.Notification.autoHideNotify('error', 'top right',value.picture);
                        });
                    }
                    else{
					    $.Notification.autoHideNotify('error', 'top right',"Something Wrong. Please try again");
                    }
                	$("#overlay").fadeOut(300);　
				}
            });
        });

          $("#datatable").on("click","#details_modal",function () {
			var store_id=$(this).data("id");
			 $.ajax({
                url:"{{url("store/details_view")}}",
                type:"get",
                dataType:"json",
                data:{"store_id":store_id},
				 beforeSend:function(){
                	$("#overlay").fadeIn(300);　
				 },
                success:function(data){
					$("#show_details").html(data.html);
                	$("#overlay").fadeOut(300);
                },
				error:function (e) {
					$.Notification.autoHideNotify('error', 'top right',"Something Wrong. Please try again");
                	$("#overlay").fadeOut(300);
				}
            });
		});

         @isset($edit)
     		var y="{{count($product_list)+1}}";
		  @else
     		var y=2;
		  @endisset
        var maxField = 50; //Input fields increment limitation
        var addButton = $('#product_add_button'); //Add button selector
        var wrapper = $('#product_part'); //Input field wrapper

		 @isset($edit)
        	var x = "{{count($product_list) }}"; //Initial field counter is 1
		 @else
        	var x = 1; //Initial field counter is 1
		   @endisset

        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
               $(wrapper).append(append_data(y++));
                $(".selectpicker").selectpicker("refresh");
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '#product_remove_button', function(e){
            e.preventDefault();
            $(this).closest('.product_append').remove(); //Remove field html
            $(".selectpicker").selectpicker('render').selectpicker('refresh');
            x--; //Decrement field counter
            $(".selectpicker").selectpicker("refresh");
        });

     function  append_data(x){
        var row="";
        row+='<div class="product_append" id="'+x+'">';
            row+='<div class="product_append_2">';
			          row+='<div class="col-sm-4">';
                          row+='<div class="form-group">';
                              row+='<label for="product_id">Product</label><small class="req">*</small>';
                               row+='<select id="product_id" required name="product_id[]" class="form-control selectpicker" data-live-search="true">';
                              row+='<option value="">--Select--</option>';
                                @if(count($products)>0)
                                    @foreach($products as $value)
                                          row+='<option value="{{$value->id}}">{{$value->name}}</option>';
                                    @endforeach
                                @endif
                              row+='</select>';
                          row+='</div>';
                      row+='</div>';
                      row+='<div class="col-sm-4">';
                          row+='<div class="form-group">';
                              row+='<label for="short_desc">Short Description </label>';
                              row+='<input disabled   name="short_desc" placeholder="Short Description" type="text" class="form-control" id="short_desc">';
                          row+='</div>';
                      row+='</div>';
                      row+='<div class="col-sm-4">';
                          row+='<div class="form-group">';
                              row+='<label for="qty">Qty </label><small class="req">*</small>';
                              row+='<div class="input-group">';
                              row+='<input  name="qty[]" type="text" required class="form-control" id="qty"  placeholder="Product Qty">';
                                  row+='<div class="input-group-btn">';
                                      row+='<button class="btn btn-danger" id="product_remove_button" type="button">';
                                          row+='<i class="fa fa-minus"></i>';
                                      row+='</button>';
                                  row+='</div>';
                              row+='</div>';
                          row+='</div>';
                      row+='</div>';
                row+='</div>';
            row+='</div>';
            return row;
     }
     });
</script>
@endsection
