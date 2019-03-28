<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    <link href="{{ URL::asset('styles/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('styles/main.css') }}" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{ URL::asset('js/utils.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/selectzone.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/colorselector.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/calendar.php?lang=') }}"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="{{ URL('goods/list') }}">商品列表</a></span>
    <span class="action-span1"><a href="{{ URL('index/main') }}">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 修改商品信息 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">

    <!-- tab body -->
    <div id="tabbody-div">
        <form  action="xiu" method="post">
            @csrf
            <input type="hidden" name="goods_id" value="{{$data->goods_id}}">
            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="{{ $data->goods_name }}" ><span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td><input type="text" name="goods_sn" value="{{ $data->goods_sn }}" size="20" ><span id="goods_sn_notice"></span><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id" onchange="hideCatDiv()">
                            @foreach($c_data as $val)
                            @if($val->parent_id == 0)
                                <option value="{{$val->cat_id}}">{{$val->cat_name}}</option>
                            @else
                                <option value="{{$val->cat_id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$val->cat_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id" onchange="hideBrandDiv()">
                            @foreach($b_data as $v)
                                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">选择供货商：</td>
                    <td>
                        <select name="suppliers_id" id="suppliers_id">
                            <option value="">不指定供货商属于本店商品</option>
                            <option value="1">北京供货商</option>
                            <option value="2">上海供货商</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td><input type="text" name="shop_price" value="{{$data->shop_price}}" size="20" onblur="priceSetted()">
                        <input type="button" value="按市场价计算" onclick="marketPriceSetted()">
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">会员价格：</td>
                    <td><input type="text" name="user_price" value="{{ $data->user_price }}" size="20" onblur="priceSetted()"></td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td><input type="text" name="market_price" value="{{ $data->market_price }}" size="20">
                        <input type="button" value="取整数" onclick="integral_market_price()">
                    </td>
                </tr>

                <tr>
                    <td class="label"><label for="is_promote"><input type="checkbox" id="is_promote" name="is_promote" value="{{ $data->is_promote }}" checked="checked" onclick="handlePromote(this.checked);"> 促销价：</label></td>
                    <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="{{ $data->promote_price }}" size="20"></td>
                </tr>
                <tr id="promote_4">
                    <td class="label" id="promote_5">促销日期：</td>
                    <td id="promote_6">
                        <input name="promote_start_date" type="date"   value="{{ $data->promote_start_date }}" >- <input name="promote_end_date" type="date"  value="{{ $data->promote_end_date }}" >
                    </td>
                </tr>
                </tbody></table>
            <div class="button-div">
                <input type="submit" value=" 确定 ">
                <input type="reset" value=" 重置 " class="button">
            </div>
        </form>
    </div>
</div>

<div id="footer">
    版权所有 &copy; 2006-2013
</div>
<script type="text/javascript" src="js/tab.js"></script>
</body>
</html>