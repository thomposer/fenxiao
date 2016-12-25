<?php
$weid = $_W['weid'];
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
$starttime = strtotime($_GPC['start_time']);
$endtime = strtotime($_GPC['end_time']);
$info = pdo_fetch('select og.id, og.total, og.price, og.status, og.commission, og.applytime, og.content, g.title from ' . tablename('bj_qmxk_order_goods') . ' as og left join ' . tablename('bj_qmxk_goods') . ' as g on og.goodsid = g.id and og.weid = g.weid WHERE og.createtime>= ' . $starttime . ' AND og.createtime<=' . $endtime . ' ');
$commissionList = pdo_fetchall('SELECT c.*,m.realname,m.mobile,m.bankcard,m.alipay,m.wxhao FROM `ims_bj_qmxk_commission` AS c LEFT JOIN `ims_bj_qmxk_member` AS m ON c.mid=m.id WHERE c.createtime>=' . $starttime . ' AND c.createtime<=' . $endtime . ' AND c.isout = 0 AND c.flag = 0 AND c.weid=' . $_W['weid'] . '  ');
if (empty($commissionList)) {
    message('已没有需要导出的数据了！');
    die;
}
$list = array();
foreach ($commissionList as $k => $v) {
    $ogid = $v['ogid'];
    $info = pdo_fetch('select og.id, og.checktime, og.content from ' . tablename('bj_qmxk_order_goods') . ' as og left join ' . tablename('bj_qmxk_goods') . ' as g on og.goodsid = g.id and og.weid = g.weid where og.id = ' . $ogid);
    pdo_update('bj_qmxk_commission', array('isout' => 1), array('id' => $v['id']));
    $list[$k]['realname'] = $v['realname'];
    $list[$k]['mobile'] = $v['mobile'];
    $list[$k]['bankcard'] = $v['bankcard'];
    $list[$k]['alipay'] = $v['alipay'];
    $list[$k]['wxhao'] = $v['wxhao'];
    $list[$k]['checktime'] = date('Y-m-d H:m:s', $info['checktime']);
    $list[$k]['commissiontotal'] = $v['commission'];
    $list[$k]['content'] = $info['content'];
}
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli') {
    die('This example should only be run from a Web Browser');
}
require_once IA_ROOT . BJ_QMXK_BASE . '/common/phpexcel/PHPExcel.php';
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('百家威信')->setLastModifiedBy('百家威信')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('Test result file');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '真实姓名')->setCellValue('B1', '手机号码')->setCellValue('C1', '审核时间')->setCellValue('D1', '申请佣金')->setCellValue('E1', '银行卡号')->setCellValue('F1', '支付宝号')->setCellValue('G1', '微信号码')->setCellValue('H1', '备注');
foreach ($list as $i => $v) {
    $i = $i + 2;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['realname'])->setCellValue('B' . $i, $v['mobile'])->setCellValue('C' . $i, $v['checktime'])->setCellValue('D' . $i, $v['commissiontotal'])->setCellValue('E' . $i, ' ' . $v['bankcard'] . ' ')->setCellValue('F' . $i, ' ' . $v['alipay'] . ' ')->setCellValue('G' . $i, ' ' . $v['wxhao'] . ' ')->setCellValue('H' . $i, $v['content']);
}
$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
$time = time();
$objPHPExcel->getActiveSheet()->setTitle('微商城佣金充值' . $time);
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="moon_' . $time . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
die;