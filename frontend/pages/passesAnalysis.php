<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="stylesheet" type = "text/css" href="../custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <title>Multe-Pass About Page</title>
  </head>

  <body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand navbar-dark" style="background-color: #5b0ba1">
    <div class="container-fluid">
      <img src = "icons/logo_512px.png" width = "40" height = "40">
      <a class="navbar-brand" href="/../index.php">Multe-Pass</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Passes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="passesAnalysis.php">Passes Analysis</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Charges By</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Passes Cost</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <li class ="nav-item">
              <a class="nav-link active" aria-current="page" href="pages/about.php">About</a>
          </li>
      </div>
    </div>
  </nav>

  <div class="b-example-divider"></div>


<div class = "container align-items-center">
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
  <div class = "row row-space">
    <div class = "col-2" style ="width: 350px;">
    <div class = "form-inline">
      <label class="label">Operator 1</label>
      <select class = "form-control" name = "op1">
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
    <div class="input-group date" name = "datefrom" style = "padding-top:5px;">
      <label class="label">Date</label>
      <input type="text" class = "form-control" name = "datefrom" id="datepicker">
    </div>
  </div>
  <div class = "col-2" style ="width: 350px;">
    <div class = "form-inline form-check-inline">
      <label class="label">Operator 2</label>
      <select class = "form-control" name = "op2">
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
    <div class="form-group date"name = "dateto" style = "padding-top:5px;">
      <label class="label">Date</label>
      <input type="text" class = "form-control" name = "dateto" id="dateto">
      <span class="input-group-append">
          <span class="input-group-text bg-light d-block">
            <i class="fa fa-calendar"></i>
          </span>
        </span>
    </div>
    <button type="submit" class="btn btn-primary">Request</button>
  </div>

    </form>
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $datefromraw =  date_create($_POST["datefrom"]);
    $datetoraw =  date_create($_POST["dateto"]);
    $datefrom = date_format($datefromraw,"Ymd");
    $dateto = date_format($datetoraw,"Ymd");

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:9103/interoperability/api/passesanalysis/' . $op1 . '/' . $op2 . '/' . $datefrom . '/' . $dateto . '/',
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
  $json_response = json_encode(json_decode($response), JSON_PRETTY_PRINT);
  }?>

  <br><br>
  <div class = "container" >
    <div class = "card" style = "padding:10px">
      <div class = "card-body">
        <p><?php  if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo "<pre>" . $json_response . "</pre>";} ?></p>
  <!-- Footer -->
  <div class="container fixed-bottom" style = "padding:">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top ">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        </a>
        <img src = "../icons/NTUA-logo32px.png" width="24" height="24">
        <span class="text-muted">softeng | 2021-2022 | TL21-60</span>
      </div>

      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-muted" href="https://github.com/ntua/TL21-60"><i class="bi bi-github" role = "img" aria-label="GitHub"></i>GitHub</a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
        <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
      </ul>
    </footer>
  </div>

  <div class="b-example-divider"></div>

    </body>


  </html>
