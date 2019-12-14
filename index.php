<?php
  include 'functions.php';
  session_start(); 

  $arBrowser = get_browser(null, true);
  if (isset($arBrowser['parent']) && isset($arBrowser['platform'])) {
    $browser = substr($arBrowser['parent'], 0, 20) . ' ' . substr($arBrowser['platform'], 0, 20);
  } else {
    $browser = 'NA';
  }

  $ip_address = $_SERVER['REMOTE_ADDR'];
  $is_remote = true;
  
  if (isset($_GET['amazoncardcode'])) {
	  $arPerson = getPersonByURLCode($_GET['amazoncardcode']);
	  $person_id = $arPerson['person_id'];
	  $anonymous = $arPerson['anonymous'];
	  $nickname = $arPerson['nickname'];
	  $realname = $arPerson['first_name'] . ' ' . $arPerson['last_name'];
	  $url_code = $_GET['amazoncardcode'];
	  $_SESSION['url_code'] = $url_code;
    if (!empty($person_id)) {
	if ($ip_address == '200.218.32.10') {
	  $is_remote = false;
	}
      insertVisit($person_id, $browser, $ip_address, $is_remote, getTime());
    }  
  } 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <!--<meta http-equiv="refresh" content="60" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="styles/bootstrap.min.css" type="text/css" />
    <link href="styles/robotoAgain.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="styles/font-awesome.min.css" type="text/css" />
    <link rel="stylesheet" href="styles/app.css" type="text/css" />
    <title>Company Name Here</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light">
      <a class="navbar-brand">Company Name Here</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link">Home</a>
          </li>
          <li class="nav-item">
	  <a href="<?php echo 'how.php?amazoncardcode=' . $_SESSION["url_code"] ?>" class="nav-link">How I Hacked You</a>
          </li>
    	  <li class="nav-item">
	  <a href="<?php echo 'contact.php?amazoncardcode=' . $_SESSION["url_code"] ?>" class="nav-link">Contact</a>
          </li>
        </ul>
      </div>
    </nav>
      <section>
    <br /><br />
    <h2 class="teamTableTitle">Wall of Sheep</h2>
    <table class="table table-dark">
      <thead>
      <tr>
        <th scope="col">Name|Codename</th>
        <th scope="col">Time Logged</th>
        <th scope="col">Visits</th>
	<th scope="col">Remote</th>
	<th scope="col">Browser</th>
      </tr>
      </thead>
      <tbody>
  	<?php
        $arPeople = getPeople();
  
        for ($x = 0; $x < count($arPeople); $x++) {
	  $arPerson = $arPeople[$x];
	  $arVisit = getVisit($arPerson['person_id']);

	  if (!empty($arVisit)) {
  	  $intVisit = getVisitCount($arPerson["person_id"]);  
	  $personName = $arPerson["nickname"];
	  $is_remote = "No";
          $intHitCount = 1 + intHitCount;
	  if ($arPerson["anonymous"] != 1) {
            $personName = $arPerson["first_name"] . ' ' . $arPerson["last_name"];
	  }
	  if ($arVisit["is_remote"] == 1) {
            $is_remote = "Yes";
	  }

	  echo '<tr><td>' . $personName .        '</td>' .
		   '<td>' . $arVisit["time_log"] .   '</td>' . 
		   '<td>' . $intVisit .              '</td>' .  
		   '<td>' . $is_remote .             '</td>' . 
		   '<td>' . $arVisit["browser"] .    '</td>' . 
		  '</tr>';
	  }
	 
	}
	?>
      </tbody>
    </table>

  <?php
   if (!empty($person_id)) {
     echo '<form action="scripts/update_name.php" method="post" enctype="multipart/form-data">';
     echo '<input type="hidden" name="currentAnonymousValue" value="' . $anonymous . '" />';
     echo '<input type="hidden" name="person_id" value="' . $person_id . '" />';
     echo '<input type="hidden" name="url_code" value="' . $url_code . '" />';
     if ($anonymous == 1) {
	    echo '<input style="width: 200px; height: 50px; box-shadow: 5px 5px 10px yellow;" type="submit" value="Show Real Name :)" />';
	   echo '<h2 style="margin-left: 20px; display: inline-block">Your scoreboard username is: ' . $nickname . '</h2>';
     } else {
	     echo '<input style="width: 200px; height: 50px; box-shadow: 5px 5px 10px red;" type="submit" value="Show Fake Name :(" />';
	     echo '<h2 style="margin-left: 20px; display: inline-block">Your scoreboard username is: ' . $realname . '</h2>';
     }
     echo '</form>';
   } 
  ?>


    <div style="margin: 0 auto; text-algin: center;">
      <h1 style="text-align: center">Meet Your Match: Amanda Szampias
      <img src="images/amandaheadshot.png" style="border-radius: 70px;" width="10%" height="10%" /></h1>
    </div>
    <p>Write your message here.</p>

    <div style="margin: 0 auto; text-align: center;">
    <div class="container" style="display: inline-block;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>

    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>

    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>

    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>

    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>


    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>


    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>
	
    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>
	
    <div class="container" style="display: inline-block; margin-left: 50px;">
      <div class="red flame"></div>
      <div class="orange flame"></div>
      <div class="yellow flame"></div>
      <div class="white flame"></div>
      <div class="blue circle"></div>
      <div class="black circle"></div>
    </div>
</div>
  <!-- 120 by 340 -->
  <table class="table table-dark">
	  <tr>
	    <th class="col text-center">Current Hit Tally: <?php echo getUniqueVisitCount(); ?> <th>
	  </tr>
	  <tr>
	    <td>
            <?php
               $totalVisitCount = getUniqueVisitCount();
               for ($d=0; $d < $totalVisitCount ; $d++) { 
	         echo '<img src="images/match.png" width="30" height="85" />';
	       }
               ?>
	    </td>
	  </tr>
  </table>
  
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
