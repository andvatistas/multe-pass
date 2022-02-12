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
    <title>Multe-Pass Settlements</title>
  </head>
  <body>
    <!-- NavBar -->
    <?php include '../components/header.php';?>

    <!-- Title -->
    <h4 class = "d-flex justify-content-center m-3 p-1">Settlements Form</h4>

    <!-- Form Container -->
    <div class = "container d-flex justify-content-center" style = "padding-top:10px;">
      <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
        <div class = "form-inline" style = "width:100%;">
          <label class="label">Operator 1</label>
          <select class = "form-select" name = "op1">
            <option style = "display:none"></option>
            <option name = "op1" value = "aodos">Attikh Odos</option>
            <option name = "op1" value = "egnatia">Egnatia Odos</option>
            <option name = "op1" value = "gefyra">Gefyra</option>
            <option name = "op1" value = "nea_odos">Nea Odos</option>
            <option name = "op1" value = "olympia_odos">Olympia Odos</option>
            <option name = "op1" value = "moreas">Moreas</option>
            <option name = "op1" value = "kentriki_odos">Kentriki Odos</option>
          </select>
        </div>
        <div class = "form-inline">
          <label class="label">Operator 2</label>
          <select class = "form-select" name = "op2" style = "width:100%;">
            <option style = "display:none"></option>
            <option name = "op2" value = "aodos">Attikh Odos</option>
            <option name = "op2" value = "egnatia">Egnatia Odos</option>
            <option name = "op2" value = "gefyra">Gefyra</option>
            <option name = "op2" value = "nea_odos">Nea Odos</option>
            <option name = "op2" value = "olympia_odos">Olympia Odos</option>
            <option name = "op2" value = "moreas">Moreas</option>
            <option name = "op2" value = "kentriki_odos">Kentriki Odos</option>
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
      $op1 = $_POST["op1"];
      $op2 = $_POST["op2"];
      $datefromraw =  date_create($_POST["datefrom"]);
      $datetoraw =  date_create($_POST["dateto"]);
      $datefrom = date_format($datefromraw,"Ymd");
      $dateto = date_format($datetoraw,"Ymd");

      if (($op1 == '') || ($op2 == '') || ($datefrom == '') || ($dateto == '')){
        echo "<div class = 'container d-flex justify-content-center'>
                <div class = 'card'>
                  <div class = 'card-body'>
                    <p> Please input data into every form!</p>";
                    echo" </div>";
                    echo" </div>";
                    echo" </div>";
      }
        else {
          $ps_url1 = 'http://'.$host_ip.':9103/interoperability/api/passescost/' . $op1 . '/' . $op2 . '/' . $datefrom . '/' . $dateto . '/';
          $ps_url2 = 'http://'.$host_ip.':9103/interoperability/api/passescost/' . $op2 . '/' . $op1 . '/' . $datefrom . '/' . $dateto . '/';
          $pa_url1 = 'http://'.$host_ip.':9103/interoperability/api/passesanalysis/' . $op1 . '/' . $op2 . '/' . $datefrom . '/' . $dateto . '/';
          $pa_url2 = 'http://'.$host_ip.':9103/interoperability/api/passesanalysis/' . $op2 . '/' . $op1 . '/' . $datefrom . '/' . $dateto . '/';
          $request_method = 'GET';

          $ps_response1 = json_decode(sendRequest($ps_url1, $request_method));
          $ps_response2 = json_decode(sendRequest($ps_url2, $request_method));
          $pa_response1 = json_decode(sendRequest($pa_url1, $request_method));
          $pa_response2 = json_decode(sendRequest($pa_url2, $request_method));

          echo "<div class = 'container d-flex - justify-content-evenly p-3'>
                  <div class = 'card' style = 'padding:10px'>
                    <div class = 'card-body'>";

          if (($ps_response1 == null) || ($ps_response2 == null) || ($pa_response1 == null) || ($ps_response2 == null)){
            echo "<p>No Data Found! Check your query</p>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
          }
          else {
            echo "<h4>Settlement Analysis: </h4>";
            echo "<p>" . $ps_response1->op2_ID . " owes " . $ps_response1->op1_ID . " " .$ps_response1->PassesCost;
            echo "<p>" . $ps_response2->op2_ID . " owes " . $ps_response2->op1_ID . " " .$ps_response2->PassesCost;
            echo "<h5>Total: </h5>";
            if ($ps_response1->PassesCost > $ps_response2->PassesCost) {
              $total = floatval($ps_response1->PassesCost) - floatval($ps_response2->PassesCost);
              echo "<p>" . $ps_response1->op2_ID . " owes " . $ps_response1->op1_ID . " " .$total;
            }
            elseif ($ps_response1->PassesCost < $ps_response2->PassesCost){
              $total = floatval($ps_response2->PassesCost) - floatval($ps_response1->PassesCost);
              echo "<p>" . $ps_response2->op2_ID . " owes " . $ps_response2->op1_ID . " " .$total;
            }
            else {
              echo "<p>No need for a Settlement to be made!</p>";
            }
            echo "</div>";
            echo "</div>";

            echo "<br>";

            echo "
              <div class = 'card' style = 'padding:10px'>
                <div class = 'card-body'>
                  <table class = 'passescosttable'>
                    <thead>
                      <tr>
                        <th>Pass Index</th>
                        <th>PassID</th>
                        <th>Station ID</th>
                        <th>TimeStamp</th>
                        <th>VehicleID</th>
                        <th>Charge</th>
                      </tr>
                    </thead>";
              foreach($pa_response1->PassesList as $elem){
                echo "<tr>";
                echo "<td>".$elem->PassIndex ."</td>";
                echo "<td>".$elem->PassID ."</td>";
                echo "<td>".$elem->StationID ."</td>";
                echo "<td>".$elem->TimeStamp ."</td>";
                echo "<td>".$elem->VehicleID ."</td>";
                echo "<td>".$elem->Charge ."</td>";
                echo "</tr>";
                }
                echo "<tr>";
                echo "<td> --- </td>";
                echo "<td> --- </td>";
                echo "<td> --- </td>";
                echo "<td> --- </td>";
                echo "<td> --- </td>";
                echo "<td> --- </td>";
                echo "</tr>";
              foreach($pa_response2->PassesList as $elem){
                echo "<tr>";
                echo "<td>".$elem->PassIndex ."</td>";
                echo "<td>".$elem->PassID ."</td>";
                echo "<td>".$elem->StationID ."</td>";
                echo "<td>".$elem->TimeStamp ."</td>";
                echo "<td>".$elem->VehicleID ."</td>";
                echo "<td>".$elem->Charge ."</td>";
                echo "</tr>";
                }

              echo "</table>";
              echo "</div>";
              echo "</div>";
              echo "</div>";

          }
      }
    }
      ?>

    <!-- Footer -->
    <?php include '../components/footer.php';?>

  </body>


</html>
