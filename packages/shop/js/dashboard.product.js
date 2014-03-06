ccm_setupProductSearch = function() {
	$(".chosen-select").chosen();

	$("#ccm-product-list-cb-all").click(function() {
		if ($(this).prop('checked') == true) {
			$('.ccm-list-record td.ccm-product-list-cb input[type=checkbox]').attr('checked', true);
			$("#ccm-product-list-multiple-operations").attr('disabled', false);
		} else {
			$('.ccm-list-record td.ccm-product-list-cb input[type=checkbox]').attr('checked', false);
			$("#ccm-product-list-multiple-operations").val('').attr('disabled', true);
			$('#operate-products').attr('disabled',true);	
		}
	});
	$("td.ccm-product-list-cb input[type=checkbox]").click(function(e) {
		if ($("td.ccm-product-list-cb input[type=checkbox]:checked").length > 0) {
			$("#ccm-product-list-multiple-operations").attr('disabled', false);
		} else {
			$("#ccm-product-list-multiple-operations").val('').attr('disabled', true);
			$('#operate-products').attr('disabled',true);	
		}
	});



	$("#ccm-product-list-multiple-operations").change(function() {
		$this	=	$(this);
		var action = $this.val();
		

		pIDstring = '';
		pIDobj	=	[];
		$("td.ccm-product-list-cb input[type=checkbox]:checked").each(function() {
			pIDstring=pIDstring+'&pID[]='+$(this).val();
			pIDobj.push($(this).val());
		});
		
		var dataForRequest		=	productURLParams;
		dataForRequest['action']	=	action;
		dataForRequest['pID']		=	pIDobj;
		
		
		switch(action) {
			case 'delete':								
						                                
                                $('#operate-products').removeAttr('disabled');
				break;
			
			default:
				$('#operate-products').attr('disabled',true);	
		}
		return false;		
	});


}