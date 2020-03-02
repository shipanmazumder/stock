<?php

namespace App\Http\Controllers;

use App\Product;
use App\Store;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Session;
class StoreController extends Controller
{
    public function __construct() {
        $this->model=new Store();
        $this->middleware(function ($request, $next) {
            Session::put('top_menu',"product_store");
            Session::put('sub_menu',"product_store");
            return $next($request);
        });
    }

    public function index()
    {
        checkPermission("product_store",VIEW);
        $this->data['add']=true;
        $this->data['products']=Product::active()->get();
        $this->data['suppliers']=Supplier::active()->get();
        return view("admin.store.store",$this->data);
    }

    public function add(Request $request)
    {
        $product_id=$request->input("product_id");
        if(!$this->is_array_unique($product_id))
        {
            if($request->id)
            {
               setMessage("message","danger","Topic id must be unique");
               return redirect()->route("store");
            }
            $send_data['message']="Topic id must be unique";
            $send_data['status']=false;
            return response()->json($send_data,200);
        }
         $validator = \Validator::make($request->all(),  [
            'voucher_no' => ['required', 'string', 'max:255','unique:stores,voucher_no,'.$request->input("id")],
             'picture' => 'image|mimes:png,jpeg,jpg|max:500',
             'date' => 'required'
        ]);
        if ($validator->fails())
        {
           return response()->json(['errors'=> $validator->getMessageBag()->toArray()],400);
        }
        if($request->id){
            $this->model=Store::find($request->id);
        }
        if($request->hasFile('picture'))
        {
            // dd($request);
            $folder="voucherImage/";
            $pictureinfo=$request->file("picture");

            $picture_name=time().".".$pictureinfo->getClientOriginalExtension();

            $pictureinfo->move($folder,$picture_name);
            $picture_url=$folder.$picture_name;
            if(isset($request->id))
            {
                @\unlink($this->model->picture);
            }
            $this->model->picture=$picture_url;
            // $product_pic->save();
        }
        $this->model->supplier_id=$request->input("supplier_id");
        $this->model->voucher_no=$request->input("voucher_no");
        $this->model->date=date("Y-m-d",strtotime($request->input("date")));
        $this->model->remarks=$request->input("remarks");
        $this->model->store_by=Auth::user()->id;
        $this->model->total_qty=0;
        DB::beginTransaction();
        try {
             $this->model->save();
            $store_list_data=array();
            $total_qty=0;
            foreach ($product_id as $key=>$value)
            {
                $store_list_data[$key]['store_id']=$this->model->id;
                $store_list_data[$key]['product_id']=$value;
                $store_list_data[$key]['qty']=$request->input("qty")[$key];
                $total_qty+=$store_list_data[$key]['qty'];
            }
            $this->model->total_qty=$total_qty;
             $this->model->save();
            DB::table("store_product_lists")
                ->insert($store_list_data);
                DB::commit();
        }
        catch (\Exception $e){
             DB::rollback();
              if(isset($request->id))
                {
                    setMessage("message","danger","Something Wrong!");
                    return redirect()->route("store");
                }
               return response()->json($e,500);
        }
        if(isset($request->id))
        {
           setMessage("message","success","Successfully");
           return redirect()->route("store");
        }
        return response()->json(['message'=>"success","status"=>true],200);
    }
    /**
	 * @param $array
	 * @return bool
	 */
    function is_array_unique($array) {
    	return count($array) === count(array_unique($array));
    }
    public function product_desc()
    {
        if($_GET)
        {
            $product_id=\request()->input("product_id");
            if($product_id=='')
            {
                return response()->json("",200);
            }
            $desc=Product::find($product_id)->short_desc;
            return response()->json($desc,200);
        }
    }

    public function view()
    {
        $this->data['stores']=Store::with("user")->with("supplier")->orderBy("id","desc")->paginate(10);
        $returnHTML = view('admin.store.store-data')->with($this->data)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
