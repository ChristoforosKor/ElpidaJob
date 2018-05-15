<?php

/**
 * @copyright (c) 2014, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 echo 1;
 /**
echo __DIR__ . '/../libraries/Facebook/FacebookSession.php';
require_once( __DIR__ . '/../libraries/Facebook/FacebookSession.php' );
exit();
echo 1;
require_once( __DIR__ . '/../libraries/Facebook/FacebookRedirectLoginHelper.php' );
echo 1;
require_once( __DIR__ . '/../libraries/Facebook/FacebookSDKException.php' );
echo 1;
require_once( __DIR__ . '/../libraries/Facebook/FacebookRequestException.php' );
echo 1;
require_once( __DIR__ . '/../libraries/Facebook/FacebookRequest.php' );
echo 2;
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;

echo 3;
$loginUrl = $facebook->getLoginUrl($params);
FacebookSession::setDefaultApplication('1419126221692492', '3fe8a189d2f0c9dc20453e88b4f90386');

session_start();
echo 4;
$helper = new FacebookRedirectLoginHelper('https://elpidajob/components/com_elgergasia/facebook/facebook.php');
try {
    echo 5;
    $session = $helper->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
    echo $ex->getMessage();
} catch(\Exception $ex) {
    echo $ex->getMessage();
}
echo 6;
if ($session) {
    echo 7;
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    // print data
    echo  print_r( $graphObject, 1 );
}
else 
{}
**/