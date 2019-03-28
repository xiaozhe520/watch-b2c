<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />

    <title></title>
    <link href="{{ URL::asset('styles/general.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('styles/main.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/selectzone.js"></script>
    <script type="text/javascript" src="js/colorselector.js"></script>
    <script type="text/javascript" src="js/calendar.php?lang="></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="GoodsController.php?act=list">商品列表</a></span>
    <span class="action-span1"><a href="index.php?act=main">SHOP 管理中心 </a> </span><span id="search_id" class="action-span1"> - 编辑商品信息 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="mix-tab">其他信息</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab">商品相册</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="add" method="post" name="theForm" id="form_uploadImg">
            <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
            @csrf
            <!-- 通用信息 -->
            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="" size="30"><span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td><input type="text" name="goods_sn" value="" size="20" onblur="checkGoodsSn(this.value,'32')"><span id="goods_sn_notice"></span><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id" onchange="hideCatDiv()">
                            <?php foreach ($c_data as $v){ ?>
                                @if($v->parent_id==0)
                                    <option value="{{$v->cat_id}}">{{$v->cat_name}}</option>
                                    @else
                                    <option value="{{$v->cat_id}}">&nbsp;&nbsp;&nbsp;&nbsp;{{$v->cat_name}}</option>
                                 @endif
                            <?php } ?>
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
                            <option value="0">不指定供货商属于本店商品</option>
                            <option value="1">北京供货商</option>
                            <option value="2">上海供货商</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td><input type="text" name="shop_price" value="3010.00" size="20" onblur="priceSetted()">
                        <span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">会员价格：</td>
                    <td><input type="text" name="user_price" value="3010.00" size="20" onblur="priceSetted()"></td>
                </tr>

                <tr>
                    <td class="label">市场售价：</td>
                    <td><input type="text" name="market_price" value="3612.00" size="20">
                    </td>
                </tr>

                <tr>
                    <td class="label"><label for="is_promote"><input type="checkbox" id="is_promote" name="is_promote" value="1" checked="checked" onclick="handlePromote(this.checked);"> 促销价：</label></td>
                    <td id="promote_3"><input type="text" id="promote_1" name="promote_price" value="2750.00" size="20"></td>
                </tr>
                <tr id="promote_4">
                    <td class="label" id="promote_5">促销日期：</td>
                    <td id="promote_6">
                        <input type="date" name="promote_start_date">-<input type="date" name="promote_end_date">
                    </td>
                </tr>
                <tr>
                    <td class="label">上传商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35">
                        <a href="goods.php?act=show_image&amp;img_url=images/200905/goods_img/32_G_1242110760868.jpg" target="_blank"><img src="images/yes.gif" border="0"></a>
                        <br><input type="text" size="40" value="商品图片外部URL" style="color:#aaa;" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" name="goods_img_url">
                    </td>
                </tr>
                </tbody></table>

            <!-- 其他信息 -->
            <table width="90%" id="mix-table" style="display: none;" align="center">
                <tbody><tr>
                    <td class="label">商品重量：</td>
                    <td><input type="text" name="goods_weight" value="" size="20"> <select name="weight_unit"><option value="1">千克</option><option value="0.001" selected="">克</option></select></td>
                </tr>
                <tr>
                    <td class="label"><a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>
                    <!--            <td><input type="text" name="goods_number" value="4" size="20" readonly="readonly" /><br />-->
                    <td><input type="text" name="goods_number" value="4" size="20"><br>
                        <span class="notice-span" style="display:block" id="noticeStorage">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span></td>
                </tr>
                <tr>
                    <td class="label">库存警告数量：</td>
                    <td><input type="text" name="warn_number" value="1" size="20"></td>
                </tr>
                <tr>
                    <td class="label">加入推荐：</td>
                    <td><input type="checkbox" name="is_best" value="1" checked="checked">精品 <input type="checkbox" name="is_new" value="1" checked="checked">新品 <input type="checkbox" name="is_hot" value="1" checked="checked">热销</td>
                </tr>
                <tr id="alone_sale_1">
                    <td class="label" id="alone_sale_2">上架：</td>
                    <td id="alone_sale_3"><input type="checkbox" name="is_on_sale" value="1" checked="checked"> 打勾表示允许销售，否则不允许销售。</td>
                </tr>
                <tr>
                    <td class="label">能作为普通商品销售：</td>
                    <td><input type="checkbox" name="is_alone_sale" value="1" checked="checked"> 打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。</td>
                </tr>
                <tr>
                    <td class="label">是否为免运费商品</td>
                    <td><input type="checkbox" name="is_shipping" value="1"> 打勾表示此商品不会产生运费花销，否则按照正常运费计算。</td>
                </tr>
                <tr>
                    <td class="label">商品关键词：</td>
                    <td><input type="text" name="keywords" value="2008年10月 GSM,850,900,1800,1900 黑色" size="40"> 用空格分隔</td>
                </tr>
                <tr>
                    <td class="label">商品简单描述：</td>
                    <td><textarea name="goods_brief" cols="40" rows="3"></textarea></td>
                </tr>
                <tr>
                    <td class="label">
                        <a href="javascript:showNotice('noticeSellerNote');" title="点击此处查看提示信息"><img src="images/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商家备注： </td>
                    <td><textarea name="seller_note" cols="40" rows="3"></textarea><br>
                        <span class="notice-span" style="display:block" id="noticeSellerNote">仅供商家自己看的信息</span></td>
                </tr>
                </tbody></table>

            <!-- 商品属性 -->
            <table width="90%" id="properties-table" style="display: none;" align="center">
                <tbody>
                <tr>
                    <td class="label">商品类型：</td>
                    <td>
                        <select name="goods_type" onchange="getAttrList(32)">
                            <option value="0">请选择商品类型</option>
                        </select><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
                    </td>
                </tr>
                <tr>
                    <td id="tbody-goodsAttr" colspan="2" style="padding:0">
                        <table width="100%" id="attrTable">
                            <tbody>
                            <tr>
                                <td class="label">上市日期</td>
                                <td>
                                    <input type="hidden" name="attr_id_list[]" value="172">
                                    <input type="date" name="attr_value_list[]">
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">尺寸体积</td>
                                <td><input type="hidden" name="attr_id_list[]" value="184">
                                    <input name="attr_value_list[]" type="text" value="" size="40">
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">颜色</td>
                                <td>
                                    <input type="hidden" name="attr_id_list[]" value="186">
                                    <select name="attr_value_list[]">
                                        <option value="">请选择...</option>
                                        <option value="1600万">1600万</option>
                                        <option value="262144万">262144万</option>
                                    </select>
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">材质</td>
                                <td>
                                    <input type="hidden" name="attr_id_list[]" value="187">
                                    <select name="attr_value_list[]">
                                        <option value="">请选择...</option>
                                        <option value="TFT">TFT</option>
                                    </select>
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">网络链接</td>
                                <td>
                                    <input type="hidden" name="attr_id_list[]" value="192">
                                    <input name="attr_value_list[]" type="text" value="" size="40">
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>

                            <tr>
                                <td class="label">手表制式</td><td><input type="hidden" name="attr_id_list[]" value="173">
                                    <select name="attr_value_list[]">
                                        <option value="">请选择...</option>
                                        <option value="GSM,850,900,1800,1900" selected="selected">GSM,850,900,1800,1900</option>
                                        <option value="GSM,900,1800,1900,2100">GSM,900,1800,1900,2100</option><option value="CDMA">CDMA</option>
                                        <option value="双模（GSM,900,1800,CDMA 1X）">双模（GSM,900,1800,CDMA 1X）</option>
                                        <option value="3G(GSM,900,1800,1900,TD-SCDMA )">3G(GSM,900,1800,1900,TD-SCDMA )</option>
                                    </select>
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            <tr>
                                <td class="label">外观样式</td>
                                <td>
                                    <input type="hidden" name="attr_id_list[]" value="178">
                                    <select name="attr_value_list[]">
                                        <option value="">请选择...</option>
                                        <option value="翻盖">翻盖</option>
                                        <option value="滑盖">滑盖</option>
                                        <option value="直板">直板</option>
                                        <option value="折叠">折叠</option>
                                    </select>
                                    <input type="hidden" name="attr_price_list[]" value="0">
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- 商品相册 -->
            <table width="90%" id="gallery-table" style="display: none;" align="center">
                <tbody><tr>
                    <td>
                        <div id="gallery_41" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;">
                            <a href="javascript:;" onclick="if (confirm('您确实要删除该图片吗？')) dropImg('41')">[-]</a><br>
                            <a href="goods.php?act=show_image&amp;img_url=images/200905/goods_img/32_P_1242110760641.jpg" target="_blank">
                                <img src="../images/200905/thumb_img/32_thumb_P_1242110760997.jpg" width="100" height="100" border="0">
                            </a><br>
                            <input type="text" value="" size="15" name="old_img_desc[41]">
                        </div>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td>
                        <a href="javascript:;" onclick="addImg(this)">[+]</a>
                        图片描述 <input type="text" name="img_desc[]" size="20">
                        上传文件 <input type="file" name="img_url[]" id="input_multifileSelect">
                        <input type="text" size="40" value="或者输入外部图片链接地址" style="color:#aaa;" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" name="img_file[]">
                    </td>
                </tr>
                </tbody></table>

            <div class="button-div">
                <input type="hidden" name="goods_id" value="32">
                <input type="submit" value=" 确定 " class="button" onclick="validate('32')">
                <input type="reset" value=" 重置 " class="button">
            </div>
            <input type="hidden" name="act" value="update">
        </form>
        <div id="div_uploadedImgs"></div>
    </div>
</div>


<div id="footer">
    版权所有 &copy; 2006-2013
</div>
<script type="text/javascript" src="js/tab.js"></script>
<script type="text/javascript">

    function addImg(obj){
        var src  = obj.parentNode.parentNode;
        var idx  = rowindex(src);
        var tbl  = document.getElementById('gallery-table');
        var row  = tbl.insertRow(idx + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
    }

    function removeImg(obj){
        var row = rowindex(obj.parentNode.parentNode);
        var tbl = document.getElementById('gallery-table');
        tbl.deleteRow(row);
    }

    function dropImg(imgId){
        Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
    }

    function dropImgResponse(result){
        if (result.error == 0){
            document.getElementById('gallery_' + result.content).style.display = 'none';
        }
    }

</script>
</body>
</html>