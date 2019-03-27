<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 20:03
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class GoodsController extends Controller
{
    public function list()
    {
        return view('goods/goods_list');
    }
    public function add(Request $request)
    {
        $b_data = DB::select("select * from brand");
        $c_data = DB::select("select * from type");

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
                DB::table('goods')->insert(['goods_img'=>$goods_img,'goods_name'=>$goods_name,'goods_sn'=>$goods_sn,'cat_id'=>$cat_id,'brand_id'=>$brand_id,'suppliers_id'=>$suppliers_id,'shop_price'=>$shop_price,'user_price'=>$user_price,'market_price'=>$market_price,'promote_price'=>$promote_price,'promote_start_date'=>$promote_start_date,'promote_end_date'=>$promote_end_date]);
            }
        }

        return view('goods/goods_add',['b_data'=>$b_data,'c_data'=>$c_data]);
    }
}