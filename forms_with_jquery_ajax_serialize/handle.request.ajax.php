<?php
if (is_ajax()) {
  if (isset($_POST["action"]) && !empty($_POST["action"])) { //Checks if action value exists
    $action = $_POST["action"];
    switch($action) { //Switch case for value of action
      case "example": test_function(); break;
    }
  }
}

function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function test_function(){
  $return = $_POST;
  
  if ($return["FirstName"] == ""){
   $return["FirstName"] = "Mickey";
  }
  if ($return["SecondName"] == ""){
    $return["SecondName"] = "Mouse";
  }
  
  $return["json"] = json_encode($return);
  echo json_encode($return);
}
?>