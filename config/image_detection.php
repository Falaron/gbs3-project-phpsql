<?php
    function isImage($url){
            $imgArray = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
            $urlExt = pathinfo($url, PATHINFO_EXTENSION);
            if (in_array($urlExt, $imgArray)) {
                return true;
            }
        }
?>