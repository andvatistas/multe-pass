<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="stylesheet" type = "text/css" href="custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts.js"></script>
    <title>Multe-Pass Home Page</title>
  </head>

  <body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand navbar-dark" style="background-color: #5b0ba1">
    <div class="container-fluid">
      <img src = "/../icons/logo_512px.png" width = "40" height = "40">
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
              <a class="nav-link active" aria-current="page" href="about.php">About</a>
          </li>
      </div>
    </div>
  </nav>
  <div class="b-example-divider"></div>

<!-- Main Body -->
<div class = "container" >
  <h3>Admin Commands</h3>
  <p>Below you can use the 4 API endpoints for checking DB status or resetting tables</p>


  <!-- Button Group -->
  <form id ="adminForm" method = "POST" action="admin.php">
  <div class="btn-group d-flex align-self-center" role="group">
    <button type="button" class="btn btn-primary" onclick = "sendRequest('healthceck')" >Healthcheck</button>
    <button type="button" class="btn btn-primary" onclick = "openModal()">Reset Vehicles</button>
    <button type="button" class="btn btn-primary" onclick = "openModal()">Reset Stations</button>
    <button type="button" class="btn btn-primary" onclick = "openModal()">Reset Passes</button>
  </div>

  <!-- Modals -->
    <div class="modal" tabindex="-1" id="exampleModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Modal body text goes here.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>



<!-- Footer -->
<div class="container">

  <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
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
