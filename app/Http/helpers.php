<?php


  function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->type);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }


  function getMyPermission($id)
  {
    switch ($id) {
      case 9:
        return 'admin';
        break;
      case 2:
        return 'org_user';
        break;
      default:
        return 'user';
        break;
    }
  }

function customRequestCaptcha(){
    return new \ReCaptcha\RequestMethod\Post();
}

?>
