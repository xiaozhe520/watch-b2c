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


<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
    序号：{{ $data->goods_id }}<br>
    商品所属商品分类：{{ $data->cat_name }}<br>
    货号：{{ $data->goods_sn  }}<br>
    商品的名称 ：{{ $data->goods_name }}<br>
    商品点击数：{{ $data->click_count}}<br>
    商品品牌：{{ $data->brand_name}}<br>
    商品库存数量 ：{{ $data->goods_number }}<br>
    商品的重量：{{ $data->goods_weight }}<br>
    市场售价：{{ $data->market_price }}<br>
    本店售价 ：{{ $data->shop_price }}<br>
    促销价：{{ $data->promote_price }}<br>
    促销开始时间：{{ $data->promote_start_date }}<br>
    促销结束时间：{{ $data->promote_end_date }}<br>
    商品报警数量 ：{{ $data->warn_number }}<br>
    商品的简短描述：{{ $data->goods_brief }}<br>
    微缩图片：<img src="{{ $data->goods_thumb }}" alt=""><br>
    商品图片：<img src="{{ $data->goods_img }}" alt=""><br>
    销售：{{ $data->is_on_sale}}<br>
    商品的添加时间：{{ $data->add_time}}<br>
    是否已经删除：{{ $data->is_delete}}<br>
    是否是精品：{{ $data->is_best }}<br>
    是否是新品：{{ $data->is_new }}<br>
    是否热销：{{ $data->is_hot }}<br>
</form>

<div id="footer">
    版权所有 &copy; 2006-2013 软工教育 - 高级PHP -
</div>

</body>
</html>

<script>

</script>