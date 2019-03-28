<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 20:03
 */

namespace App\Http\Controllers\Admin;

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
    public function add()
    {
        return view('goods/goods_add');
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