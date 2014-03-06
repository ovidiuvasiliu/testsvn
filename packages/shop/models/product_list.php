<?php
defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('product','shop');

class ProductList extends DatabaseItemList
{
    public $table   =   'products';
    public $primary =   'product_id';
    public $keys    =   array('title','description','price');


    public function createProduct(array $data)
    {
        $data    =   $this->createRow($data);

        return $this->saveProduct($data);
    }


    public function createRow($data=array())
    {
        $product	=	new Product();
        foreach ($this->keys as $key) {
            if(!$product->hasData($key))
                $product->setData ($key);
        }

        return $product;
    }


    public function fetchByID($id)
    {
        return Product::getByProductID($id);
    }

    protected function _validate($data)
    {
        foreach($this->keys as $key)
            if(!array_key_exists($key,$data))

                return false;

        if(!isset($data['title']))

            return false;

        if(!isset($data['description']))

            return false;
        
        if(!isset($data['price']))

            return false;
        
        return true;
    }


    protected function setBaseQuery()
    {
        $this->setQuery('SELECT DISTINCT t.product_id
        FROM '.$this->table.' t
        ');
    }

   
    protected function createQuery()
    {
        if (!$this->queryCreated) {
            $this->setBaseQuery();
            $this->queryCreated=1;
        }
    }


    public function get($itemsToGet = 0, $offset = 0)
    {
        $products = array();
        $this->createQuery();
        $r = parent::get($itemsToGet, $offset);
        foreach ($r as $row) {
            $t  =   Product::getByProductID($row['product_id']);
            $products[] = $t;
        }

        return $products;
    }
}

class ProductSearchDefaultColumnSet extends DatabaseItemListColumnSet
{

public function __construct()
{
        $this->addColumn(new DatabaseItemListColumn('title', t('Title'),'getTitle'));
        $this->addColumn(new DatabaseItemListColumn('description', t('Description'),  'getDescription'));
        $this->addColumn(new DatabaseItemListColumn('price', t('Price'), 'getPrice'));
        $do = $this->getColumnByKey('title');
        $this->setDefaultSortColumn($do, 'desc');
    }
}

class ProductSearchColumnSet extends DatabaseItemListColumnSet
{
    protected $attributeClass = 'UserAttributeKey';
    public function getCurrent()
    {
        $fldc = new ProductSearchDefaultColumnSet();

        return $fldc;
    }
}
