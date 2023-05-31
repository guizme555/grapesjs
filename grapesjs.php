<?php
/**
* 2007-2023 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2023 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

$autoloadPath = __DIR__ . '/vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

use PrestaShop\Module\GrapesJS\Install\Tabs\ModuleTabsInstaller;
use PrestaShop\Module\GrapesJS\Install\Tabs\ModuleTabsUninstaller;
use PrestaShop\ModuleLibServiceContainer\DependencyInjection\ServiceContainer;
use PrestaShopBundle\Entity\Repository\TabRepository;

class GrapesJS extends Module
{
    use PrestaShop\Module\GrapesJS\Traits\UseHooks;

     /**
     * @var ServiceContainer
     */
    private $serviceContainer;

    public function __construct()
    {
        $this->name = 'grapesjs';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'psxdesign';
        $this->need_instance = 0;

        
        parent::__construct();

        $this->displayName = $this->l('Test GrapesJS');
        $this->description = $this->l('Interface to Test to GrapesJS');

        $this->ps_versions_compliancy = [
            'min' => '8',
            'max' => _PS_VERSION_,
        ];

        $this->setServiceContainer();
        
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        /** @var TabRepository $tabRepository */
        $tabRepository = $this->get('prestashop.core.admin.tab.repository');

        return parent::install() &&
            (new ModuleTabsInstaller($tabRepository, $this))->installTabs() &&
            $this->registerHook($this->getHooksNames());
    }

    public function uninstall()
    {
        /** @var TabRepository $tabRepository */
        $tabRepository = $this->get('prestashop.core.admin.tab.repository');

        return parent::uninstall() && (new ModuleTabsUninstaller($tabRepository, $this))->uninstallTabs();
    }

   /**
     * Set service container for module connection with ps_account
     */
    private function setServiceContainer(): void
    {
        $this->serviceContainer = new ServiceContainer(
            $this->name,
            $this->getLocalPath()
        );
    }
}
