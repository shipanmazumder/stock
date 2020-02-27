<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Session;
class ProductController extends Controller
{
     public function __construct() {
        $this->model=new Product();
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"product");
            Session::put('sub_menu',"product");
            return $next($request);
        });
    }
    public function index()
    {
        checkPermission("product",VIEW);
        $this->data['add']=true;
        $this->data['catgories']=Category::where("status","1")->get();
        $this->data['products']=Product::with("category")->orderBy("id","desc")->paginate(10);
//        dd($this->data['products']->toArray());
        $this->data['sl_counter']=(request()->input("page")==0?1:\request()->input("page")*10);
        return view("admin.product.product",$this->data);
    }

    public function store(Request $request)
    {
         $validator = \Validator::make($request->all(),  [
            'name' => ['required', 'string', 'max:255','unique:products,name,'.$request->input("id")],
        ]);
        if ($validator->fails())
        {
           return redirect('product')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->input("id"))
        {
            $this->model=Product::find($request->input("id"))->first();
        }
        $this->model->category_id=$request->input("category_id");
        $this->model->name=$request->input("name");
        $this->model->short_desc=$request->input("short_desc");
        $this->model->save();
        setMessage("message","success","Successfully Add Product");
        return redirect()->route("product");
    }
    public function edit($id)
    {
        checkPermission("product",EDIT);
        $product=Product::where("id",$id)->first();
        $this->data['catgories']=Category::where("status","1")->get();
        $this->data['single']=$product;
        $this->data['products']=Product::with("category")->orderBy("id","desc")->paginate(10);
        $this->data['sl_counter']=(request()->input("page")==0?1:\request()->input("page")*10);
        $this->data['edit']=true;
         return view("admin.product.product",$this->data);
    }
    public function control($product_id)
    {
        checkPermission("product",DELETE);
        $product=Product::where("id",$product_id)->first();
        if($product->status==0)
        {
            $product->status=1;
        }else{
            $product->status=0;
        }
        $product->save();
        setMessage("message",'success',"Product Update Successfully");
        return redirect()->route("product");
    }
    public function delete($product_id)
    {
        checkPermission("product",DELETE);
        Product::destroy($product_id);
        setMessage("message",'success',"Product Update Successfully");
        return redirect()->route("product");
    }
}
