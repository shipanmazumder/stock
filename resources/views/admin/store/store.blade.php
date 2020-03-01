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
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="picture">Voucher No. </label><small class="req">*</small>
                                                    <input  name="voucher_no" type="text" placeholder="Voucher No." required class="form-control">
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
                    {!! Form::open(['url' => 'product']) !!}
                    @method("POST")
                        <div class="col-sm-12">
                            <div class="panel-group panel-group-joined" id="accordion-test">
                                <div class="panel panel-border panel-info">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion-test" href="#collapseOne" class="collapsed">
                                                Product
                                            </a>
                                        </h3>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                             <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="category_id">Category</label><small class="req">*</small>
                                                     <select id="category_id" required name="category_id" class="form-control selectpicker" data-live-search="true">
                                                    <option value="">--Select--</option>
                                                        <?php if(count($catgories)>0): ?>
                                                            <?php foreach($catgories as $value):?>
                                                                <option {{$value->id==$single->category_id?"selected":""}} value="<?php echo $value->id; ?>"><?php echo $value['name']; ?></option>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="product">Product</label><small class="req">*</small>
                                                    <input required   name="name" value="{{$single->name}}" placeholder="Product Name" type="text"  class="form-control" id="product">
                                                    <input required   name="id" value="{{$single->id}}" type="hidden">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="short_desc">Short Description</label>
                                                    <input    name="short_desc"  value="{{$single->short_desc}}" placeholder="Short Description (Optional)" type="text"  class="form-control" id="short_desc">
                                                    @error('short_desc')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group pull-left m-t-22">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Update" name="submit" />
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
                                        Product List
                                    </a>
                                </h3>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Sl</th>
                                                    <th>Category Name</th>
                                                    <th>Name</th>
                                                    <th>Short Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- panel-body -->
                            </div>
                        </div> <!-- panel -->
                    </div>
                </div> <!-- col -->
            </div>
        </div> <!-- container -->
    </div>

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
                        $("input[type=text]").val('');

                        $('.dropify-clear').click();
                         $(".product_append").remove();
                    }
                    else{
                        alert(data.message);
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

         @isset($edit)
     		var y="{{count($product_store)+1}}";
		  @else
     		var y=2;
		  @endisset
        var maxField = 4; //Input fields increment limitation
        var addButton = $('#product_add_button'); //Add button selector
        var wrapper = $('#product_part'); //Input field wrapper

		 @isset($edit)
        	var x = "{{count($product_store) }}"; //Initial field counter is 1
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
