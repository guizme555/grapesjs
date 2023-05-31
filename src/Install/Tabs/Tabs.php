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

class Tabs
{
    private const ADMIN_PARENT_THEMES_PS_TAB = 'AdminParentThemes';
    private const MODULE_PARENT_TAB = 'AdminGrapesJSParentTab';

    /**
     * Get module tabs information for installation
     *
     * @return array<int, array<string, mixed>>
     */
    public static function getTabs(): array
    {
        return [
            [
                'class_name' => self::MODULE_PARENT_TAB,
                'visible' => true,
                'name' => [
                    'en' => 'GrapesJS', // Fallback value
                    'fr' => 'GrapesJS',
                    'it' => 'GrapesJS',
                    'es' => 'GrapesJS',
                ],
                'route_name' => 'admin_grapesjs_index',
                'parent_class_name' => self::ADMIN_PARENT_THEMES_PS_TAB,
                'wording' => 'GrapesJS',
                'wording_domain' => 'Admin.Modules.GrapesJS',
                'position' => 0,
            ]
        ];
    }
}
