<?php
require_once ("vendor/autoload.php");
if ( $xlsx = SimpleXLSX::parse('DataSheet.xlsx') ) {
    $rows = array_slice($xlsx->rows(), 1);
    $itemsName = array();
    foreach ($rows as $row) {
        if ($row[0] == $_GET['product']) {

            $rowsImages = $xlsx->rows(1);

            $itemsProducts = [];

            $itemsProducts[0]['name'] = $row[2];
            foreach ($rowsImages as $rowImage) {
                if (strtolower($rowImage[0]) == strtolower($row[2])) {
                    $itemsProducts[0]['image'] = 'Images/'. $rowImage[1];
                    break;
                }
                else {
                    $itemsProducts[0]['image'] = 'Images/download.jpeg';
                }

            }

            $itemsProducts[1]['name'] = $row[3];
            foreach ($rowsImages as $rowImage) {
                if (strtolower($rowImage[0]) == strtolower($row[3])) {
                    $itemsProducts[1]['image'] = 'Images/'. $rowImage[1];
                    break;
                }
                else {
                    $itemsProducts[1]['image'] = 'Images/download.jpeg';
                }

            }
            $itemsProducts[2]['name'] = $row[4];
            foreach ($rowsImages as $rowImage) {
                if (strtolower($rowImage[0]) ==strtolower( $row[4])) {
                    $itemsProducts[2]['image'] = 'Images/'. $rowImage[1];
                    break;
                }
                else{
                    $itemsProducts[2]['image'] = 'Images/download.jpeg';
                }

            }

            $itemsName[] = $itemsProducts;
        }
    }

    echo json_encode($itemsName);
}
else {
    echo SimpleXLSX::parseError();
}
?>