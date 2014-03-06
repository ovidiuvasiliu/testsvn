<?php  
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>
	
	<div class="clear"></div>

	<div id="main-content-container" class="grid_24">
		<div id="main-content-inner">
		    
            <a href="#" id="click">Click here</a>
            <br />
            
			<?php  
            
            $url = Loader::helper('concrete/urls')->getToolsURL('request');
            
            echo t('TestTranslate!');
            
			$a = new Area('Main');
			$a->display($c);
			?>
			
		</div>
	
	</div>
	
	<!-- end full width content area -->
    
    <script type="text/javascript">
        $(function(){
            $('#click').click( function(){
                $.ajax({
                    //dataType: 'json',
                    url: '<?= $url ?>',
                    data: {
                        param: 1
                    },
                    success: function(data){
                        console.log( data );
                    }
                });

                return false;                
            } );
        });
    </script>
	
<?php  $this->inc('elements/footer.php'); ?>
