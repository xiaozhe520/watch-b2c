<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 20:03
 */

namespace App\Http\Controllers\Admin;


use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GoodsController extends Controller
{
    public function list(Request $request)
    {
        //商品品牌
        $brand = Db::table('brand')->select('brand_id','brand_name')->get();
        //商品分类
        $category   = Db::table('category')->select('cat_id','cat_name')->get();
        //供货商
        //商品
        $table = Db::table('goods');
        if ($request->isMethod('post')){
            $res = $request->all();
            $res = array_filter($res);
            unset($res['_token']);
//            dd($res);
            foreach ($res as $key=>$val ){
                $table->where($key,'like','%'.$val.'%');
            }
        }
        $goods = $table->where('is_delete','=',0)->paginate(3);
//        dd($goods);
        return view('goods/goods_list',['brand'=>$brand,'goods'=>$goods,'category'=>$category]);
    }
     //增加
    public function add(Request $request)
    {
        $b_data = DB::select("select brand_id,brand_name from brand");

        $c_data = DB::select("select * from category");

        $goods_name = Input::get('goods_name');
        $goods_sn = "zzq".time()."+".rand(1,100);
        $cat_id = Input::get('cat_id');
        $brand_id = Input::get('brand_id');
        $suppliers_id = Input::get('suppliers_id');
        $shop_price = Input::get('shop_price');
        $user_price = Input::get('user_price');
        $market_price = Input::get('market_price');
        $promote_price = Input::get('promote_price');
        $promote_start_date = Input::get('promote_start_date');
        $promote_end_date = Input::get('promote_end_date');
//        $goods_img = Input::get('goods_img');
        //判断是否是POST传值
        if($request->isMethod('POST')){
            //接图片信息
            $file = $request->file('goods_img');
//            dd($file);    dd 等同于 var_dump  都是打印的一种方式

            //判断是否有值
            if($file->isValid()){

                //图片原名称
                $yuan = $file->getClientOriginalName();

                //图片拓展名
                $tuo = $file->getClientOriginalExtension();

                //图片MineType 类型
                $type = $file->getClientMimeType();

                //图片路径
                $path = $file->getRealPath();

                //文件名
                $fileName = time();
//                echo $path;die;

                //这句话返还的是bool型
                Storage::disk('upload')->put($fileName,file_get_contents($path));
                $goods_img = '/app/uploads/'.$fileName;
//                DB::table('goods')->insert([]);

                $goods_weight = Input::get('goods_weight');
                $warn_number = Input::get('warn_number');
                $is_best = Input::get('is_best');
                $is_on_sale = Input::get('is_on_sale');
                $is_alone_sale = Input::get('is_alone_sale');
                $is_shipping = Input::get('.');
                $keywords = Input::get('keywords');
                $goods_brief = Input::get('goods_brief');
                $seller_note = Input::get('seller_note');
                $goods_number = Input::get('goods_number');

                $goods_type = Input::get('goods_type');
                $attr_value_list = Input::get('attr_value_list[]');


                DB::table('goods')->insert(['goods_weight'=>$goods_weight,'warn_number'=>$warn_number,'is_best'=>$is_best,'is_on_sale'=>$is_on_sale,'is_alone_sale'=>$is_alone_sale,'is_shipping'=>$is_shipping,'keywords'=>$keywords,'goods_brief'=>$goods_brief,'seller_note'=>$seller_note,'goods_number'=>$goods_number,'goods_img'=>$goods_img,'goods_name'=>$goods_name,'goods_sn'=>$goods_sn,'cat_id'=>$cat_id,'brand_id'=>$brand_id,'suppliers_id'=>$suppliers_id,'shop_price'=>$shop_price,'user_price'=>$user_price,'market_price'=>$market_price,'promote_price'=>$promote_price,'promote_start_date'=>$promote_start_date,'promote_end_date'=>$promote_end_date,'goods_type'=>$goods_type,'attr_value_list'=>$attr_value_list]);

            }
        }


        return view('goods/goods_add',['b_data'=>$b_data,'c_data'=>$c_data]);
    }

    //详情页面
    public function goods_xiang($id)
    {
//       dd($id);
       $data = DB::table('goods')->leftJoin('brand','brand.brand_id','goods.brand_id')->leftJoin('category','category.cat_id','goods.cat_id')->where('goods_id','=',$id)->first();
//        dd($data);
       return view('goods/goods_xiang',['data'=>$data]);
    }

    //修该页面
    public function xiu(Request $request,$id)
    {
      if ($request->isMethod('post')){
         $data = $request->all();
         $id = $data['goods_id'];
         unset($data['_token']);
         unset($data['goods_id']);
         $res = Db::table('goods')->where('goods_id','=',$id)->update($data);
         if ($res){
            return redirect('goods/list');
         }
      }
      $data = Db::table('goods')->where('goods_id','=',$id)->first();
      $c_data =Db::table('category')->get();
      $b_data =Db::table('brand')->get();
      return view('goods/goods_xiu',['data'=>$data,'c_data'=>$c_data,'b_data'=>$b_data]);
    }

    //进入回收站
    public function hui($id)
    {
        $res = Db::table('goods')->where('goods_id','=',$id)->update(['is_delete'=>1]);
        if ($res){
            return redirect('goods/list');
        }

    }

}
