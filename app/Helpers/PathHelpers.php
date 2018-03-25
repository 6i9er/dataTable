<?php
function getUrlPath($urlPath){
    return url(''). "/" . App::getLocale() . "/" .$urlPath;
}
function getPageNameForTitle($hasParameter = '0' , $titleName = ''){
    if($hasParameter == '0') {
        return str_replace("/" , "" , explode( url(App::getLocale()), url()->current() )[1] );
    }else {
        return $titleName;
    }
//    echo url(''). "/" . App::getLocale() . "/" .$urlPath;
}
