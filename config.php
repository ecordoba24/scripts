<?php

if($_SERVER["SERVER_NAME"] == "localhost"){
    $show = true;
}else{
    $show = false;
}
init_set('display_errors', $show);
error_reporting(E_ALL);