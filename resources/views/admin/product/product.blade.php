@extends('admin.layout.default')
@section('title_area')
    Product
@endsection
@section('main_section')
    <div class="content">
        @if(Session::has('message'))
            <div class="alert alert-{{Session::get("class")}}">{{Session::get("message")}}</div>
        @endif
        <div class="container">
            <div class="row">
                    @isset($add)
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
                                                                <option value="<?php echo $value->id; ?>"><?php echo $value['name']; ?></option>
                                                            <?php endforeach;?>
                                                        <?php endif;?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="name">Product</label><small class="req">*</small>
                                                    <input required   name="name" placeholder="Product Name" type="text" value="{{old("name")}}" class="form-control" id="product">
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
                                                    <input    name="short_desc" placeholder="Short Description (Optional)" value="{{old("short_desc")}}" type="text"  class="form-control" id="short_desc">
                                                    @error('short_desc')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group pull-left">
                                                    <input type="submit" class=" btn btn-primary pull-right" value="Save" name="submit" />
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
                                                @isset($products)
                                                    @foreach($products as $key=>$value)
                                                        <tr>
                                                            <td>{{$sl_counter++}}</td>
                                                            <td>{{$value->category->name}}</td>
                                                            <td>{{$value->name}}</td>
                                                            <td>{{$value->short_desc}}</td>
                                                            <td>
                                                                @if(hasPermission("product",EDIT))
                                                                <a title="Edit" href="{{url("product/edit/".$value->id)}}" class=" btn btn-default btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View"><i class="fa fa-edit"></i></a>
                                                                @endif
                                                                @if(hasPermission("product",DELETE))
                                                                <a onclick="return confirm('Are You Sure?')" href="{{url("product-control/".$value->id)}}" title="{{$value->status==1?"Enable":"Disable"}}" class="text-{{$value->status==1?"info":"danger"}} btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-check-circle"></i></a>
                                                                @endif
                                                                @if(is_super_admin())
                                                                <a onclick="return confirm('Are You Sure?')" href="{{url("product/delete/".$value->id)}}"  class="text-danger btn btn-default  btn-xs  waves-effect tooltips" data-placement="top" data-toggle="tooltip" data-original-title="View" id=""><i class="fa fa-trash"></i></a>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endisset
                                                <tr>
                                                    <td colspan="4" class="text-center">{{$products->links()}}</td>
                                                </tr>
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
@endsection
