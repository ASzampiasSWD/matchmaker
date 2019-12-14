<?php
  include 'functions.php'; 
  session_start()
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css" />
    <link href="styles/robotoAgain.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="styles/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="styles/app.css" type="text/css" />
    <title>Company Name Here</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <a style="color: white" class="navbar-brand">Company Name Here</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
	  <a href="<?php echo 'index.php?amazoncardcode=' . $_SESSION["url_code"] ?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
	  <a href="<?php echo 'how.php?amazoncardcode=' . $_SESSION["url_code"] ?>" class="nav-link">How I Hacked You</a>
          </li>
    	  <li class="nav-item active">
            <a href="contact.php" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
      <section>
      <br /><br />
      <h1>Blog: amandaszampias.blogspot.com</h1>
      <h1>Twitter: @pure_cadence</h1>
</section>
  <br /><br />
  <footer class="page-footer footer font-small">
			<div class="footer-copyright text-center py-3">© 2019 Copyright:
				<a href="https://amandaszampias.blogspot.com/" target="_blank" style="color: orange"><b>Amanda Szampias</b></a>
			</div>
	</footer>
    <script src="scripts/jquery-3.3.1.slim.min.js"></script>
    <script src="scripts/popper.min.js"></script>
    <script src="scripts/bootstrap.min.js"></script>
  </body>
</html>
