$(document).ready(function() {
		$(".various").fancybox({
			maxWidth	: 800,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
	$(document).ready(function() {
    $('.outputtable').DataTable( {
        dom: 'Bfrtip',
        'destroy': true,
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
	$('.deletecategory').click(function(event){
		$(this).closest('tr').remove();
	});
	