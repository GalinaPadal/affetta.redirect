<?
IncludeModuleLangFile(__FILE__);

use Bitrix\Main\Loader;
use Bitrix\Main\Entity;

Loader::includeModule("highloadblock");

define('SITE_SERVER_NAME_FULL', ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER["HTTP_HOST"]);
CModule::AddAutoloadClasses(
    "affetta.redirect",
    array(
        "AffettaRedirectHL" => "classes/general/affettaredirecthl.php",
    )
);

