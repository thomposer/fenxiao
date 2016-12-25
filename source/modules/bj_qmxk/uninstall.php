<?php
defined('IN_IA') or exit('Access Denied');


$sql = "
	DROP TABLE IF EXISTS `ims_bj_qmxk_address`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_cart`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_category`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_feedback`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_goods`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_order`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_order_goods`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_product`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_spec`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_dispatch`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_express`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_goods_option`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_goods_param`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_adv`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_spec_item`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_member`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_commission`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_rules`;
		DROP TABLE IF EXISTS `ims_bj_qmxk_share_history`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_credit_request`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_credit_award`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_rule`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_channel`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_phb_medal`;
		DROP TABLE IF EXISTS `ims_bj_qmxk_follow`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_qr`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_msg_template`;
	DROP TABLE IF EXISTS `ims_bj_qmxk_pormotions`;
";

pdo_run($sql);