<?php
$internal_ggrc_id = $_GET['id'];

$total = $_GET['total'];
$per_row = $_GET['per_row'];

echo "<table><tr>";
for($i = 0; $i < $total; $i++) {
	if( $i % $per_row == 0 ) {
		echo "</tr><tr>";
		echo '<td><img alt='.$internal_ggrc_id.' src="http://localhost:8080/Invoice%20generator/barcode.php?text='.$internal_ggrc_id.'&print=true" /></td>';
	} else {
		echo '<td><img alt='.$internal_ggrc_id.' src="http://localhost:8080/Invoice%20generator/barcode.php?text='.$internal_ggrc_id.'&print=true" /></td>';		
	}
}
echo "</tr></table>";
?>