<?php

namespace  ELG\Component\ElgJobs\Site\Controller;

defined('_JEXEC') or die;

//use Joomla\CMS\MVC\Controller\BaseController;
include JPATH_SITE . '/vendor/autoload.php';

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Controller\ApiController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Environment\Browser;

//use Joomla\CMS\Router\Route;
//use ELG\Component\ElgJobs\Site\Model\Helpers\ModelHelper;

/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 *
 * 
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence. 
 * 
 */

/**
 * ELG Job Controller
 * @since  0.0.1
 */
class NotifyController extends ApiController {

    private $accessToken = 'EAAPiDFYNNZBMBAFhNreC2amfAtrEUdLnO3B3wtNrffdZAmwukpjqhzIf6s0gVjNY6SbDZBEMsE4yHDZCHUmEMZBcVGe22oajbggZALv7UNmgQKVixIwU30TMPhvwPb6K5QFwS3n1ZBc32ieCKX3abXtmlsIydWBDKOXUFoKpS0KQRggEDZAyNLu7gOCxk0RHPZCkZD';
    private $pixelId = '1754530784893159';
   
  
   
   public function notify() {
// exit("ok1");       
        $type = $this -> input -> getInt('type',1);
        $config = Factory::getConfig();
        $sender = array( 
            $config->get( 'mailfrom' ),
            $config->get( 'fromname' ) 
        );
        $subject = "Ενδιαφέρον για ";
        $recipient =  'info@elpidajob.gr'; //$config -> get( 'mailfrom' );
        
        if ( $type  == 1 ) {
            $subject .= " αγγελία ";
        }
        else {
            $subject .= " προσωπικό";
                        
        }
        $mailBody = "Υπήρξε ενδιαφέρον για την καταχώρηση : <br> " . $this -> input -> getString('recordUrl') 
                . '<br><br>Από :<br>' . $this -> input -> getString('fullname') . '<br><strong>Στοιχεία επικοινωνίας</strong>: ' 
                . $this -> input -> getString('telephone') . ' ' . $this -> input -> getString('email');
        
        $mailer = Factory::getMailer();
        $mailer -> isHtml();
        $mailer -> setSubject($subject);
        $mailer -> setBody($mailBody);
        $mailer -> setSender($sender);
        $mailer -> addRecipient($recipient );
        $mailer -> addCC('christoforos@e-logism.gr');
	$mailer -> SMTPDebug = 3;
        $res = $mailer -> Send();
//	var_dump($res);
        if ( $res ) {
            $this -> app ->enqueueMessage(Text::_('COM_ELGJOBS_NOTICE_SEND'), 'success') ;
        }
        else {
            $this -> app ->enqueueMessage(Text::_('COM_ELGJOBS_NOTICE_NOT_SEND'), 'success') ;
        }
        
        echo new JsonResponse();
        $this ->FBJobLead();
   }
      
   
   public function likep() {
//	exit("ok2");
	$res = false;
        $idPersonnel = $this -> input -> getInt('id',0);
        if( $idPersonnel > 0 ) {
            $model = parent::getModel();
            $res = $model -> addLike($idPersonnel);
            $likes = $this -> app ->getUserState('com_elgjobs.notify.likes');
            if ( $likes == null ) {
                $likes = [];
            }
            if ( !isset( $likes[$idPersonnel] ) ) {
                    $likes[$idPersonnel] = 0;
                }  
            if ( $res ) {
               $likes[$idPersonnel] = $likes[$idPersonnel] + 1;
            }
            $this -> app -> setUserState('com_elgjobs.notify.likes', $likes);
        }
        
        echo new JsonResponse($res);
   }
    
   
   public function comment() {
//	   exit("ok3");
        $user = Factory::getUser();
        $data = new \stdClass();
        $data -> idContact = $this -> input -> getInt('idContact', 0);
        $data -> commentor = $this -> input -> getString("commentor", '');
        $data -> comment = $this -> input -> getString("comment", '');
        $data -> user = $user;
        $data -> userIp = $_SERVER['REMOTE_ADDR'];
        $data -> Lang = $this -> app -> getLanguage() -> getTag();
        $model = parent::getModel();
        $res = $model -> comment($data);
        echo new JsonResponse($res);
       
   }
   
   public function jobpost() {
   //     exit("ok4");
        $data = new \stdClass();
        $data -> fullname = $this -> input -> getString('fullname', '');
        $data -> job = $this -> input -> getString("job", '');
        $data -> telephone = $this -> input -> getString('telephone','');
        $data -> email = $this -> input -> getString('email', '');
        $model = parent::getModel();
        $cfg = $this -> app ->getConfig();
        $mailFrom = $cfg -> get('mailfrom');
        $mailFromName = $cfg -> get('fromname');
        $subject = "Άιτημα αγγελίας από " . $cfg -> get('sitename');
        $body = " Αποστολέας αγγελίας: <strong>" . $data -> fullname .'</strong>'
                . "<br>Στοιχεία επικοινωνίας: <strong>: " . $data -> telephone . ' ' . $data -> email . "</strong>"
                . "<br><strong>Αγγελία</strong><br>"
                . $data -> job;


       $model -> sendMail($mailFrom, $mailFromName, "info@elpidajob.gr", $subject, $body );
        $this -> app ->enqueueMessage("Το μύνημά σας ελήφθη θα σας απαντήσουμε το συντομότερο.");
        echo new JsonResponse(true);
        $this -> FBJobPost();
   }
   
   
    private function FBJobPost() {
     //  exit("ok5");
        require_once JPATH_CLI . "/FBApi/ELGFBEventSubmit.php"; 
        $clientIpAddress = Factory::getApplication()->getInput()->server->get('REMOTE_ADDR');
        $clientAgent = Browser::getInstance()->getAgentString();
        $uri = new \Joomla\CMS\Uri\Uri();
        $fbEvent = new \ELGFBEventSubmit($this -> accessToken, $this -> pixelId, $clientIpAddress, $clientAgent, $uri -> current());
        $fbEvent -> execute();  
    }
   
    private function FBJobLead() {
     //  exit("ok7");
       require_once JPATH_CLI . "/FBApi/ELGFBEventLead.php"; 
        $clientIpAddress = Factory::getApplication()->getInput()->server->get('REMOTE_ADDR');
        $clientAgent = Browser::getInstance()->getAgentString();
        $uri = new \Joomla\CMS\Uri\Uri();
        $fbEvent = new \ELGFBEventLead($this -> accessToken, $this -> pixelId, $clientIpAddress, $clientAgent, $uri -> current());
        $fbEvent -> execute(); 
    }
    
    public function notifyCall() {
        $this ->FBCallPost();
    } 
   
    private function FBCallPost() {
   //    exit("ok8");
        require_once JPATH_CLI . "/FBApi/ELGFBEventPhoneCall.php"; 
        $clientIpAddress = Factory::getApplication()->getInput()->server->get('REMOTE_ADDR');
        $clientAgent = Browser::getInstance()->getAgentString();
        $uri = new \Joomla\CMS\Uri\Uri();
        $fbEvent = new \ELGFBEventPhoneCall($this -> accessToken, $this -> pixelId, $clientIpAddress, $clientAgent, $uri -> current());
        $response = $fbEvent -> execute();
        echo json_encode($response);
       
    }

}
