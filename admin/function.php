<?php
function redirect($url) {
    header('Location: '. $url);
    exit(0);
}
function webSetting($columnName){
    $setting = getById('settings', 1);
    if($setting){
        return $setting[$columnName];
    }
}
?>
