<?php
require_once __DIR__.'/picqerbarcode/BarcodeGenerator.php';
require_once __DIR__.'/picqerbarcode/BarcodeGeneratorHTML.php';


class BarCode{
    function __construct(){

    }
    
    public function getCode($value){
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode =  $generator->getBarcode(
            $value,
            $generator::TYPE_CODE_39,1,30
            );
        return $barcode;
        // 'DMTU'.date('YmdHis');
    }
}