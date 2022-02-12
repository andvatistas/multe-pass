<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"  href="../custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>
    <title>Multe-Pass Statistics</title>
  </head>
  <body>
    <!-- NavBar -->
    <?php include '../components/header.php';?>

    <h4 class = "d-flex justify-content-center m-3 p-1">Statistics Form</h4>
    <div class = "container d-flex justify-content-center" style = "padding-top:10px;">
      <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
        <div class = "form-inline">
          <label class = "label">Type of Statistics</label>
          <select class = "form-select" name = "type">
            <option name = "type" value = "operator">Passes Per Operator</option>
            <option name = "type" value = "station">Passes Per Station</option>
          </select>
        </div>
        <div class = "row row-cols-2" >
          <div class="form-group date" name = "datefrom" style = "padding-top:5px;">
            <label class="label">Period Start</label>
            <input type="date" class = "form-control" name = "datefrom" id="datepicker">
          </div>
          <div class="form-group date"name = "dateto" style = "padding-top:5px;">
            <label class="label">Period End</label>
            <input type="date" class = "form-control" name = "dateto" id="dateto">
          </div>
      </div>
        <div class = "d-flex justify-content-center" style = "padding-top:20px;">
          <button id = "main_button" type="submit" class="btn btn-primary">Send Request</button>
        </div>
    </form>
    </div>

    <?php
      include '../components/helpers.php';
      $host_ip = setAPIName();
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $type = $_POST["type"];
        $datefromraw =  date_create($_POST["datefrom"]);
        $datetoraw =  date_create($_POST["dateto"]);
        $datefrom = date_format($datefromraw,"Ymd");
        $dateto = date_format($datetoraw,"Ymd");
        $api_url = 'http://'.$host_ip.':9103/interoperability/api/stats/' . $type . '/' . $datefrom . '/' . $dateto . '/';
        $request_method = 'GET';
        $response = sendRequest($api_url, $request_method);
        $json_response = json_decode($response);

        if ($type == 'operator'){
        echo "<br>";
        echo "<div class = 'container d-flex justify-content-evenly'>
          <div class = 'card' style = 'padding:10px'>
            <div class = 'card-body d-flex align-self-center'>";
          if ($json_response == null){
            echo "<p>No Data Found! Check your Request Form!</p>";
            echo" </div>";
            echo" </div>";
            echo" </div>";
            }
            else{
            echo "
            <table class = 'passescosttable'>
              <thead>
                <tr>
                  <th>Operator</th>
                  <th>Passes of all Stations</th>
                </tr>
              </thead>";
              $op_foo = ' ';
              $pass_foo = ' ';
              foreach($json_response as $elem){
                echo "<tr>";
                echo "<td>".$elem->id ."</td>";
                echo "<td>".$elem->Count ."</td>";
                echo "</tr>";
                $op_foo = $op_foo. '"' . $elem->id . '",';
                $pass_foo = $pass_foo. '"' . $elem->Count . '",';
            }
            $op_list = substr($op_foo, 0, -1);
            $pass_list = substr($pass_foo, 0, -1);
            echo "</table>";
            echo" </div>";
            echo" </div>";
            echo "<div class = 'card'>";
            echo "<div class = 'card-body d-flex align-self-center' style= 'width:90%'>";
            echo "<div class = 'chart-container' style = 'width:500px;'>";
            echo "<canvas id='pieChart'></canvas>";
            echo" </div>";
            echo" </div>";
            echo" </div>";
            echo" </div>";
            echo "<br>";
          }

        echo "<script>";
        echo "
            var ctxP = document.getElementById('pieChart').getContext('2d');
            var myPieChart = new Chart(ctxP, {
              type: 'pie',
              data: {
                labels: [" . $op_list . "],
                datasets: [{
                  data: [" . $pass_list . "],
                  backgroundColor: ['#F7464A', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360', '#57F908', '#A20FB2'],
                  hoverBackgroundColor: ['#FF5A5E', '#5AD3D1', '#FFC870', '#A8B3C5', '#616774']
                }]
              },
              options: {
                responsive: true
              }
            });
            ";
          echo "</script>";
        }

      elseif ($type == 'station'){
        echo "<br>";
        echo "<div class = 'container d-flex justify-content-evenly'>
          <div class = 'row'>
            <div class = 'card'>
              <div class = 'card-body'>";
            if ($json_response == null){
              echo "<p>No Data Found! Check your form</p>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              }
              else{
              echo "
              <table class = 'passescosttable'>
                <thead>
                  <tr>
                    <th>Station ID</th>
                    <th>Passes of Station</th>
                  </tr>
                </thead>";
                $station_foo = ' ';
                $pass_foo = ' ';
                foreach($json_response as $elem){
                  echo "<tr>";
                  echo "<td>".$elem->id ."</td>";
                  echo "<td>".$elem->Count ."</td>";
                  echo "</tr>";
                  $station_foo = $station_foo. '"' . $elem->id . '",';
                  $pass_foo = $pass_foo. '"' . $elem->Count . '",';
              }
              $station_list = substr($station_foo, 0, -1);
              $pass_list = substr($pass_foo, 0, -1);
              echo "</table>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              echo "<div class = 'row' style = 'height:100%'>";
              echo "<div class = 'card'>
                <div class = 'card-body' style = 'width:90%;'>";
              echo "<div class = 'chart-container' style = 'width:800px;'>";
              echo "<canvas id='pieChart'></canvas>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              echo" </div>";
              echo "<br>";
              echo "<script>";
              echo "
                  var ctxP = document.getElementById('pieChart').getContext('2d');
                  var myPieChart = new Chart(ctxP, {
                    type: 'bar',
                    data: {

                      labels: [" . $station_list . "],
                      datasets: [{
                        label: 'Stations Name',
                        data: [" . $pass_list . "],
                        backgroundColor: '#F7464A',
                        hoverBackgroundColor: ['#FF5A5E', '#5AD3D1', '#FFC870', '#A8B3C5', '#616774']
                      }]
                    },
                    options: {
                      responsive: true
                    }
                  });
                  ";
                echo "</script>";
      }
    }
  }
      ?>


    <!-- Footer -->
    <?php include '../components/footer.php';?>

  </body>


</html>
