<!DOCTYPE html>
<html lang = "en">
  <head>

    <!-- <style>
    .passescosttable th {
      text-align: center;
      padding-left: 10px;
      padding-right: 10px;
    }

    .passescosttable td {
      text-align: center;
    }
    </style> -->

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
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5b0ba1">
    <div class="container-fluid">
      <a class="navbar-brand" href="/../index.php">Multe-Pass</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="admin.php">Admin</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href = "#" role = "button" data-bs-toggle="dropdown" data-bs-target="#navbar-nav" aria-expanded="false" id="navbarDropdown">Request Pages</a>
            <ul class = "dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class = "dropdown-item" href ="passesAnalysis.php">Passes Analysis</a>
              </li>
              <li >
                <a class="dropdown-item" href="#">Charges By</a>
              </li>
              <li>
                <a class="dropdown-item" href="#">Passes Cost</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Statistics</a>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <li class ="nav-item">
            <a class="nav-link active" aria-current="page" href="about.php">About</a>
          </li>
      </div>
    </div>
  </nav>

  <div class="b-example-divider"></div>


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
        <input type="text" class = "form-control" name = "datefrom" id="datepicker">
      </div>
      <div class="form-group date"name = "dateto" style = "padding-top:5px;">
        <label class="label">Period End</label>
        <input type="text" class = "form-control" name = "dateto" id="dateto">
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
    $op1 = $_POST["op1"];
    $op2 = $_POST["op2"];
    $datefromraw =  date_create($_POST["datefrom"]);
    $datetoraw =  date_create($_POST["dateto"]);
    $datefrom = date_format($datefromraw,"Ymd");
    $dateto = date_format($datetoraw,"Ymd");

    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://localhost:9103/interoperability/api/passescost/' . $op1 . '/' . $op2 . '/' . $datefrom . '/' . $dateto . '/',
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
    echo "<div class = 'container d-flex justify-content-center'>
      <div class = 'card' style = 'padding:10px'>
        <div class = 'card-body'>
          <table class = 'passescosttable'>
            <thead>
              <tr>
                <th>Operator 1</th>
                <th>Operator 2</th>
                <th>Request Timestamp</th>
                <th>Period From</th>
                <th>Period To</th>
                <th>Number of Passes</th>
                <th>Passes Cost</th>
              </tr>
            </thead>";

          echo "<tr>";
          echo "<td>".$json_response->op1_ID."</td>";
          echo "<td>".$json_response->op2_ID."</td>";
          echo "<td>".$json_response->RequestTimestamp."</td>";
          echo "<td>".$json_response->PeriodFrom."</td>";
          echo "<td>".$json_response->PeriodTo."</td>";
          echo "<td>".$json_response->NumberOfPasses."</td>";
          echo "<td>".$json_response->PassesCost."</td>";
          echo "</tr>";
          echo "</table>";
          echo" </div>";
          echo" </div>";
          echo" </div>";
        }?>
        <br>
  <!-- Footer -->
  <div class="container fixed-bottom" style = "padding:10px">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top ">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
        </a>
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
