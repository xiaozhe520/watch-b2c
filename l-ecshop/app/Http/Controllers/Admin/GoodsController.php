<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26
 * Time: 20:03
 */

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;

class GoodsController extends Controller
{
    public function list()
    {
        return view('goods/goods_list');
    }
    public function add()
    {
    	$data = DB::table('cat')->where('cat_name',"cat");
        return view('goods/goods_add',['data'=>$data]);
    }

}