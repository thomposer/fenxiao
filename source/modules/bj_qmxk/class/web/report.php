<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (PHP_SAPI == 'cli') {
    die('This example should only be run from a Web Browser');
}
require_once IA_ROOT . BJ_QMXK_BASE . '/common/phpexcel/PHPExcel.php';
ini_set('memory_limit', '350M');
$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator('百家威信')->setLastModifiedBy('百家威信')->setTitle('Office 2007 XLSX Test Document')->setSubject('Office 2007 XLSX Test Document')->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')->setKeywords('office 2007 openxml php')->setCategory('report file');
if ($report == 'salereport01') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '月份')->setCellValue('B1', '交易量')->setCellValue('C1', '比例');
    $i = 2;
    foreach ($list as $v) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['month'])->setCellValue('B' . $i, $v['count'])->setCellValue('C' . $i, $v['persent'] . '%');
        $i++;
    }
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i, '总' . ($radioMonthForSaleType == 1 ? '交易额' : '交易量'))->setCellValue('E' . $i, $allcount);
    $i++;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i, '最高峰' . ($radioMonthForSaleType == 1 ? '交易额' : '交易量'))->setCellValue('E' . $i, $topcount);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
    $objPHPExcel->getActiveSheet()->setTitle('零售生意报告_按月统计');
}
if ($report == 'salereport02') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '日期')->setCellValue('B1', '交易量')->setCellValue('C1', '比例');
    $i = 2;
    foreach ($list as $v) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $v['day'])->setCellValue('B' . $i, $v['count'])->setCellValue('C' . $i, $v['persent'] . '%');
        $i++;
    }
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i, '总' . ($radiodayForSaleType == 1 ? '交易额' : '交易量'))->setCellValue('E' . $i, $dayallcount);
    $i++;
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $i, '最高峰' . ($radiodayForSaleType == 1 ? '交易额' : '交易量'))->setCellValue('E' . $i, $daytopcount);
    $objPHPExcel->getActiveSheet()->getStyle('A1:C1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
    $objPHPExcel->getActiveSheet()->setTitle('零售生意报告_按日统计');
}
if ($report == 'orderstatistics') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '订单号')->setCellValue('B1', '下单时间')->setCellValue('C1', '订单总额')->setCellValue('D1', '运费')->setCellValue('E1', '付款方式')->setCellValue('F1', '用户名')->setCellValue('G1', '收货人')->setCellValue('H1', '收货地址')->setCellValue('I1', '收货电话')->setCellValue('J1', '分类编号')->setCellValue('K1', '分类名称')->setCellValue('L1', '产品名称')->setCellValue('M1', '规格')->setCellValue('N1', '商品单价')->setCellValue('O1', '购买数量')->setCellValue('P1', '商品总价');
    $i = 2;
    $index = 0;
    $countmoney = 0;
    foreach ($list as $item) {
        $countmoney = $countmoney + $item['price'];
        $priceother = '';
        $index++;
        if (!empty($item['dispatchprice']) && $item['dispatchprice'] > 0) {
            $priceother = $item['dispatchprice'];
        } else {
            $priceother = '0';
        }
        $paytype = '';
        if ($item['paytype'] == 1) {
            $paytype = '余额支付';
        }
        if ($item['paytype'] == 2) {
            $paytype = '在线支付';
        }
        if ($item['paytype'] == 3) {
            $paytype = '货到付款';
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['ordersn'])->setCellValue('B' . $i, date('Y-m-d  H:i:s', $item['createtime']))->setCellValue('C' . $i, $item['price'])->setCellValue('D' . $i, $priceother)->setCellValue('E' . $i, $paytype)->setCellValue('F' . $i, $item['realnamestr'])->setCellValue('G' . $i, $item['tdrealname'])->setCellValue('H' . $i, $item['tdaddress'])->setCellValue('I' . $i, $item['tdmobile']);
        $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)));
        $itemdatas = array();
        $itemdline = 0;
        foreach ($item['ordergoods'] as $itemgoods) {
            if ($itemdline == 0) {
                $itemdatas['categorysn'] = '';
                $itemdatas['categoryname'] = '';
                $itemdatas['title'] = '';
                $itemdatas['optionname'] = '';
                $itemdatas['price'] = '';
                $itemdatas['total'] = '';
                $itemdatas['goodstotal'] = '';
                $sline = '';
            } else {
                $sline = '
';
            }
            $itemdatas['categorysn'] = $itemdatas['categorysn'] . $sline . $itemgoods['categorysn'];
            $itemdatas['categoryname'] = $itemdatas['categoryname'] . $sline . $itemgoods['categoryname'];
            $itemdatas['title'] = $itemdatas['title'] . $sline . $itemgoods['title'];
            $itemdatas['optionname'] = $itemdatas['optionname'] . $sline . $itemgoods['optionname'];
            $itemdatas['price'] = $itemdatas['price'] . $sline . $itemgoods['price'];
            $itemdatas['total'] = $itemdatas['total'] . $sline . $itemgoods['total'];
            $itemdatas['goodstotal'] = $itemdatas['goodstotal'] . $sline . round($itemgoods['total'] * $itemgoods['price'], 2);
            $itemdline = $itemdline + 1;
        }
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('J' . $i, $itemdatas['categorysn'])->setCellValue('K' . $i, $itemdatas['categoryname'])->setCellValue('L' . $i, $itemdatas['title'])->setCellValue('M' . $i, $itemdatas['optionname'])->setCellValue('N' . $i, $itemdatas['price'])->setCellValue('O' . $i, $itemdatas['total'])->setCellValue('P' . $i, $itemdatas['goodstotal']);
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':P' . $i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
        $objPHPExcel->getActiveSheet()->getStyle('J' . $i . ':P' . $i)->getAlignment()->setWrapText(true);
        $objBorderA5 = $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':Q' . $i)->getBorders();
        $objBorderA5->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objBorderA5->getTop()->getColor()->setARGB('FFFF0000');
        $objBorderA5->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        $objBorderA5->getBottom()->getColor()->setARGB('FFFF0000');
        $objPHPExcel->getActiveSheet()->getStyle('A' . $i . ':P' . $i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $i++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:P1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(18);
    $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
    $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(13);
    $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
    $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(65);
    $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
    $objPHPExcel->getActiveSheet()->setTitle('订单统计');
}
if ($report == 'saledetails') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '订单号')->setCellValue('B1', '商品名称')->setCellValue('C1', '数量')->setCellValue('D1', '价格')->setCellValue('E1', '成交时间');
    $i = 2;
    $index = 0;
    $countmoney = 0;
    foreach ($list as $item) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $item['ordersn'])->setCellValue('B' . $i, $item['titles'])->setCellValue('C' . $i, $item['total'])->setCellValue('D' . $i, $item['price'])->setCellValue('E' . $i, date('Y-m-d  H:i:s', $item['createtime']));
        $i++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setTitle('商品销售明细');
}
if ($report == 'productsaleranking') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '排行')->setCellValue('B1', '商品名称')->setCellValue('C1', '销售量')->setCellValue('D1', '销售额');
    $i = 2;
    $index = 1;
    $countmoney = 0;
    foreach ($list as $item) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $index)->setCellValue('B' . $i, $item['title'])->setCellValue('C' . $i, $item['salescount'] == 0 ? 0 : $item['salescount'])->setCellValue('D' . $i, $item['salesmoney'] == 0 || empty($item['salesmoney']) ? 0 : $item['salesmoney']);
        $i++;
        $index++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setTitle('商品销售排行');
}
if ($report == 'memberranking') {
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', '排行')->setCellValue('B1', '会员')->setCellValue('C1', '订单数')->setCellValue('D1', '消费金额');
    $i = 2;
    $index = 1;
    $countmoney = 0;
    foreach ($list as $item) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $i, $index)->setCellValue('B' . $i, $item['realname'])->setCellValue('C' . $i, $item['ordercount'])->setCellValue('D' . $i, $item['ordermoney'] == 0 || empty($item['ordermoney']) ? 0 : $item['ordermoney']);
        $i++;
        $index++;
    }
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getFont()->setBold(true);
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(12);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $objPHPExcel->getActiveSheet()->setTitle('会员消费排行');
}
$objPHPExcel->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="report_' . time() . '.xlsx"');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
die;