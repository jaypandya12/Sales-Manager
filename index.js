	document.getElementById("opt1").addEventListener("click", myFunction);

	function myFunction() {
  		$.ajax({
  			url: 'dbOperation.php',
  			type: 'POST',
  			success: function(html){
  				$('#showresult').html(html);
  			}
  		});
  		
	}
