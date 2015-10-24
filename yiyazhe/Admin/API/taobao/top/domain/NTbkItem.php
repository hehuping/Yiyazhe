<?php

/**
 * 淘宝客商品
 * @author auto create
 */
class NTbkItem
{
	
	/** 
	 * 淘客地址
	 **/
	public $clickUrl;
	
	/** 
	 * 商品地址
	 **/
	public $itemUrl;
	
	/** 
	 * 商品ID
	 **/
	public $numIid;
	
	/** 
	 * 商品主图
	 **/
	public $pictUrl;
	
	/** 
	 * 宝贝所在地
	 **/
	public $provcity;
	
	/** 
	 * 商品一口价格
	 **/
	public $reservePrice;
	
	/** 
	 * 商品小图列表
	 **/
	public $smallImages;
	
	/** 
	 * 商品标题
	 **/
	public $title;
	
	/** 
	 * 卖家类型，0表示集市，1表示商城
	 **/
	public $userType;
	
	/** 
	 * 商品折扣价格
	 **/
	public $zkFinalPrice;	
}
?>