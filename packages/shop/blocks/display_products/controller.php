<?php defined('C5_EXECUTE') or die(_("Access Denied."));
	
class DisplayProductsBlockController extends BlockController {
	
	protected $btTable = "btDisplayProducts";
	protected $btInterfaceWidth = "350";
	protected $btInterfaceHeight = "300";

	public function getBlockTypeName() {
		return t('Display products');
	}

	public function getBlockTypeDescription() {
		return t('Display products');
	}
}
