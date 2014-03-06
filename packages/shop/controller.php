<?php
defined('C5_EXECUTE') or die("Access Denied.");

class ShopPackage extends Package
{
    protected $pkgHandle            =   'shop';
    protected $appVersionRequired   =   '1.0';
    protected $pkgVersion           =   '1.0';

    public function getPackageDescription()
    {
        return t('Manage products');
    }

    public function getPackageName()
    {
        return t('Shop');
    }

    public function install()
    {
        $pkg    =   parent::install();

        // Setup the block
       BlockType::installBlockTypeFromPackage('display_products',$pkg);

        // Install the single pages for admin
        Loader::model('single_page');
        $sp =   SinglePage::add('dashboard/shop',$pkg);
        $sp->update(array('cName'=>t('Shop'),'cDescription'=>t('Manage products')));

        // Install the single pages for admin
        Loader::model('single_page');
        $sp =   SinglePage::add('dashboard/shop/manage',$pkg);
        $sp->update(array('cName'=>t('Manage products'),'cDescription'=>t('Manage products'),'cDisplayOrder'=>1));

        $sp =   SinglePage::add('dashboard/shop/add',$pkg);
        $sp->update(array('cName'=>t('Add product'),'cDescription'=>t('Add / Edit product'),'cDisplayOrder'=>2));

    }

}
