<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/27
 * Time: 10:44
 */

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function list()
    {
          header("content-type:text/html;charset=utf8");
          $data = DB::table('category')->get();
        return view('category/cat_list',['data'=>$data]);
        


    }
    public function add()
    {
        return view('category/cat_add');
    }

    public function add_do(){

    	$cat_name = $_POST['cat_name'];
    	$parent_id = $_POST['parent_id'];
    	$measure_unit = $_POST['measure_unit'];
    	$sort_order = $_POST['sort_order'];
    	$cat_recommend = $_POST['cat_recommend'];
    	$is_show = $_POST['is_show'];
    	$cat_desc = $_POST['cat_desc'];

    	
    	$res = DB::table('category')->insert(['cat_name'=>$cat_name,'parent_id'=>$parent_id,'measure_unit'=>$measure_unit,'sort_order'=>$sort_order,'is_show'=>$is_show,'cat_recommend'=>$cat_recommend,'cat_desc'=>$cat_desc]);
         // var_dump($res);die();
         if ($res) {
         	return redirect('category/list');
         }




    }
    public function del(){
      $cat_id = $_GET['cat_id'];
      $res = DB::table('category')->where('cat_id',$cat_id)->delete();
      if ($res) {
        return redirect('category/list');
      }
    }

    
}