<?

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main;
use Bitrix\Main\ModuleManager;


Loc::loadMessages(__FILE__);

Class test extends CModule
{
    var $MODULE_ID = "test";
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $MODULE_GROUP_RIGHTS = "Y";

    public function __construct()
    {
        $arModuleVersion = array();

        include(__DIR__.'/version.php');

        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->MODULE_NAME = 'My module';
        $this->MODULE_DESCRIPTION = 'Description my module';
    }


    function InstallDB()
    {
        ModuleManager::registerModule('test');
        return true;
    }

    function UnInstallDB($arParams = Array())
    {
        ModuleManager::unRegisterModule('test');
        AddMessage2Log('UnInstall BD Module','test');
        return true;
    }

    function InstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->registerEventHandler('sale', 'OnSaleOrderBeforeSaved', 'test', '\Bitrix\MyOrder\Util', 'OnSaleOrderBeforeSaved');
        return true;
    }

    function UnInstallEvents()
    {
        $eventManager = EventManager::getInstance();
        $eventManager->unRegisterEventHandler('sale', 'OnSaleOrderBeforeSaved', 'test', '\Bitrix\MyOrder\Util', 'OnSaleOrderBeforeSaved');
        return true;
    }

    function InstallFiles()
    {

        return true;
    }

    function UnInstallFiles()
    {
        return true;
    }

    function DoInstall()
    {
        define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/log.txt");
        $this->InstallFiles();
        $this->InstallDB();
        $this->InstallEvents();
        AddMessage2Log('Do Install Module','test');
    }

    function DoUninstall()
    {
        $this->UnInstallDB(false);
    }
}
?>