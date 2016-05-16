<?php
	
// FUNCTIONS
function idToName($con, $table, $id)
{
	$query = mysqli_query($con, "SELECT ad FROM $table WHERE id='$id'");
	$item = mysqli_fetch_object($query);
	echo $item->ad;
}
// FUNCTIONS / end
?>