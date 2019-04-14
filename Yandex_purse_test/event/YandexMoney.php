<?php

    $hash = sha1($_POST['notification_type'].'&'.
    $_POST['operation_id'].'&'.
    $_POST['amount'].'&'.
    $_POST['currency'].'&'.
    $_POST['datetime'].'&'.
    $_POST['sender'].'&'.
    $_POST['codepro'].'&'.
    'elzBZTjTaq2YO3kWFl7wiugg'.'&'.   //secret
    $_POST['label']);

    if ( $_POST['sha1_hash'] != $hash || $_POST['codepro'] === true || $_POST['unaccepted'] === true ) {
        exit('error');
    }

    $file = fopen('../data_base.txt', 'a');
    $str = '"datatime" => "' . $_POST['datetime'] . '", "amount" => "' . $_POST['amount'] . '",';
    fwrite($file, $str . PHP_EOL);
    fclose($file);

?>