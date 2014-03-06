<?php  defined('C5_EXECUTE') or die(_("Access Denied."));
$ih = Loader::helper("interface/flag", 'multilingual');
?>
<div class="ccm-multilingual-switch-language-flags">
	<div class="ccm-multilingual-switch-language-flags-label"><?php  echo $label?></div>
<?php  foreach($languageSections as $ml) { ?>
	<a href="<?php  echo $action?>?ccmMultilingualChooseLanguage=<?php  echo $ml->getCollectionID()?>&ccmMultilingualCurrentPageID=<?php  echo $cID?>" class="<?php  if ($activeLanguage == $ml->getCollectionID()) { ?>ccm-multilingual-active-flag<?php  } ?>"><?php 
		print $ih->getSectionFlagIcon($ml);	
	?></a>
<?php  } ?>
</div>