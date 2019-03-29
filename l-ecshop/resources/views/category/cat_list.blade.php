<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 商品分类 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="{{ URL::asset('styles/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('styles/main.css') }}" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span"><a href="{{ URL('category/add') }}">添加分类</a></span>
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 商品分类 </span>
<div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
<!-- start ad position list -->
	<div class="list-div" id="listDiv">
		<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
			<tbody>
				<tr>
					<th>分类名称</th>
					<th>商品数量</th>
					<th>数量单位</th>
					<th>导航栏</th>
					<th>是否显示</th>
					<th>价格分级</th>
					<th>排序</th>
					<th>操作</th>
				</tr>
				<tr align="center" class="0" id="0_1">
					<td align="left" class="first-cell">
						<img src="images/menu_minus.gif" id="icon_0_1" width="9" height="9" border="0" style="margin-left:0em" onclick="rowClicked(this)">
						<span><a href="goods.php?act=list&amp;cat_id=1">手机类型</a></span>
					 </td>
					<td width="10%">0</td>
					<td width="10%"><span onclick="listTable.edit(this, 'edit_measure_unit', 1)" title="点击修改内容" style=""></span></td>
					<td width="10%"><img src="images/no.gif" onclick="listTable.toggle(this, 'toggle_show_in_nav', 1)"></td>
					<td width="10%"><img src="images/yes.gif" onclick="listTable.toggle(this, 'toggle_is_show', 1)"></td>
					<td><span onclick="listTable.edit(this, 'edit_grade', 1)" title="点击修改内容" style="">5</span></td>
					<td width="10%" align="right"><span onclick="listTable.edit(this, 'edit_sort_order', 1)" title="点击修改内容" style="">50</span></td>
					<td width="24%" align="center">
						<a href="category.php?act=move&amp;cat_id=1">转移商品</a> |
						<a href="category.php?act=edit&amp;cat_id=1">编辑</a> |
						<a href="javascript:;" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" title="移除">移除</a>
					</td>
				</tr>
	<!--  start 这些代码是显示使用，没有格式化 开发时可删除-->
	@foreach($data as $query =>$val)
    <tr align="center" class="1" id="1_5">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img src="images/menu_minus.gif" id="icon_1_5" width="9" height="9" border="0" style="margin-left:1em" onclick="rowClicked(this)">
            <span><a href="goods.php?act=list&amp;cat_id=5"><?php echo $val->cat_name; ?></a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><?php echo $val->parent_id; ?><?php echo $val->parent_id; ?></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 5)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $val->cat_recommend; ?></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img src="images/no.gif" onclick="listTable.toggle(this, 'toggle_show_in_nav', 5)"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img src="images/yes.gif" onclick="listTable.toggle(this, 'toggle_is_show', 5)"><?php echo $val->is_show; ?></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 5)"><?php echo $val->measure_unit; ?></span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 5)"><?php echo $val->sort_order; ?></span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&amp;cat_id=5">转移商品</a> |
      <a href="upd?cat_id=<?php echo $val->cat_id; ?>">编辑</a> |
      <a href="del?cat_id=<?php echo $val->cat_id; ?>" onclick="listTable.remove(5, '您确认要删除这条记录吗?')" title="移除">移除</a>
    </td>
  </tr>
 @endforeach
  	<!--  end这些代码是显示使用，没有格式化 开发时可删除-->
	</tbody>
  </table>
</div>
</form>

  </table>
</div>
</form>


<div id="footer">
	版权所有 &copy; 2006-2013 软工教育 - 高级PHP - </div>
</div>

</body>
</html>