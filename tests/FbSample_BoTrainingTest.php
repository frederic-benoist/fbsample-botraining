<?php
/**
 * 2007-2019 Frédéric BENOIST
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
 *  @author    Frédéric BENOIST
 *  @copyright 2013-2019 Frédéric BENOIST <https://www.fbenoist.com/>
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */



use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class FbSample_BoTrainingTest extends KernelTestCase
{
    const _MODULE_NAME_ = 'fbsample_botraining';
    const _MODULE_VERSION_ = '1.7.0';

    private $container;
    private $module;

    public function setUp()
    {
        global $kernel;

        $kernel = self::createKernel();
        $kernel->boot();

        $this->container = $kernel->getContainer();
        $this->module = $this->container
            ->get('prestashop.core.admin.module.repository')
            ->getModule(self::_MODULE_NAME_);
    }

    public function tearDown()
    {
       $this->module->onUninstall();
    }

    public function testModuleNameIsOk()
    {
        $this->assertEquals(
            self::_MODULE_NAME_,
            $this->module->attributes->get('name')
        );
    }

    public function testModuleVersionIsOk()
    {
     //   var_dump($this->module);
        $this->assertEquals(
            self::_MODULE_VERSION_,
            $this->module->attributes->get('version')
        );
    }

    public function testModuleInstallOk()
    {
        $this->assertEquals(
            true,
            $this->module->onInstall()
        );
    }

}
