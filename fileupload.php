<?php
if(isset($_POST['modelSubmit'])){
copy($_FILES['jsonFile']['tmp_name'],'files/'.$_FILES['jsonFile']['name']);
$strJsonFileContents = file_get_contents('files/'.$_FILES['jsonFile']['name']);
$array = json_decode($strJsonFileContents, true);
$conn = mysqli_connect("localhost","root","","assignment") or die("Connection failed");
foreach ($array as $key => $value) {
  $query = "INSERT INTO `events`(`participation_id`, `employee_name`, `employee_mail`, `event_id`, `event_name`, `participation_fee`,`event_date`) 
                    VALUES 
                  ('".$value['participation_id']."','".$value['employee_name']."','".$value['employee_mail']."','".$value['event_id']."','".$value['event_name']."','".$value['participation_fee']."','".$value['event_date']."')";
  mysqli_query($conn,$query);
}
mysqli_close($conn);
header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
