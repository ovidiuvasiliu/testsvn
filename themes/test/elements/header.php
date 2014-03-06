<?php   defined('C5_EXECUTE') or die("Access Denied."); ?>
<?
    $pkgMultilingual = Package::getByHandle('multilingual');
    if($pkgMultilingual){
        $ms = MultilingualSection::getCurrentSection();
        if( is_object($ms) ){
            $_SESSION['c5Language'] = $ms->getLanguage().'_'.$ms->getIcon();
        }
    }

?>
<!DOCTYPE html>
<html lang="<?php echo LANGUAGE?>">

<head>

<?php   Loader::element('header_required'); ?>

<!-- Site Header Content //-->

<link rel="stylesheet" href="<?php  echo $this->getThemePath(); ?>/css/reset.css" />
<link rel="stylesheet" href="<?php  echo $this->getThemePath(); ?>/css/text.css" />
<link rel="stylesheet" href="<?php  echo $this->getThemePath(); ?>/css/960_24_col.css" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('main.css')?>" />
<link rel="stylesheet" media="screen" type="text/css" href="<?php  echo $this->getStyleSheet('typography.css')?>" />
<link href='//fonts.googleapis.com/css?family=Merriweather:400,700,900,300' rel='stylesheet' type='text/css' />


</head>

<body>

<!--start main container -->

<div id="main-container" class="container_24">

	<div id="header">
	
	
		<?php  
		$a = new GlobalArea('Site Name');
		$a->display();
		?>

		<?php  
		$a = new GlobalArea('Header Nav');
		$a->display();
		?>
		
		<div id="header-image">
		
			<?php  
			$a = new Area('Header Image');
			$a->display($c);
			?>
		
		</div>
		
	</div>
	
	<div class="clear"></div>
