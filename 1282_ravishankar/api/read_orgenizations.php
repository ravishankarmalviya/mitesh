<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$policies = [];
$sql = "SELECT id, name FROM organization";
$output_array = array();
if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
   
	$output_array[] = array( 'id' => $row['id'], 'name' => $row['name'] );
	
	
    $i++;
  }

  echo json_encode($output_array, TRUE);
}
else
{
  http_response_code(404);
}