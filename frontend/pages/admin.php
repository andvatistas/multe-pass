<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet"  href="../custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts.js"></script>
    <title>Multe-Pass Admin Page</title>
  </head>

  <body>
    <?php include '../components/header.php';?>

<!-- Main Body -->
<div class = "container d-flex flex-column align-items-center m-3 p-1">
  <h4>Admin Commands</h4>
  <p class = "text-center">Below you can use the 4 API endpoints for checking DB status or resetting tables.
    Resetting confirms your action before proceeding. </p>


  <!-- Button Group -->
  <form  action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method = 'POST'>
    <div class="btn-group d-flex align-self-center"  role="group">
      <button type="submit" class="btn btn-primary main" name = "endpoint" id = "main_button" value = "healthcheck">Healthcheck</button>
      <button type="submit" class="btn btn-primary" name = "endpoint" onclick ="return confirm('Are you sure?');" id = "main_button" value = "resetvehicles">Reset Vehicles</button>
      <button type="submit" class="btn btn-primary" name = "endpoint" onclick ="return confirm('Are you sure?');" id = "main_button" value = "resetstations">Reset Stations</button>
      <button type="submit" class="btn btn-primary" name = "endpoint" onclick ="return confirm('Are you sure?');" id = "main_button" value = "resetpasses">Reset Passes</button>
    </div>
  </form>
</div>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curl = curl_init();
    if ($_POST["endpoint"] == "healthcheck"){
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:9103/interoperability/api/admin/healthcheck',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
    ));
    }
    else{
      $endpoint = $_POST["endpoint"];
      curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:9103/interoperability/api/admin/' . $endpoint,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
    ));
  }
}?>
    <br>

  <?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $response = curl_exec($curl);
      curl_close($curl);
      $json_response = json_encode(json_decode($response), JSON_PRETTY_PRINT);
      echo "<div class = 'container' style = 'padding:20px'>
                  <div class = 'card'>
                    <div class = 'card-body'>";
      echo "<pre>" .$json_response ."</pre>";
      echo "</div>";
      echo "</div>";
      echo "</div>";

          }?>

    </p>
  </div>
</div>
</div>

<!-- Footer -->
<?php include '../components/footer.php';?>
  </body>


</html>
