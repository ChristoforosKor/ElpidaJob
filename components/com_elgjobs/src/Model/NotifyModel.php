<?php

namespace ELG\Component\ElgJobs\Site\Model;
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2030 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 jimport('joomla.filesystem.file');
 
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

use Joomla\CMS\Factory; 
  
 
 class NotifyModel extends BaseDatabaseModel { 
  

   public function addLike($idPersonnel){
       $db = $this -> getDbo();
       $query = $db -> getQuery(true);
       $query -> update ("#__elg_ergasia_candidate_basic")
               -> set(" suggestUp = ifNull(suggestUp,0) + 1")
               -> where ("idContact = " . $idPersonnel );
       $db -> setQuery($query) -> execute();
       
   }
   
   
   public function comment($data) {
       $db = $this -> getDbo();
       
       $submissionId = $this -> submitForm($db, 3, $data -> userIp, $data -> user, '-', $data -> Lang);
       
       
        $this -> submitValues( $db, 3, $submissionId, "idContact", $data -> idContact );
        $this -> submitValues( $db, 3, $submissionId, "commentor", $data -> commentor );
        $this -> submitValues( $db, 3, $submissionId, "comment", $data -> comment );
        $this -> submitValues( $db, 3, $submissionId, "state", 2 );
        $body = $data -> comment;
        $body .= '<br>Α.Μ. Σχολίου: ' . $submissionId;
        $body .= '<br>Αφορά: http://elpidajob.e-logism.gr/personnel?id=' . $data -> idContact;
        $this -> sendMail('info@elpidajob.gr', 'ΙΓΕΕ ΕΛΠΙΔΑ', 'info@elpidajob.gr', 'Νέο Σχόλιο Προσωπικού', $body );
        return true;
//       return $db -> insertObject('#__user_profiles', $profile);
   }
    

    private function submitForm($db, $formId, $remoteAddress, $user, $formToken, $languageTag) {
            $submission = new \stdClass();
            $submission -> SubmissionId = null;
            $submission -> FormId = $formId; 
            $submission -> UserIp = $remoteAddress;
            $submission -> UserName = $user -> username;
            $submission -> UserId = $user -> id;
	    
	    $submission -> Lang = $languageTag;
            $submission -> confirmed = 1;
            $submission -> SubmissionHash = $formToken;           
            $submission -> DateSubmitted = date("Y-m-d H:i:s");
	    
	    $db -> insertObject('#__rsform_submissions', $submission, 'SubmissionId');
            return $submission -> SubmissionId;
    }
   
    private function submitValues($db, $formId, $submissionId, $fieldName, $fieldValue) {
            $submission = new \stdClass();
            $submission -> SubmissionValueId = null;
            $submission -> FormId =  $formId;
            $submission -> SubmissionId = $submissionId;
            $submission -> FieldName = $fieldName;
            $submission -> FieldValue = $fieldValue;
            $db -> insertObject('#__rsform_submission_values', $submission, 'SubmissionValueId' );
            return $submission -> SubmissionValueId;
            
        }
        
        
        function sendMail($mailFrom, $mailFromName, $mailTo, $subject, $body ) {
    
            $mailer = Factory::getMailer();
            $mailer -> isHtml(true);
            $mailer -> clearAllRecipients();
                       
            $sender = array( 
                $mailFrom,
                $mailFromName                
            );
            $recipients = $mailTo;
            $mailer-> setSender($sender);
            $mailer -> addRecipient( $recipients );
            $mailer -> addCC('christoforos@e-logism.gr');
            $mailer-> setSubject( $subject );
            $mailer-> setBody( $body  ) ;
            $mailer -> Send();
    }
    
    
    private function getCotactComment($idContact) {
        $query = $this ->getDbo() -> getQuery(true);
        $query -> select('name') 
               -> from ("#__contact_details")
                -> where("id = " . $idContact);
        return $db -> setQuery($query) -> loadResult();
    }
}
