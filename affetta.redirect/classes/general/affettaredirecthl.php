<?

use Bitrix\Main\Loader;
use Bitrix\Highloadblock\HighloadBlockTable as HLBT;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

class AffettaRedirectHL
{

    public function SEOUrl($url){

        $hlblock_ID = HLBT::getList(array(
            'select' => array('ID'),
            'filter' => array('=NAME' => 'AffettaRedirect'),
            'limit' => 1,
        ))->fetch();

        $hlblock = HLBT::getById($hlblock_ID["ID"])->fetch();

        $entity = HLBT::compileEntity($hlblock);
        $entity_data_class = $entity->getDataClass();

        $redirect = $entity_data_class::getList(array(
            "select" => array("*"),
            "order" => array("ID" => "ASC"),
            "filter" => array("UF_ACTIVE"=> "1", "=UF_BEFORE"=>$url)
        ))->Fetch();

        return $redirect;
    }
    public function OnPageStart(){
        global $APPLICATION;
        if(stripos($APPLICATION->GetCurDir(), '/bitrix/') !== false) return;
        $url = $APPLICATION->GetCurDir();
        $seo = AffettaRedirectHL::SEOUrl($url);
        if($seo['UF_AFTER']){
            LocalRedirect($seo['UF_AFTER']);
        }
    }
}?>