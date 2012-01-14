<?
    // basic stuff to log into the google account with the calendar data

    require_once 'Zend/Loader.php';
    Zend_Loader::loadClass('Zend_Gdata');
    Zend_Loader::loadClass('Zend_Gdata_AuthSub');
    Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
    Zend_Loader::loadClass('Zend_Gdata_Calendar');

    // ClientLogin username/password authentication
    $user = 'alison.nahm@gmail.com';
    $pass = 'wobble31';
    $service = Zend_Gdata_Calendar::AUTH_SERVICE_NAME; // predefined service name for calendar
    $client = Zend_Gdata_ClientLogin::getHttpClient($user, $pass, $service);

?>
