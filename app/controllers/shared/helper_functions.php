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
function user_is_logged_in() {
  return isset($_SESSION['user']);
}

function redirect_if_not_logged_in() {
  if (!user_is_logged_in()) {
    header('Location: ' . '/index.php');
    exit();
  }
}

function redirect_if_not_admin() {
  if (!user_is_logged_in() || !$_SESSION['user']->is_admin) {
    header('Location: ' . '/index.php');
    exit();
  }
}

function redirect_if_logged_in() {
  if (user_is_logged_in()) {
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

function redirect_with_alert($alert,$message,$url){
  create_alert($alert,$message);
  header("Location: ".$url);
  exit();
};


function filter_couch_list_for_display($couch_list,$user=null){
  if($user && $user->is_admin)
    return $couch_list;
  $predicate=($user?
    function($couch)use($user){ return $couch->is_visible_for_user($user); } :
    function($couch){ return $couch->is_enabled(); }
  );
  return array_filter($couch_list,$predicate);
}


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
