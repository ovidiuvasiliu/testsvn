<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Shop'), t('Manage products.'), false, false);?>

<?php  Loader::packageElement('search_results', 'shop' ,array('columns' => $columns, 'searchInstance' => $searchInstance, 'searchType' => 'DASHBOARD', 'products' => $products, 'productList' => $productList, 'pagination' => $pagination)); ?>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
