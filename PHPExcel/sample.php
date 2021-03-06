<?php
    require_once '../PHPExcel/Classes/PHPExcel.php';
    $objPHPExcel = new PHPExcel();

    $sheet = $objPHPExcel->getActiveSheet();

    // 글꼴
    $sheet->getDefaultStyle()->getFont()->setName('맑은 고딕');

    $sheetIndex = $objPHPExcel->setActiveSheetIndex(0);

    // 제목
    $sheetIndex->setCellValue('A1', '제 목');
    $sheetIndex->mergeCells('A1:D1');
    $sheetIndex->getStyle('A1')->getFont()->setSize(20)->setBold(true);
    $sheetIndex->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    // 내용
    $sheetIndex ->setCellValue('A2', '하나')
                ->setCellValue('B2', '둘')
                ->setCellValue('C2', '셋')
                ->setCellValue('D2', '넷');

    $sheet = iconv('UTF-8','UTF-8',$sheet);
    $sheetIndex = iconv('UTF-8','UTF-8',$sheetIndex);
/*
    header("Content-Type: text/html; charset=utf-8");
    header("Content-Encoding: utf-8");
    header('Content-Type: application/vnd.ms-excel; charset=utf-8');
    header('Content-Disposition: attachment;filename=sample.xls');
    header('Cache-Control: max-age=0');
*/
    $filename = iconv("UTF-8", "UTF-8", "sample");
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xls"');
    header('Cache-Control: max-age=0');
    header("Content-Transfer-Encoding:binary");
    header("Content-charset:utf-8");

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');

    exit;
    /*
    http://staystore.co.kr/PHPExcel/sample.php
    http://pension/PHPExcel/sample.php
    */
?>