<?php

include $_SERVER['DOCUMENT_ROOT'] . '/shared/loader.php';

redirect_if_not_logged_in();

if (isset($_GET['id']) && isset($_GET['action'])) {
  $user = User::get_by_id($_GET['id']);

  if ($_GET['action'] == 'enable' && $_SESSION['user']->is_admin) {
    $user->enable();
    create_alert('success', 'El usuario fue habilitado');
  } else
    if ($_GET['action'] == 'disable') {
      if (!$user->is_admin) {
        $user->disable();
        $user->disable_couch_user();
        $user->disable_reservation_user();
        $user->disable_reservation_couch_user();
        create_alert('success', 'El usuario fue deshabilitado');
      } else
        if (count(User::enabled_admins()) > 1){
          $user->disable();
          $user->disable_couch_user();
          $user->disable_reservation_user();
          $user->disable_reservation_couch_user();
          create_alert('success', 'El usuario fue deshabilitado');
        } else
          create_alert('danger', 'No pueden deshabilitarse todos los administradores');
    }
}

$updated_current_user = User::get_by_id($_SESSION['user']->id);

if ($updated_current_user->enabled)
  header('Location: ' . '/user/user_list.php');
else
  header('Location: ' . '/session/session_close.php');
exit();
