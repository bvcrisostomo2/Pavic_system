<?php
// At the begginnig of script...
ob_start();

// ... do some stuff ...

ob_get_clean();

header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=spreadsheet.xls" );
echo 'First Name' . "\t" . 'Last Name' . "\t" . 'Phone' . "\n";
echo 'John' . "\t" . 'Doe' . "\t" . '555-5555' . "\n";
die();
?>
