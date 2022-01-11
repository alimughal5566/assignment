
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Assignment</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  <div id="main">

    <div id="header">
      <h1>Assignment</h1>
    </div>


      <div id="search">
          <div id="myModal" class="modal">
              <form action="fileupload.php" method="post" enctype="multipart/form-data">
              <!-- Modal content -->
              <div class="modal-content">
                  <span class="close">&times;</span>
                  <label for="dataFile">Upload json file Please</label>
                  <input type="file" name="jsonFile" id="jsonFile">
                  <button type="submit" name="modelSubmit">Submit</button>
              </div>
              </form>
          </div>
          <form id="search_form">
          <select name="search_by" id="search_by" ">
              <option value="all" >All</option>
              <option value="employee_name">Name</option>
              <option value="employee_mail">Email</option>
              <option value="event_name">Event Name</option>
              <option value="participation_fee">Participation Fee</option>
              <option value="event_date">Event Data</option>
          </select>
          <input type="text" name="search_value"  id="search_value" placeholder="Enter Word">
              <button type="submit">Search</button>
          </form>
          <button id="myBtn">upload</button>

      </div>
    <div id="table-data">
    </div>
  </div>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
      $(document).ready(function() {

      $(document).on("change","#search_by",function() {
          // alert('dasdad');
          let val= $("#search_by").val();
        if (val === 'event_date'){
            $('#search_value').attr('type','date');
        }else {
            $('#search_value').attr('type','text');

        }

    });

        function loadTable(page){
      $.ajax({
        url: "" +
            "pagination.php",
        type: "POST",
        data: {page_no :page },
        success: function(data) {
          $("#table-data").html(data);
        }
      });
    }
        loadTable();

    //Pagination Code
    $(document).on("click","#pagination a",function(e) {
      e.preventDefault();
      var page_id = $(this).attr("id");

      loadTable(page_id);
    })
      $("#search_form").on("submit",function(e) {
          e.preventDefault()
          var search=$("#search_value").val();
          var search_by=$("#search_by").val();

              $.ajax({
                  url: "filter.php",
                  type: "GET",
                  data: {search :search,search_by:search_by},
                  success: function(data) {
                      $("#table-data").html(data);
                  },
                  error: function(XMLHttpRequest, errorThrown) {
                      alert("Error: " + errorThrown);
                  }
              });

      })
  });
</script>

  <script>
// model element
      var modal = document.getElementById("myModal");
      var btn = document.getElementById("myBtn");
      var span = document.getElementsByClassName("close")[0];
      btn.onclick = function() {
          modal.style.display = "block";
      }
      span.onclick = function() {
          modal.style.display = "none";
      }
      window.onclick = function(event) {
          if (event.target == modal) {
              modal.style.display = "none";
          }
      }
  </script>
</body>





</html>
