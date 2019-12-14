<?php

function db_connect() {
  static $connection;

  if (!isset($connection)) {
    $config = parse_ini_file('/var/www/config/configMatch.ini');
    $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
  }

  if ($connection == false) {
    return mysqli_connect_error();
  }
  return $connection;
}

function getTime() {
  date_default_timezone_set('US/Eastern');
  $dtToday = new DateTime();
  return date_format($dtToday, 'm/d/Y h:i:s');
}

function getPeople() {
 $conn = db_connect();
 $stack = array();
 $stmt = $conn-> prepare("SELECT person_id, first_name, last_name,  
	                 nickname, anonymous, url_code FROM Person"); 
 $result = $stmt->execute();
 $stmt->bind_result($person_id, $first_name, $last_name, $nickname, $anonymous, $url_code);
 while ($stmt->fetch()) {
	 $arPeople = array("person_id"=>$person_id, "first_name" => $first_name, 
		           "last_name" => $last_name, "nickname" => $nickname,
		           "anonymous" => $anonymous, "url_code" => $url_code);
  array_push($stack, $arPeople);
 }
 $stmt->close();
 return $stack;
}


function getVisit($person_id) {
  $conn = db_connect();
  $stack = array();
  $stmt = $conn->prepare("SELECT visit_id, browser, is_remote, time_log
	  		  FROM Visit
			  WHERE person_id = ?
			  ORDER BY visit_id ASC LIMIT 1");
  $stmt->bind_param("i", $person_id);
  $result = $stmt->execute();
 
  $stmt->bind_result($visit_id, $browser, $is_remote, $time_log);
  while ($stmt->fetch()) {
    $arVisits = array("visit_id" => $visit_id, "browser" => $browser, "is_remote" => $is_remote, "time_log" => $time_log);
    array_push($stack, $arVisits);
  }
  $stmt->close();
  return $arVisits;
}

function getPersonByURLCode($url_code) {
  $conn = db_connect();
  $stack = array();
  $stmt = $conn->prepare("SELECT person_id, anonymous, nickname, first_name, last_name
	  		  FROM Person
			  WHERE url_code = ?");
  $stmt->bind_param("s", $url_code);
  $result = $stmt->execute();
 
  $stmt->bind_result($person_id, $anonymous, $nickname, $first_name, $last_name);
  $stmt->fetch();
  $arPerson = array("person_id" => $person_id, "anonymous" => $anonymous, "nickname" => $nickname, "first_name" => $first_name, "last_name" => $last_name);
  $stmt->close();
  return $arPerson;
}


function getUniqueVisitCount() {
  $conn = db_connect();
  $stmt = $conn->prepare("SELECT COUNT(DISTINCT person_id)
	  		  FROM Visit");
  $result = $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();
  return $count;
}



function getVisitCount($person_id) {
  $conn = db_connect();
  $stmt = $conn->prepare("SELECT COUNT(*)
	  		  FROM Visit
			  WHERE person_id = ?");
  $stmt->bind_param("i", $person_id);
  $result = $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();
  return $count;
}

function insertVisit($person_id, $browser, $ip_address, $is_remote, $time_log) {
  $conn = db_connect();
  $stmt = $conn->prepare("INSERT INTO Visit (person_id, browser, ip_address, is_remote, time_log) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("issis", $person_id, $browser, $ip_address, $is_remote, $time_log);
  $stmt->execute();
  $stmt->close();
}

function updateAnonymousValue($anonymous, $person_id) {
  $conn = db_connect();
  $stmt = $conn->prepare("UPDATE Person SET anonymous = ? WHERE person_id = ?");
  $stmt->bind_param("ii", $anonymous, $person_id);
  $stmt->execute();
  $stmt->close();
}

function updateButtonClicks($person_id) {
  $conn = db_connect();
  $stmt = $conn->prepare("UPDATE Person SET button_clicks = button_clicks+1 WHERE person_id = ?");
  $stmt->bind_param("i", $person_id);
  $stmt->execute();
  $stmt->close();
}


?>
