<?php
/**
 * 2007-2018 Frédéric BENOIST
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
 *  @author    Frédéric BENOIST <http://www.fbenoist.com/>
 *  @copyright 2013-2018 Frédéric BENOIST <contact@fbenoist.com>
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */

class AdminSampleController extends ModuleAdminController
{
    public function __construct()
    {
        $this->bootstrap = true;
        $this->display = 'view';
        parent::__construct();

        $this->context->smarty->assign(array(
            'some_var' =>  'some_value',
        ));
    }

    public static function installInBO($module, $name)
    {
        $new_menu = new Tab();
        $new_menu->id_parent = Tab::getIdFromClassName('AdminCatalog');
        $new_menu->class_name = 'AdminSample'; // Class Name (Without "Controller")
        $new_menu->module = $module->name;
        $new_menu->active = 1;

        // Set menu name in all active Language.
        $languages = Language::getLanguages(true);
        foreach ($languages as $language) {
            $new_menu->name[(int)$language['id_lang']] = $name;
        }

        return $new_menu->save();
    }

    public static function removeFromBO()
    {
        $remove_id = Tab::getIdFromClassName('AdminSample');
        if ($remove_id) {
            $to_remove = new Tab((int)$remove_id);
            if (validate::isLoadedObject($to_remove)) {
                return $to_remove->delete();
            }
        }
        return false;
    }
}
