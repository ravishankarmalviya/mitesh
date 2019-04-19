<?php
/**
 * Returns the list of policies.
 */
require 'database.php';

$policies = [];
$sql = "SELECT id, orgname, dateoftraining,placeoftraning,purposeoftraining,employee  FROM empmanagment";
$output_array = array();
if($result = mysqli_query($con,$sql))
{
  $i = 0;
  while($row = mysqli_fetch_assoc($result))
  {
    /*$policies[$i]['id']    = $row['id'];
    $policies[$i]['title'] = $row['number'];
    $policies[$i]['category'] = $row['amount'];
	$policies[$i]['writer'] = "Suraj";*/
	$output_array[] = array( 'id' => $row['id'], 'orgname' => explode(",",$row['orgname']), 'dateoftraining' => $row['dateoftraining'], 'placeoftraning' => $row['placeoftraning'] , 'purposeoftraining' => $row['purposeoftraining'],'employee' => explode(",",$row['employee']));
	
	
    $i++;
  }

  echo json_encode($output_array, TRUE);
}
else
{
  http_response_code(404);
}