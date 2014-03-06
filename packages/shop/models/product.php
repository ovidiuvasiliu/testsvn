<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('product_object','shop');
Loader::model('product_list','shop');

class product extends Product_Object
{
    protected$_table   =   'products';
    protected $_primaryKey = 'product_id';

    public static function getByProductID($tID)
    {
        $product    =   new Product();
        $db     =   Loader::db();
        $qry    =   "SELECT * FROM ". $product->getTableName() ." WHERE ". $product->getIdFieldName() ."=?";

                $row	=	 $db->GetRow($qry,array($tID));

        if(!$row)

            return $product;
        foreach($row as $k=>$v)
            $product->setData ($k, $v);

        return $product;
    }


    public function getProductID()
    {
        return $this->getId();
    }

    protected function _validate()
    {
        if(!$this->getTitle())	$this->addError(t('Please enter a title'),'title');
        if(!$this->getDescription())	$this->addError(t('Please enter a description'),'description');
        if(!$this->getPrice())	$this->addError(t('Please enter a price'),'price');
    }

}
