<?php
// autoload.php

spl_autoload_register(function ($class_name) {
    $paths = [
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/model/',
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/HomePage/',
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/controller/Sql/',
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/CommunityPage/',
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/AnnouncementPage/',
        $_SERVER['DOCUMENT_ROOT'].'/ISAD/view/CommunityPage/',
        // เพิ่ม path อื่นๆ ตามที่จำเป็น
    ];

    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>
