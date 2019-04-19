<?php
require 'database.php';

// Get the posted data.
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
  // Extract the data.
  $request = json_decode($postdata);

  // Validate.
  if ((int)$request->id < 1 ) {
    return http_response_code(400);
  }

  // Sanitize.
  $id    = mysqli_real_escape_string($con, (int)$request->id); 
  $orgname = implode(',',$request->orgname);
  $dateoftraining = mysqli_real_escape_string($con,$request->dateoftraining);
  $placeoftraning = mysqli_real_escape_string($con, trim($request->placeoftraning));
  $purposeoftraining = mysqli_real_escape_string($con,$request->purposeoftraining);
  $employee = implode(',',$request->employee) ;

  // Update.
  $sql = "UPDATE `empmanagment` SET `orgname`='$orgname',`dateoftraining`='$dateoftraining',`placeoftraning`='$placeoftraning',`purposeoftraining`='$purposeoftraining',`employee`='$employee' WHERE `id` = '{$id}' LIMIT 1";

  echo $sql;
  if(mysqli_query($con, $sql))
  {
    http_response_code(204);
  }
  else
  {
    return http_response_code(422);
  }  
}