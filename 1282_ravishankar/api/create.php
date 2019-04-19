<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);
	
  // Validate.
  

  // Sanitize.
  $orgname = implode(',',$request->orgname);
  $dateoftraining = mysqli_real_escape_string($con,$request->dateoftraining);
  $placeoftraning = mysqli_real_escape_string($con, trim($request->placeoftraning));
  $purposeoftraining = mysqli_real_escape_string($con,$request->purposeoftraining);
  $employee = implode(',',$request->employee) ;//mysqli_real_escape_string($con, trim($request->employee));
  


  // Create.
  $sql = "INSERT INTO `empmanagment`(`id`,`orgname`,`dateoftraining`,`placeoftraning`,`purposeoftraining`,`employee`) VALUES (null,'{$orgname}','{$dateoftraining}','{$placeoftraning}','{$purposeoftraining}','{$employee}')";
  
  

  if(mysqli_query($con,$sql))
  {
    http_response_code(201);
    $policy = [
      'orgname' => $orgname,
      'dateoftraining' => $dateoftraining,
	  'placeoftraning' => $placeoftraning,
      'purposeoftraining' => $purposeoftraining,
	  'employee' => $employee,
      'id'    => mysqli_insert_id($con)
    ];
    echo json_encode($policy);
  }
  else
  {
    http_response_code(422);
  }
}