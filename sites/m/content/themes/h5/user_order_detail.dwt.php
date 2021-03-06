<?php
/*
Name: 订单详情模板
Description: 这是订单详情页
Libraries: page_menu,page_header
*/
defined('IN_ECJIA') or header("HTTP/1.0 404 Not Found");exit('404 Not Found');
?>
<!-- {extends file="ecjia-touch.dwt.php"} -->

<!-- {block name="footer"} -->
<script type="text/javascript">
	ecjia.touch.user.cancel_order();
	ecjia.touch.user.return_order();
</script>
<!-- {/block} -->

<!-- {block name="main-content"} -->
<!-- #EndLibraryItem -->
<div class="ecjia-order-detail">
	<div class="ecjia-checkout ecjia-margin-b">
		<div class="flow-goods-list">
		    <div class="order-status-head">
			    <a href="{url path='user/order/order_detail'}&order_id={$order.order_id}&type={'status'}">
			        <span class="order-status-img"><p></p><img src="{$theme_url}images/icon/list_h_circle_50.png"></span>
			        <div class="order-status-msg">
	    		        <span class="order-head-top"><span class="order-head-font">{$headInfo.order_status}</span><span class="ecjiaf-fr order-color">{$headInfo.time}</span></span>
	    		        <p class="ecjia-margin-t status"><span class="order-color order-status">{$headInfo.message}</span><span class="ecjiaf-fr more-status">更多状态 ></span></p>
			        </div>
		        </a>
		    </div>
		    
			<div class="order-hd">
				<a class="ecjiaf-fl" href='{url path="merchant/index/init" args="store_id={$order.store_id}"}'>
					<i class="iconfont icon-shop"></i>{$order.seller_name}
				</a>
			</div>
			<ul class="goods-item">
				<!-- {foreach from=$order.goods_list item=goods} -->
				<li>
				    <a href='{url path="goods/index/show" args="goods_id={$goods.goods_id}"}'>
					<div class="ecjiaf-fl goods-img">
						<img src="{$goods.img.thumb}" alt="{$goods.name}" title="{$goods.name}" />
					</div>
					<div class="ecjiaf-fl goods-info">
						<p class="ecjia-truncate2">{$goods.name}</p>
						<p class="ecjia-goods-attr goods-attr">
						<!-- {foreach from=$goods.goods_attr item=attr} -->
						{if $attr.name}{$attr.name}:{$attr.value}{/if}
						<!-- {/foreach} -->
						</p>
						<p class="ecjia-color-red goods-attr-price">{$goods.formated_shop_price}</p>
					</div>
					<span class="ecjiaf-fr goods-price"> x {$goods.goods_number}</span>
					</a>
				</li>
				<!-- {/foreach} -->
			</ul>
			<ul class="ecjia-list">
				<li>商品金额：<span class="ecjiaf-fr ">{$order.formated_goods_amount}</span></li>
				{if $order.tax neq 0}
				<li>税费金额：<span class="ecjiaf-fr ">{$order.formated_tax}</span></li>
				{/if}
				{if $order.integral_money neq 0}
				<li>积分抵扣：<span class="ecjiaf-fr ecjia-color-red ">-{$order.formated_integral_money}</span></li>
				{/if}
				{if $order.bonus neq 0}
				<li>红包抵扣：<span class="ecjiaf-fr ecjia-color-red ">-{$order.formated_bonus}</span></li>
				{/if}
				{if $order.discount neq 0}
				<li>优惠金额：<span class="ecjiaf-fr ecjia-color-red ">-{$order.formated_discount}</span></li>
				{/if}
				{if $order.shipping_fee neq 0}
				<li>运费：<span class="ecjiaf-fr ">{$order.formated_shipping_fee}</span></li>
				{/if}
				{if $order.pay_fee neq 0}
				<li>手续费：<span class="ecjiaf-fr ">{$order.formated_pay_fee}</span></li>
				{/if}
				<li>共计：<span class="ecjiaf-fr ">{$order.formated_total_fee}</span></li>
			</ul>
			
			{if $order.order_mode eq 'storepickup'}
				<p class="select-title ecjiaf-fwb ecjia-margin-l">自提信息</p>
				<ul class="ecjia-list">
				    <li><span class="ecjiaf-fl width-25-p">提货时间：</span><span class="ecjiaf-fr width-75-p">{if $order.expect_shipping_time}{$order.expect_shipping_time}{else}暂无{/if}</span></li>
					<li><span class="ecjiaf-fl width-25-p">提货码：</span><span class="ecjiaf-fr width-75-p">{if $order.pickup_code}{$order.pickup_code}{else}暂无{/if}</span></li>
					<li style="height: auto; position: relative;">
						<span class="ecjiaf-fl width-25-p">提货门店：</span>
						<span class="ecjiaf-fr width-75-p p_d">{$order.seller_name} {if $order.service_phone}({$order.service_phone}){/if}</span>
						<span class="ecjiaf-fr width-75-p">{$order.store_address}</span>
						{if $location_url}
						<a class="nopjax external" href="{$location_url}"><i class="icon-shopguide-detail"></i></a>
						{/if}
					</li>
				</ul>
			{else}
				<p class="select-title ecjiaf-fwb ecjia-margin-l">配送信息</p>
				<ul class="ecjia-list">
				    <!-- <li><span class="ecjiaf-fl width-25-p">发货时间：</span><span class="ecjiaf-fr width-75-p">{if $order.shipping_time}{$order.shipping_time}{else}暂未发货{/if}</span></li> -->
					{if $order.expect_shipping_time neq ' ' && $order.expect_shipping_time neq '' && $order.expect_shipping_time neq 'undefined'}<li><span class="ecjiaf-fl width-25-p">送达时间：</span><span class="ecjiaf-fr width-75-p">{$order.expect_shipping_time}</span></li>{/if}
					<li style="height: auto;"><span class="ecjiaf-fl width-25-p">收货地址：</span>
					<span class="ecjiaf-fr width-75-p">{$order.consignee} {$order.mobile}</span>
					<span class="ecjiaf-fr width-75-p">{$order.province}{$order.city}{$order.district}{$order.street} {$order.address}</span></li>
					<li>
						<span class="ecjiaf-fl width-25-p">配送员：</span><span class="ecjiaf-fr width-75-p">
						{if $order.express_user}
							{$order.express_user}
							{if $express_url}
							<span>
								<a style="float: right;display: inline-block;" class="nopjax external" href="{$express_url}">
									<img class="order-map" src="{$theme_url}images/icon/order-map.png">
								</a>
							</span>
							{/if}
						{else}
							暂无
						{/if}
						</span>
					</li>
					<li><span class="ecjiaf-fl width-25-p">配送员号码：</span><span class="ecjiaf-fr width-75-p">{if $order.express_user}{$order.express_mobile}{else}暂无{/if}</span></li>
					<li><span class="ecjiaf-fl width-25-p">配送方式：</span><span class="ecjiaf-fr width-75-p">{$order.shipping_name}</span></li>
				</ul>
			{/if}
			
			{if $order.shipping_code == 'ship_cac' && $order.pickup_code neq '' && $order.order_mode neq 'storepickup'}
			<p class="select-title ecjiaf-fwb ecjia-margin-l">提货信息</p>
			<ul class="ecjia-list">
				<li><span class="ecjiaf-fl width-25-p">提货码：</span><span class="ecjiaf-fr width-75-p">{$order.pickup_code}</span></li>
				<li><span class="ecjiaf-fl width-25-p">提货状态：</span><span class="ecjiaf-fr width-75-p">{if $order.pickup_status == 0}未提取{else}已提取{/if}</span></li>
				<li hidden><span class="ecjiaf-fl width-25-p">有效期至：</span><span class="ecjiaf-fr width-75-p">{$order.pickup_code_expiretime}</span></li>
			</ul>
			{/if}
			
			<p class="select-title ecjiaf-fwb ecjia-margin-l">订单信息</p>
			<ul class="ecjia-list">
			    <li><span class="ecjiaf-fl width-25-p">订单编号：</span><span class="width-75-p">{$order.order_sn}</span><button class="copy-btn" data-clipboard-text="{$order.order_sn}">复制</button></li>
			    <li><span class="ecjiaf-fl width-25-p">下单时间：</span><span class="ecjiaf-fr width-75-p">{$order.formated_add_time}</span></li>
				<li><span class="ecjiaf-fl width-25-p">支付方式：</span><span class="ecjiaf-fr width-75-p">{$order.pay_name}</span></li>
				<li><span class="ecjiaf-fl width-25-p">发票抬头：</span><span class="ecjiaf-fr width-75-p">{if $order.inv_title_type}{$order.inv_payee}{else}无{/if}</span></li>
				<li><span class="ecjiaf-fl width-25-p">发票识别码：</span><span class="ecjiaf-fr width-75-p">{if $order.inv_tax_no}{$order.inv_tax_no}{else}无{/if}</span></li>
				<li class="remark"><span class="ecjiaf-fl width-25-p">订单备注：</span><span class="ecjiaf-fr width-75-p">{if $order.postscript}{$order.postscript}{else}无{/if}</span></li>
			</ul>
			<div class="order-ft-link">
				<a class="btn btn-small btn-hollow external" href="{if $order.service_phone}tel://{$order.service_phone}{else}javascript:alert('无法联系卖家');{/if}">联系卖家</a>
				{if !$order.refund_info}
					{if $order.order_status_code eq 'await_pay'}
						<a class="btn btn-small btn-hollow cancel_order_unpay" href='{url path="user/order/order_cancel" args="order_id={$order.order_id}"}'>取消订单</a>
						<a class="btn btn-small btn-hollow" href='{url path="pay/index/init" args="order_id={$order.order_id}"}'>去支付</a>
					{/if}
					
					{if $order.order_status_code eq 'await_ship'}
						<a class="btn btn-small btn-hollow" href='{url path="user/order/return_order" args="order_id={$order.order_id}"}'>申请退款</a>
					{/if}
					
					{if $order.order_status_code eq 'shipped'} 
						<a class="btn btn-small btn-hollow affirm_received" href='{url path="user/order/affirm_received" args="order_id={$order.order_id}"}'>确认收货</a>
						<a class="btn btn-small btn-hollow" href='{url path="user/order/return_order" args="order_id={$order.order_id}"}'>申请退款</a>
					{/if}
				{/if}
				
				{if $order.order_status_code eq 'canceled'}
					<a class="btn btn-small btn-hollow" href='{url path="user/order/buy_again" args="order_id={$order.order_id}"}'>再次购买</a>
				{/if}
				
				{if ($order.refund_type eq 'refund' || $order.refund_type eq 'return') && $order.refund_status eq 'going'}
				<a class="btn btn-small btn-hollow undo_reply" href='{url path="user/order/undo_reply" args="order_id={$order.order_id}&refund_sn={$order.refund_info.refund_sn}"}'>撤销申请</a>
				{/if}
				
				{if !$order.refund_info eq 2 && $order.order_status_code eq 'finished'}
				<a class="btn btn-small btn-hollow" href='{url path="user/order/comment_list" args="order_id={$order.order_id}"}'>评价晒单</a>
				{/if}
				
				{if $order.order_status_code eq 'refunded' || $order.order_status_code eq 'finished' || $order.refund_info}
					{if $order.refund_info}
					<a class="btn btn-small btn-hollow" href='{url path="user/order/return_detail" args="order_id={$order.order_id}{if $order.refund_info}&refund_sn={$order.refund_info.refund_sn}{/if}"}'>售后</a>
					{else}
					<a class="btn btn-small btn-hollow" href='{url path="user/order/return_list" args="order_id={$order.order_id}"}'>售后</a>
					{/if}
				
				{/if}
			</div>
		</div>
	</div>
	<input type="hidden" name="reason_list" value='{$reason_list}'>
</div>
<!-- {/block} -->