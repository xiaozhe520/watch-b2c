<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title></title>
	<link href="{{ URL::asset('styles/general.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ URL::asset('styles/main.css') }}" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="/css/fen.css">
</head>
<body>
<h1>
	<span class="action-span"><a href="{{ URL('goods/add') }}">添加新商品</a></span>
	<span class="action-span1"><a href="{{ URL('index/main') }}">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
	<div style="clear:both"></div>
</h1>

<div class="form-div">
  <form action="list" method="post">
	  @csrf
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
        <!-- 分类 -->
    <select name="cat_id">
		<option value="">所有分类</option>
		@foreach($category as $category1)
			<option value="{{ $category1->cat_id }}">{{ $category1->cat_name }}</option>
		@endforeach
	</select>
    <!-- 品牌 -->
    <select name="brand_id">
		<option value="">所有品牌</option>
         @foreach($brand as $brands)
			<option value="{{ $brands->brand_id }}">{{ $brands->brand_name }}</option>
		@endforeach
	</select>
         
     <!-- 供货商 -->
     <select name="suppliers_id">
		<option value="">全部</option>
		<option value="1">北京供货商</option>
		<option value="2">上海供货商</option>
	</select>
    <!-- 上架 -->
     <select name="is_on_sale">
		<option value="">全部</option>
		<option value="1">上架</option>
		<option value="0">下架</option>
	</select>
	<!-- 关键字 -->
		商品名称 <input type="text" name="goods_name" size="15">
		<input type="submit" value=" 搜索 ">
  </form>
</div>

<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
  <!-- start goods list -->
	<div class="list-div" id="listDiv">
		<table cellpadding="3" cellspacing="1">
			<tbody>
				<tr>
					<th><input type="checkbox">编号</th>
					<th>商品名称</th>
					<th>货号</th>
					<th>价格</th>
					<th>上架</th>
					<th>精品</th>
					<th>新品</th>
					<th>热销</th>
					<th>推荐排序</th>
					<th>库存</th>
					<th>操作</th>
				</tr>
				<tr></tr>
				@foreach($goods as $good)
				<tr>
					<td><input type="checkbox" name="checkboxes[]" value="{{ $good->goods_id }}">{{ $good->goods_id }}</td>
					<td class="first-cell"><span>{{$good->goods_name}}</span></td>
					<td><span>{{$good->goods_sn}}</span></td>
					<td align="right"><span>{{$good->shop_price}}</span></td>
					<td align="center">
						@if($good->is_delete == 1)
						<img src="images/yes.gif" onclick="">
						@else
						<img src="images/no.gif" onclick="">
						@endif
					</td>
					<td align="center">
						@if($good->is_best == 1)
							<img src="images/yes.gif" onclick="">
						@else
							<img src="images/no.gif" onclick="">
						@endif
					</td>
					<td align="center">
						@if($good->is_new == 1)
							<img src="images/yes.gif" onclick="">
						@else
							<img src="images/no.gif" onclick="">
						@endif
					</td>
					<td align="center">
						@if($good->is_hot  == 1)
							<img src="images/yes.gif" onclick="">
						@else
							<img src="images/no.gif" onclick="">
						@endif
					</td>
					<td align="center"><span onclick="">{{$good->sort_order}}</span></td>
					<td align="right"><span onclick="">{{$good->goods_number}}</span></td>
					<td align="center">
						<a href="{{ url('goods/goods_xiang',['id'=>$good->goods_id]) }}" target="_blank" title="查看"><img src="images/icon_view.gif" width="16" height="16" border="0"></a>
						<a href={{ url('goods/goods_xiu',['id'=>$good->goods_id]) }}" title="编辑"><img src="images/icon_edit.gif" width="16" height="16" border="0"></a>
						<a href="{{url('goods/goods_hui',['id'=>$good->goods_id])}}" onclick="confirm('您确实要把该商品放入回收站吗？')" title="回收站"><img src="images/icon_trash.gif" width="16" height="16" border="0"></a>
					</td>
				</tr>
				@endforeach
  </tbody>
 </table>
<!-- end goods list -->

	<!-- 分页 -->
		<div id="pull_right">
			<div class="pull-right">
							{{ $goods->links('common.page') }}
			</div>
		</div>
</div>

<div>
	<input type="hidden" name="act" value="batch">
	<select name="type" id="selAction" onchange="changeAction()">
		<option value="">请选择...</option>
		<option value="trash">回收站</option>
		<option value="on_sale">上架</option>
		<option value="not_on_sale">下架</option>
		<option value="best">精品</option>
		<option value="not_best">取消精品</option>
		<option value="new">新品</option>
		<option value="not_new">取消新品</option>
		<option value="hot">热销</option>
		<option value="not_hot">取消热销</option>
		<option value="move_to">转移到分类</option>
		<option value="suppliers_move_to">转移到供货商</option>
	</select>

    <input type="hidden" name="extension_code" value="">
    <input type="submit" value=" 确定 " id="btnSubmit" name="btnSubmit" class="button" disabled="true">
</div>
</form>

<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - 
</div>

</body>
</html>
