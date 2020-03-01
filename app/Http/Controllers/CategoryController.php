<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Session;

class CategoryController extends Controller
{
    public function __construct() {
        $this->model=new Category;
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"category");
            Session::put('sub_menu',"category");
            return $next($request);
        });
    }
    public function index()
    {
        checkPermission("category",VIEW);
        $this->data['add']=true;
        $this->data['catgories']=Category::paginate(10);
        $this->data['sl_counter']=(request()->input("page")==0?1:\request()->input("page")*10);
//        dd($this->data['sl_counter']);
        return view("admin.category.category",$this->data);
    }

    public function store(Request $request)
    {
        checkPermission("category",ADD);
         $validator = \Validator::make($request->all(),  [
            'name' => ['required', 'string', 'max:255','unique:categories,name,'.$request->input("id")],
        ]);
        if ($validator->fails())
        {
           return redirect('category')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->input("id"))
        {
            $this->model=Category::find($request->input("id"))->first();
        }
        $this->model->name=$request->input("name");
        $this->model->save();
        setMessage("message","success","Successfully");
        return redirect()->route("category");
    }

    public function edit($id)
    {
        checkPermission("category",EDIT);
        $category=Category::where("id",$id)->first();
        $this->data['catgories']=Category::paginate(10);
        $this->data['single']=$category;
        $this->data['sl_counter']=(\request()->input("page")==0?1:\request()->input("page"))*10;
        $this->data['edit']=true;
         return view("admin.category.category",$this->data);
    }
    public function control($category_id)
    {
        checkPermission("category",DELETE);
        $category=Category::where("id",$category_id)->first();
        if($category->status==0)
        {
            $category->status=1;
        }else{
            $category->status=0;
        }
        $category->save();
        setMessage("message",'success',"Product Update Successfully");
        return redirect()->route("category");
    }
    public function delete($category_id)
    {
        checkPermission("category",DELETE);
        Category::destroy($category_id);
        setMessage("message",'success',"Category Update Successfully");
        return redirect()->route("category");
    }
}
