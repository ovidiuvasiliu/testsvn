<?php

defined('C5_EXECUTE') or die("Access Denied.");
Loader::model('product_list', 'shop');

class DashboardShopManageController extends Controller {

    public function on_start() {
        
    }

    public function view() {
        $html = Loader::helper('html');
        $form = Loader::helper('form');
        $urls = Loader::helper('concrete/urls');
        $this->set('form', $form);
        $this->addHeaderItem($html->javascript('dashboard.product.js','shop'));
        
        $this->_processProducts();

        $pl = $this->getRequestedSearchResults();
        $products = $pl->getPage();

        $this->set('productList', $pl);
        $this->set('products', $products);
        $this->set('pagination', $pl->getPagination());

        if ($form->getRequestValue('p-deleted')) {
            if ($form->getRequestValue('t-multiple'))
                $this->set('message', t('%d product(s) deleted successfully', $form->getRequestValue('t-multiple')));
            else {
                $this->set('message', t('Product deleted successfully.'));
            }
        }
    }

    protected function _processProducts() {
        $fh = Loader::helper('form');
        $pl = new ProductList();

        // Batch operations
        if ($fh->getRequestValue('operate-products') && isset($_POST['pID']) && is_array($_POST['pID']) && count($_POST['pID'])) {

            $pids = $_POST['pID'];

            switch (strtolower($fh->getRequestValue('product-operation'))) {
                case 'delete':
                    foreach ($pids as $pid) {
                        $product = $pl->fetchByID($pid);
                        $product->delete();
                    }
                    $this->redirect('/dashboard/shop/manage?p-deleted=1&t-multiple=' . count($pids));
                    break;
            }
        }

        // Save operation
        if ($fh->getRequestValue('save-products')) {
            // save display order
            if (isset($_POST['pDisplayOrder']) && is_array($_POST['pDisplayOrder']) && count($_POST['pDisplayOrder'])) {
                $pids = $_POST['pDisplayOrder'];
                foreach ($pids as $pid => $do) {
                    $product = $pl->fetchByID($pid);
                    $product->setDisplayOrder($do);
                    $product->save();
                }
            }
        }
    }

    public function getRequestedSearchResults() {
        $fh = Loader::helper('form');

        $pl = new ProductList();
        $pl->setItemsPerPage(20);
        $sortcolumn = $fh->getRequestValue('ccm_order_by') ? $fh->getRequestValue('ccm_order_by') : 'title';
        $sortdir = $fh->getRequestValue('ccm_order_dir') ? $fh->getRequestValue('ccm_order_dir') : 'asc';

        $columns = new ProductSearchDefaultColumnSet();
        $found = false;
        foreach ($columns->getSortableColumns() as $col) {
            if ($col->columnKey == $sortcolumn)
                $found = true;
        }
        if (!$found)
            $sortcolumn = 'title';

        $pl->sortBy($sortcolumn, $sortdir);
        $columns = ProductSearchColumnSet::getCurrent();
        $this->set('columns', $columns);

        return $pl;
    }

}
