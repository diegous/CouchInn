<?php

/* HELPER FUNCTIONS USED BY APPLICATION
 * ====================================
 */

// Function to get DB connection used by classes
function get_connection() {
  $con = new mysqli("localhost", "root", "", "couchinn");

  if ($con->connect_error)
    die('Connect Error: ' . $con->connect_error);

  return $con;
}

// Session checkers
function redirect_if_not_logged_in() {
  if (!isset($_SESSION['user'])) {
    header('Location: ' . '/index.php');
    exit();
  }
}

function redirect_if_not_admin() {
  if (!isset($_SESSION['user']) || !$_SESSION['user']->is_admin) {
    header('Location: ' . '/index.php');
    exit();
  }
}

function redirect_if_logged_in() {
  if (isset($_SESSION['user'])) {
    header('Location: ' . '/index.php');
    exit();
  }
}


// Functions for managing alerts to be shown after page load
function create_alert($alert, $message) {
    $_SESSION['alert'] = $alert;
    $_SESSION['message'] = $message;
}

function check_for_alert() {
  if (isset($_SESSION['alert']) && isset($_SESSION['message'])) {
    $alert_variables = [
      "alert"   => $_SESSION['alert'],
      "message" => $_SESSION['message'],
    ];

    unset($_SESSION['alert']);
    unset($_SESSION['message']);

    return $alert_variables;
  } else {
    return NULL;
  }
}


//funcion identica a encodeURIComponent de javascript
function encodeURIComponent($str) {
    $revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
    return strtr(rawurlencode($str), $revert);
}

function redirect_to_message($title,$message,$url){
  header("Location:"."/shared/alert_page.php"
      ."?title=".encodeURIComponent($title)
      ."&url=".encodeURIComponent($url)
      ."&message=".encodeURIComponent($message)
  );
};

// Function that gets main picture for a LIST of COACHS
function get_pictures_for_coachs($couch_list){
  $images = array();

  foreach ($couch_list as $couch) {
    $user = User::get_by_id($couch->user_id);

    // if couch owner is premium
    if ($user->is_premium) {
      $couch_images = Picture::get_by_couch_id($couch->id);

      // If couch has pictures, get the first one
      if ($couch_images) {
        $images[$couch->id] = $couch_images[0]->filename;
      }
    }
  }

  return $images;
}
