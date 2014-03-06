<?php
defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('product_list','shop');
class DashboardShopAddController extends Controller
{
    public function on_start()
    {
        // Assign helpers
        $this->set('ih',Loader::helper('concrete/interface'));
        $this->set('fh',Loader::helper('form'));

        // Track errors
        $this->error = Loader::helper('validation/error');
    }

    public function view()
    {
        $fh =   Loader::helper('form');

        $products   =   new ProductList();
        if ($fh->getRequestValue('pID')) {
            $product    =   $products->fetchByID($fh->getRequestValue('pID'));
            if ($product) {
                $this->set('pID',$product->getProductID());
            }
            
            else {
                $this->redirect('/dashboard/shop/add?p-unavailable=1');
            }
        }
       
        else {
            $product    =   $products->createRow();
        }

        if ($_POST['save']) {

            if ($fh->getRequestValue('ccm-submit-ccm-product-delete','post')) {
                if ($product->getID()) {
                    $product->delete();
                    $this->redirect('/dashboard/shop/manage?t-deleted=1');
                }
            }

            $title      =   $fh->getRequestValue('title');
            $description     =   $fh->getRequestValue('description');
            $price =   $fh->getRequestValue('price');
            $image =   $fh->getRequestValue('fID');

            $data   =   array(
                    'title'	                =>  $title,
                    'description'			=>  $description,
                    'price'		=>  $price,
                    'photo_fID'		=>  $image
            );
            foreach($data as $k=>$v)
                $product->setData($k,$v);

            
            if ($product->save()) {

               
                if ($fh->getRequestValue('ccm-submit-ccm-product-add-another')) {
                    $this->redirect('/dashboard/shop/add?p-saved=1');
                }

                $this->redirect('/dashboard/shop/add?pID=' . $product->getID() . '&p-saved=1');
            }
           
            else {
   
                foreach ($product->getErrors() as $k => $v) {
                    $this->error->add($v);
                }
            }

        }
       
        if($fh->getRequestValue('p-saved'))
            $this->set('message', t('Product saved successfully.'));
       
        elseif($fh->getRequestValue('p-unavailable'))
            $this->error->add(t('Unable to find the selected product'));

        $this->set('product',$product);
        $this->set('error',$this->error);
    }

}
