<?php

  $conn = mysqli_connect("localhost","root","","assignment") or die("Connection failed");

  $limit_per_page = 5;

  $page = "";


    if(isset($_POST["page_no"])){
      $page = $_POST["page_no"];
    }else{
      $page = 1;
    }

    $offset = ($page - 1) * $limit_per_page;

    $sql = "SELECT * FROM events LIMIT {$offset},{$limit_per_page}";
    $result = mysqli_query($conn,$sql) or die("Query Unsuccessful.");



  $output= "";
  if(mysqli_num_rows($result) > 0){
    $output .= '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
      <tr>
                <th scope="col">Id</th>
                <th scope="col">Participation Id</th>
                <th scope="col">Employee Name</th>
                <th scope="col">Employee Mail</th>
                <th scope="col">Event Id</th>
                <th scope="col">Event Name</th>
                <th scope="col">Participation Fee</th>
                <th scope="col">Event Date</th>
      </tr>';
    $total=0;
    $row_cn=0;
      while($row = mysqli_fetch_assoc($result)) {
        $total +=$row["participation_fee"];
        $row_cn++;
        $output .= "<tr><td align='center'>{$row["id"]}</td><td>{$row["participation_id"]}</td><td>{$row["employee_name"]}</td><td>{$row["employee_mail"]}</td><td>{$row["event_id"]}</td><td>{$row["event_name"]}</td><td>{$row["participation_fee"]}</td><td>{$row["event_date"]}</td></tr>";

      }
    $output .= "<tr><td align='center' colspan='2'>Number Of Rows   </td><td> {$row_cn}</td><td colspan='2'>Total Fee</td><td colspan='2'>{$total}</td><td colspan='2'></td></tr>";

    $output .= "</table>";

    $sql_total = "SELECT * FROM events";
    $records = mysqli_query($conn,$sql_total) or die("Query Unsuccessful.");
    $total_record = mysqli_num_rows($records);
    $total_pages = ceil($total_record/$limit_per_page);

    $output .='<div id="pagination">';


    for($i=1; $i <= $total_pages; $i++){
      if($i == $page){
        $class_name = "active";
      }else{
        $class_name = "";
      }
      $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
    }
    $output .='</div>';

    echo $output;
  }else{
    echo "<h2>No Record Found.</h2>";
  }
?>
