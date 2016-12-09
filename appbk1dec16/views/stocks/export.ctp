<?php
if((!empty($_POST['checkid'])) &&(!empty($_POST['exports']))){
//$line= $stock[0]['Stock'];
$mapping = array('item_sku','barcodes','sale_price','quantity');
echo $csv->addRow($mapping);
//$csv->addRow(array_keys($line));
foreach ($stocks->Data as  $stock){		
$line = array($stock->ItemNumber,$stock->BarcodeNumber,$stock->RetailPrice,$stock->Quantity);
echo $csv->addRow($line);
}
$filename='stocks';
echo $csv->render($filename);
}	
?>