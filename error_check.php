<?php

if(!empty($_POST) && $csrf->check_valid('post')) {

  // error checking
  foreach ($fields as $field) {
    if (empty($params[$field])) {
      $error[$field] = 'You must enter a value for '. $field;
    }
  }

  if (!is_valid_email($params['email'])) {
    $error['email'] = 'Please enter a valid email address. eg you@example.com';
  }

  // no errors insert into database
  if (empty($error)) {
    $comments = R::dispense( 'comments' );
    $comments->name = clean_db_data($params['name']);
    $comments->email = clean_db_data($params['email']);
    $comments->comment = clean_db_data($params['comment']);
    $comments->date = date("Y-m-d H:i:s");
    $comments->ipAddress = clean_db_data($_SERVER['REMOTE_ADDR']);
    $comments->user_agent = clean_db_data($_SERVER['HTTP_USER_AGENT']);

    $id = R::store($comments);

    print '<p>Comment has been saved to the database.</p>';
    $params = array();

  }

} else {
  $error['form'] = 'Sorry CSRF token did not match.';
}
