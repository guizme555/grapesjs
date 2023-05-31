<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License version 3.0
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License version 3.0
 */

declare(strict_types=1);

namespace PrestaShop\Module\GrapesJS\Install\Tabs;

use Language;
use PrestaShopBundle\Entity\Repository\TabRepository;
use GrapesJS;
use Tab;

class ModuleTabsUninstaller
{
    private const ADMIN_THEMES_TAB = 'AdminThemes';
    private const DEFAULT_ADMIN_THEMES_PARENT_TAB = 'AdminParentThemes';

    /* @var TabRepository */
    private $tabRepository;

    /* @var GrapesJS */
    private $module;

    public function __construct(TabRepository $tabRepository, GrapesJS $module)
    {
        $this->tabRepository = $tabRepository;
        $this->module = $module;
    }

    public function uninstallTabs(): bool
    {
        $tabs = Tabs::getTabs();

        foreach ($tabs as $tab) {
            $tabId = (int) $this->tabRepository->findOneIdByClassName($tab['class_name']);

            if (!$tabId) {
                continue;
            }

            $tab = new Tab($tabId);
            $tab->delete();
        }

        return true;
    }
}
