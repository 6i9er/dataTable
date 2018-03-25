<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\LaravelLocalization;
class SiteSettingController extends Controller
{
    function __construct() {
    }
    public function index(){
        return "aaaaaaA";
    }
    public function getChangelanguage(Request $request){
//        return url()->previous();
        $locale = $request->lang;
        $languageArr = array("ar","en");
        if(in_array($locale , $languageArr)){
            $oldLocale= App::getLocale();
//            if($locale != $oldLocale){
                $oldUrl =  getUrlPath(str_replace("/" , "" , explode( url($oldLocale), url()->previous() ) )[1]);
                App::setLocale($locale);
                $oldUrl = str_replace("/".$oldLocale , "/".$locale ,$oldUrl  );
                if(substr($oldUrl,-1) == "/"){
                    return Redirect::to(substr($oldUrl, 0, -1) ,301);
                }else{
                    return Redirect::to($oldUrl ,301);
                }
//            }else{
//                return Redirect::to(url()->previous(),301);
//            }
        }else{
            return Redirect::to("/",301);
        }
    }
}