<?php

session_start(); // Start session
require 'csrf.class.php';
require 'class.table.php';

$csrf = new csrf();


// Generate Token Id and Valid
$token_id = $csrf->get_token_id();
$token_value = $csrf->get_token($token_id);


// the function below sanatises values before they are stored in a database.
function clean_db_data($dbvalue) {
  $dbvalue = addslashes($dbvalue);  // add slashes to the value
  $dbvalue = trim($dbvalue); // trim white space from the begining and end of the data
  $dbvalue = htmlentities($dbvalue, ENT_QUOTES); // convert htmlentities

  return $dbvalue;
} // end function clean_db_value

// copy paste from PHP help file.
function unhtmlentities ($string) {
    $trans_tbl = get_html_translation_table (HTML_ENTITIES);
    $trans_tbl = array_flip ($trans_tbl);
    return strtr ($string, $trans_tbl);
} // end func


//the funcdtion below removes the sanatasion done by clean_db_data
function unclean_db_data($dbvalue) {
  $dbvalue = stripslashes(unhtmlentities($dbvalue));  // removes the slashes added when the value was stored in the database

  return $dbvalue;
}  // end function unclean_db_data

function is_valid_email($email) {
  if(eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]){2,4})$', $email)) { return TRUE; } else { return FALSE; }
} // end func


// the below function outputs a formatted error essage to a page
function output_error($message) {

  if (empty($message)) {
    return;
  }
  $errmsg = '<span class="error-block">'. $message .'</span><br />'."\n";
  return $errmsg;
} // end func output_error

//----------------------------------------------------------------------------------------

// the below function outputs a formatted error essage to a page
function output_error_block($message)
{
  $errmsg = '<div class="error-block">'. $message .'</div><br />'."\n";
  return $errmsg;
} // end func output_error


function get_params() {

 foreach ($_REQUEST AS $key=>$value) {
    $param[$key] = $value;
  }

  return $param;
}  // end func get_params


function debug_all() {

  // print the session array
  $buf .= '<h2>$_SESSION</h2>'."\n";
  $buf .= print_format_array($_SESSION);


  $buf .= '<br />'."\n";
  $buf .= '<h2>$param</h2>'."\n";

  $param = get_params();
  $buf .= print_format_array($param);

  $buf .= '<br />'."\n";
  $buf .= '<h2>$_COOKIE</h2>'."\n";
  $buf .= print_format_array($_COOKIE);

  $buf .= '<br />'."\n";

  $buf .= ''."\n";
  $buf .= ''."\n";

  return $buf;
}


// debug - prints a nice formatted array, only need to pass it the name of the array
function print_format_array($array_name) {
  $buf .= '<pre><font color="#00ff33">'."\n";
  ksort($array_name);
  while (list($key, $val) = each($array_name)) {
    if (is_array($val)) {
      $buf .= $key.' => '."\n";
      while (list($key2,$val2) = each($val)) {
        $buf .= '&nbsp;&nbsp;'.$key2.' = '.$val2.''."\n";
      }
    } else {
      $buf .= $key.' = '.$val.''."\n";
    }
  }
  $buf .= '</font></pre>'."\n";
  return $buf;
} // end func
