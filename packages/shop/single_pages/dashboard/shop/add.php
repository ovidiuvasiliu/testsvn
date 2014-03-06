<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$dh = Loader::helper('form/date_time');
$al = Loader::helper('concrete/asset_library');
$bf = null;
?>

<?php if($pID): ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Edit Produs'), false, false, false);?>
<?php else: ?>
<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Add Produs'), false, false, false);?>
<?php endif ?>

<form method="post" enctype="multipart/form-data" id="ccm-produs-form" action="<?php echo $this->url('/dashboard/shop/add')?>">

    <div class="ccm-pane-body">

        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="table">
            <thead>
            <tr>
                <th colspan="2"><?php echo t('Produs Information')?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo t('Title')?> <span class="required">*</span></td>
                <td><?php echo t('Description')?> <span class="required">*</span></td>
            </tr>
            <tr>
                <td><input type="text" name="title" autocomplete="off" value="<?php echo $th->entities($product->getTitle())?>" style="width: 95%"></td>
                <td><input type="text" autocomplete="off" name="description" value="<?php echo $th->entities($product->getDescription())?>" style="width: 95%"></td>
            </tr>

            <tr>
                <td><?php echo t('Price')?></td>
                <td><input type="text" name="price" autocomplete="off" value="<?php echo $th->entities($product->getPrice())?>" style="width: 95%"></td>
            </tr>
            <tr>
                 <td><?php echo t('Image')?></td>
                <td><?php echo $al->image('ccm-b-image', 'fID', t('Choose Image'), $bf);?></td>
            </tr>
            
            </tbody>
        </table>
    </div>

    <div class="ccm-pane-footer">
        <div class="ccm-buttons">
            <?php if($pID): ?>
            <input type="hidden" name="pID" value="<?php echo $pID ?>" />
            <?php endif ?>
            <input type="hidden" name="save" value="1" />
            <?php  print $ih->submit(t('Save Product'), 'ccm-product-form', 'right', 'primary'); ?>
            <?php  print $ih->submit(t('Save &amp; Add Another'), 'ccm-product-add-another', 'right', 'primary'); ?>
            <?php if($product->getID()): ?>
            <?php  print $ih->submit(t('Delete Product'), 'ccm-product-delete', 'left', 'danger'); ?>
            <?php endif ?>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function(){
        $('#ccm-submit-ccm-product-delete').click(function(){
            return confirm("<?php echo t('Are you sure you want to delete this product?') ?>");
        });
    });
</script>

<?php echo Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false);
