<?php  defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php
    $txt = Loader::helper('text');
    $uh    = Loader::helper('concrete/urls');
    $fh	=	Loader::helper('form');
?>

<div id="ccm-user-search-results">

<?php  if ($searchType == 'DASHBOARD') { ?>

<div class="ccm-pane-body">

<?php  } ?>

<?php

    if (!$searchType) {
        $searchType = $_REQUEST['searchType'];

    }

    $soargs = array();
    $soargs['searchType'] = $searchType;
    $searchInstance = 'product';

    ?>

    <?php  if ($searchType == 'DASHBOARD'): ?>
    <form action="<?php echo $this->url('/dashboard/shop/manage') ?>" method="post">
     <?php endif ?>

<div id="ccm-list-wrapper"><a name="ccm-<?php echo $searchInstance?>-list-wrapper-anchor"></a>

    <div style="margin-bottom: 10px">
        <?php  $form = Loader::helper('form'); ?>

        <a href="<?php echo View::url('/dashboard/shop/add')?>" style="float: right" class="btn primary"><?php echo t("Add Product")?></a>

    </div>

    <?php

    $keywords = $_REQUEST['keywords'];
    $uh->getToolsURL('search_results','shop');

    if (count($products) > 0) { ?>
        <table border="0" cellspacing="0" cellpadding="0" id="ccm-product-list" class="ccm-results-list">
        <tr>
            <th width="1"><input id="ccm-product-list-cb-all" type="checkbox" /></th>
            <?php  foreach ($columns->getColumns() as $col) { ?>
                <?php  if ($col->isColumnSortable()) { ?>
                    <th class="<?php echo $productList->getSearchResultsClass($col->getColumnKey())?>"><a href="<?php echo $productList->getSortByURL($col->getColumnKey(), $col->getColumnDefaultSortDirection(), $bu, $soargs)?>"><?php echo $col->getColumnName()?></a></th>
                <?php  } else { ?>
                    <th><?php echo $col->getColumnName()?></th>
                <?php  } ?>
            <?php  } ?>

        </tr>
    <?php
        foreach ($products as $prod) {
            $action = View::url('/dashboard/shop/add?pID=' . $prod->getProductID());

            if ($mode == 'choose_one' || $mode == 'choose_multiple') {
                $action = 'javascript:void(0); ccm_triggerSelectProduct(' . $prod->getProductID() . '); jQuery.fn.dialog.closeTop();';
            }

            if (!isset($striped) || $striped == 'ccm-list-record-alt') {
                $striped = '';
            } elseif ($striped == '') {
                $striped = 'ccm-list-record-alt';
            }

            ?>

            <tr class="ccm-list-record <?php echo $striped?>">
            <td class="ccm-product-list-cb" style="vertical-align: middle !important"><input name="tID[]" type="checkbox" value="<?php echo $prod->getProductID() ?>" /></td>
            <?php  foreach ($columns->getColumns() as $col) { ?>
                <?php  if ($col->getColumnKey() == 'title') { ?>
                    <td><a href="<?php echo $action?>"><?php echo $prod->getTitle()?></a></td>
                               <?php  } elseif ($col->getColumnKey() == 'title') { ?>
                                        <td><input name="pDisplayOrder[<?php echo $prod->getProductID() ?>]" type="text" value="<?php echo $prod->getDisplayOrder() ?>" /></td>
                <?php  } else { ?>
                    <td><?php echo $col->getColumnValue($prod)?></td>
                <?php  } ?>
            <?php  } ?>

            </tr>
            <?php
        }

    ?>

    </table>
  

    <?php  } else { ?>

        <div id="ccm-list-none"><?php echo t('No products found.')?></div>

    <?php  }  ?>

</div>

    <?php  if ($searchType == 'DASHBOARD'): ?>
    </form>
    <?php endif ?>

<?php
    $productList->displaySummary();
?>

<?php  if ($searchType == 'DASHBOARD') { ?>
</div>

<div class="ccm-pane-footer">
    <?php  	$productList->displayPagingV2($bu, false, $soargs); ?>
</div>

<?php  } else { ?>
    <div class="ccm-pane-dialog-pagination">
        <?php  	$productList->displayPagingV2($bu, false, $soargs); ?>
    </div>
<?php  } ?>

</div>

<script type="text/javascript">
var productSearchURL	=	'<?php echo $uh->getToolsURL('search_results','shop');  ?>';
var productURLParams	=	{};
<?php foreach ($_GET as $k => $v): ?>
    productURLParams['<?php echo $k ?>']	=	'<?php echo $v ?>';
<?php endforeach; ?>
$(function() {
    ccm_setupProductSearch();
});
</script>
