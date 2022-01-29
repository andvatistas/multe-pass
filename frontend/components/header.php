<!-- NavBar -->
<?php echo"
<nav class='navbar navbar-expand-lg navbar-dark' style='background-color: #5b0ba1'>
<div class='container-fluid'>
  <a class='navbar-brand' href='/../index.php'>Multe-Pass</a>
  <button class='navbar-toggler' type='button' data-bs-toggle='collapse' data-bs-target=''#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
  <span class='navbar-toggler-icon'></span>
</button>
  <div class='d-flex' style='height:100%; width:1px; background-color:black;'>
    <div class='vr'></div>
  </div>

  <div class='collapse navbar-collapse' id='navbarSupportedContent'>

    <ul class='navbar-nav me-auto'>
      <li class='nav-item'>
        <a class='nav-link active' aria-current='page' href='admin.php'>Admin</a>
      </li>

      <li class='nav-item'>
        <a class='nav-link active' aria-current='page' href='statistics.php'>Statistics</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link active' aria-current='page' href='settlements.php'>Settlements</a>
      </li>
      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' href = '#' role = 'button' data-bs-toggle='dropdown' data-bs-target=''#navbar-nav' aria-expanded='false' id='navbarDropdown' style = 'color:#ffffff;'>Request Pages</a>
        <ul class = 'dropdown-menu' aria-labelledby='navbarDropdown'>
          <li>
            <a class = 'dropdown-item' href ='passesAnalysis.php'>Passes Analysis</a>
          </li>
          <li >
            <a class='dropdown-item' href='chargesBy.php'>Charges By</a>
          </li>
          <li>
            <a class='dropdown-item' href='passesCost.php'>Passes Cost</a>
          </li>
          <li>
            <a class='dropdown-item' href='passesPerStation.php'>Passes Per Station</a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class='nav navbar-nav navbar-right'>
      <li>
        <li class ='nav-item'>
          <a class='nav-link active' aria-current='page' href='about.php'>About</a>
      </li>

  </div>
</div>
</nav>

<div class='b-example-divider'></div>";?>
