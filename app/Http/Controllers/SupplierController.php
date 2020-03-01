<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;
use Session;
class SupplierController extends Controller
{
     public function __construct() {
        $this->model=new Supplier();
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"supplier");
            Session::put('sub_menu',"supplier");
            return $next($request);
        });
    }
    public function index()
    {
        checkPermission("supplier",VIEW);
        $this->data['add']=true;
        $this->data['suppliers']=Supplier::paginate(10);
        $this->data['sl_counter']=(request()->input("page")==0?1:\request()->input("page")*10);
//        dd($this->data['sl_counter']);
        return view("admin.supplier.supplier",$this->data);
    }
    public function store(Request $request)
    {
        checkPermission("supplier",ADD);
        $validator = \Validator::make($request->all(),  [
            'name' => ['required', 'string', 'max:255','unique:suppliers,name,'.$request->input("id")],
        ]);
        if ($validator->fails())
        {
           return redirect('supplier')
                        ->withErrors($validator)
                        ->withInput();
        }
        if($request->input("id"))
        {
            $this->model=Supplier::find($request->input("id"))->first();
        }
        $this->model->name=$request->input("name");
        $this->model->phone=$request->input("phone");
        $this->model->address=$request->input("address");
        $this->model->save();
        setMessage("message","success","Successfully");
        return redirect()->route("supplier");
    }

    public function edit($id)
    {
        checkPermission("supplier",EDIT);
        $supplier=Supplier::where("id",$id)->first();
        $this->data['suppliers']=Supplier::paginate(10);
        $this->data['single']=$supplier;
        $this->data['sl_counter']=(\request()->input("page")==0?1:\request()->input("page"))*10;
        $this->data['edit']=true;
         return view("admin.supplier.supplier",$this->data);
    }
    public function control($supplier_id)
    {
        checkPermission("supplier",DELETE);
        $supplier=Supplier::where("id",$supplier_id)->first();
        if($supplier->status==0)
        {
            $supplier->status=1;
        }else{
            $supplier->status=0;
        }
        $supplier->save();
        setMessage("message",'success',"Successfully");
        return redirect()->route("supplier");
    }
    public function delete($supplier_id)
    {
        checkPermission("supplier",DELETE);
        Supplier::destroy($supplier_id);
        setMessage("message",'success',"Successfully");
        return redirect()->route("supplier");
    }
}
