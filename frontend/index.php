<!DOCTYPE html>
<html lang = "en">
  <head>
    <meta charset = "utf-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="stylesheet" type = "text/css" href="custom_design.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Multe-Pass Home Page</title>
  </head>

  <body>
    <!-- NavBar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #5b0ba1">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Multe-Pass</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pages/admin.php">Admin</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href = "#" role = "button" data-bs-toggle="dropdown" data-bs-target="#navbar-nav" aria-expanded="false" id="navbarDropdown">Request Pages</a>
            <ul class = "dropdown-menu" aria-labelledby="navbarDropdown">
              <li>
                <a class = "dropdown-item" href ="pages/passesAnalysis.php">Passes Analysis</a>
              </li>
              <li >
                <a class="dropdown-item" href="pages/chargesBy.php">Charges By</a>
              </li>
              <li>
                <a class="dropdown-item" href="pages/passesCost.php">Passes Cost</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pages/statistics.php">Statistics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="pages/settlements.php">Settlements</a>
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

  <div class = "container">
    <h1>Multe-Pass Main Page</h1>
    <div class ="row justify-content-md-center mt-2 mb-4">
      <div class = "col">
        <div class = "card">
          <div class = "card-body">
            <h4>Welcome!</h4>
            <p>This is TL21-60's Interoperability Software Webpage. You can run several requests for the API to answer to.</p>
          </div>
        </div>
      </div>
    </div>
    <div class ="row justify-content-md-center" >
      <div class = "col">
        <div class = "card">
          <div class = "card-body">
            <h4>Admin</h4>
            <p>Admin Page allows you to run requests that</p>
          </div>
        </div>
      </div>
      <div class = "col" >
        <div class = "card">
          <div class = "card-body">
            <h4>Request Pages</h4>
            <p>This Dropdown takes you to the "Charges By", "Passes Analysis" and "Passes Cost" pages. You must fill a form </p>
          </div>
        </div>
      </div>
      <div class = "col">
        <div class = "card">
          <div class = "card-body">
            <h4>Statistics</h4>
            <p>Statistics page give you data for the operators, either one by one or all together. These statistics include: </p>
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
