<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pagination demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body class="bg-dark text-light">


  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto mt-5">

        <h3 class="mb-4">Pagination in PHP & MySQL</h3>

        <table class="table table-light table-striped">
          <thead>
            <tr>
              <th>Sr No.</th>
              <th>VALUES</th>
            </tr>
          </thead>
          <tbody>
            <?php 

              $con = mysqli_connect("localhost","root","","test");

              $query_all = "SELECT * FROM `data`";
              $result_all = mysqli_query($con,$query_all);

              $total_records = mysqli_num_rows($result_all);

              if($total_records == 0){
                echo"<tr><td colspan='2'>No records found!</td></tr>";
                exit;
              }

              $limit = 5;
              $page = 1;

              if(isset($_GET['page'])){
                $page = $_GET['page'];
              }

              $start = ($page-1) * $limit;

              $query_limit = "SELECT * FROM `data` LIMIT $start,$limit";
              $result_limit = mysqli_query($con,$query_limit);

              $i=$start+1;
              while($data = mysqli_fetch_assoc($result_limit))
              {
                echo"<tr>
                  <th>$i</th>
                  <td>$data[name]</td>
                </tr>";
                $i++;
              }
            
            ?>
          </tbody>
        </table>

        <?php 

          $total_pages = ceil($total_records / $limit);

          echo "<h6>Pages: $page/$total_pages</h6>";

          $pagination="<nav>
            <ul class='pagination'>";

          if($total_records>$limit)
          {
            $disabled = ($page==1) ? "disabled" : "";
            $prev = $page-1;

            $pagination .="<li class='page-item $disabled'>
              <a class='page-link' href='?page=1'>First</a>
            </li>";
            $pagination .="<li class='page-item $disabled'>
              <a class='page-link' href='?page=$prev'>Prev</a>
            </li>";


            $disabled = ($page==$total_pages) ? "disabled" : "";
            $next = $page+1;

            $pagination .="<li class='page-item $disabled'>
              <a class='page-link' href='?page=$next'>Next</a>
            </li>";
            $pagination .="<li class='page-item $disabled'>
              <a class='page-link' href='?page=$total_pages'>Last</a>
            </li>";
          }
          

          $pagination .="</ul></nav>";
        
          echo $pagination;
        ?>

      </div>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>