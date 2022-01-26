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
    <title>Multe-Pass Passes Analysis</title>
  </head>

  <body>
    <?php include '../components/header.php';?>

<h4 class = "d-flex justify-content-center m-3 p-1">Charges By Form</h4>
<div class = "container d-flex justify-content-center" >
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
    <div class = "form-inline" style = "width:100%;">
      <label class="label">Operator</label>
      <select class = "form-select" name = "op">
        <option style = "display:none"></option>
        <option name = "op" value = "aodos">Attikh Odos</option>
        <option name = "op" value = "egnatia">Egnatia Odos</option>
        <option name = "op" value = "gefyra">Gefyra</option>
        <option name = "op" value = "nea_odos">Nea Odos</option>
        <option name = "op" value = "olympia_odos">Olympia Odos</option>
        <option name = "op" value = "moreas">Moreas</option>
        <option name = "op" value = "kentriki_odos">Kentriki Odos</option>
      </select>
    </div>
    <div class = "row row-cols-2" >
      <div class="form-group date" name = "datefrom" style = "padding-top:5px;">
        <label class="label">Period Start</label>
        <input type="date" class = "form-control" name = "datefrom" id="datepicker">
      </div>
      <div class="form-group date"name = "dateto" style = "padding-top:5px;">
        <label class="label">Period End</label>
        <input type="date" class = "form-control" name = "dateto" id="datepicker">
      </div>
  </div>
  <div class = "d-flex justify-content-center" style = "padding-top:20px;">
    <button type="submit" class="btn btn-primary">Send Request</button>
  </div>
</form>
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();
    $op = $_POST["op"];
    $datefromraw =  date_create($_POST["datefrom"]);
    $datetoraw =  date_create($_POST["dateto"]);
    $datefrom = date_format($datefromraw,"Ymd");
    $dateto = date_format($datetoraw,"Ymd");

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:9103/interoperability/api/chargesby/' . $op . '/' . $datefrom . '/' . $dateto . '/',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
  ));
  $response = curl_exec($curl);
  curl_close($curl);
  $json_response = json_decode($response);
  }?>

  <br>
  <?php   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($op == '') || ($datefrom == '') || ($dateto == '')){
      echo "<div class = 'container d-flex justify-content-center'>
              <div class = 'card'>
                <div class = 'card-body'>
                  <p> Please input data into every form!</p>";
                  echo" </div>";
                  echo" </div>";
                  echo" </div>";
    }
    else {
    echo "<div class = 'container d-flex justify-content-center'>
      <div class = 'card' style = 'padding:10px'>
        <div class = 'card-body'>
          <table class = 'passescosttable'>
            <thead>
              <tr>
                <th>Operator</th>
                <th>Request Timestamp</th>
                <th>Period From</th>
                <th>Period To</th>
              </tr>
            </thead>";

          echo "<tr>";
          echo "<td>".$json_response->op_ID."</td>";
          echo "<td>".$json_response->RequestTimestamp."</td>";
          echo "<td>".$json_response->PeriodFrom."</td>";
          echo "<td>".$json_response->PeriodTo."</td>";
          echo "</tr>";
          echo "</table>";
          echo" </div>";
          echo" </div>";
          echo" </div>";
        }
      }?>
        <br>
  <!-- Footer -->
  <?php include '../components/footer.php';?>

    </body>


  </html>
