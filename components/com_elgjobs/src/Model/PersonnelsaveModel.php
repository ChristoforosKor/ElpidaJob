<?php

namespace ELG\Component\ElgJobs\Site\Model;

/* ------------------------------------------------------------------------
  # com_elgergasia - e-logism job agency application
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (c) 2010-2030 e-logism.com. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.gr
  ----------------------------------* */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filesystem.file');

use ELG\Component\ElgJobs\Site\Model\PersonneleditModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Filesystem\File;
use ELG\Component\ElgJobs\Site\CommonUtils;
use Exception;


// include JPATH_COMPONENT_SITE .'/libraries/joomla/models/translations.php';  
include JPATH_COMPONENT_SITE .'src/Model/Helpers/translations.php';  
 




class PersonnelsaveModel extends PersonneleditModel {

 
    
    
    public function save($values) {

        $app = Factory::getApplication();
        $db = $this->getDbo();
        
        try {          
            
            $db -> transactionStart();
            $commonUtils = new CommonUtils();
            $contactTable = $this -> getContactTable();
            $contactResult = $this -> saveContact($values, $contactTable);
            if (is_array($contactResult) ) {
                foreach ($contactResult as $error ) {
                    $app -> enqueueMessage($error, 'warning');
                }
                $db -> transactionRollback();
                return;
            }
           
            if ( $values['candidatePhotoUpload1']['name'] !== null ) {
                $this -> storeImage($values['candidatePhotoUpload1'], $contactResult, $commonUtils, $contactTable);
            }       
             
            
            
            $storage = $this ->getCreateMonthFolder("papers");
            $documentsUploaded =  $commonUtils -> storeDocument( $storage, $values['candidateFileUpload'] , $contactResult);
            $this->insertPapers($documentsUploaded, $contactResult);                    
            $existingContactId = $this ->getExistingBasicId($db, $contactResult);
                       
            if ($existingContactId == null || $existingContactId == 0) {
                $this -> insertBasicValues($db, $values, $contactResult);
                $isNew = true;
            } else {
                $this -> updateBasicValues($db, $values, $contactResult);
                $isNew = false;
            }
           
            $this -> insertPreferedSpecialities($db, $values, $contactResult);
            $this -> insertPreferedWorkingHours($db, $values, $contactResult);
            $this -> insertPreferedSpecialNeeds($db, $values, $contactResult);
            $this -> insertTeams($db, $values['idUserTeam'], $contactResult);
            
            $this -> setState($this->getName() . '.id', 'id');
            $this -> setState($this->getName() . '.new', $isNew);
            $app -> enqueueMessage(Text::_('COM_ELGJOBS_SAVE_SUCCESS'), 'success');  
            $db ->transactionCommit();
            return true;
        } catch (Exception $e) {
            $app->enqueueMessage($e->getMessage(), 'warning');
            $db->transactionRollback();
            return false;
        }

    }

    
    private function getExistingBasicId($db, $idContact) {
        $query = $db -> getQuery();
        $query  -> clear();
        $query  -> select("idContact") 
                -> from ("#__elg_ergasia_candidate_basic") 
                -> where ("idContact = " . $idContact);
        return $db -> setQuery($query) -> loadResult();
    }
    
    
    private function insertBasicValues($db, $values,$idContact) {
        $query = $db->getQuery(true);

        $query->insert("xe45_elg_ergasia_candidate_basic")
                ->columns("idContact, showPhoto, useMyData, 
                    dateOfBirth, idGender, idNationality, suggestUp, suggestDown, 
                    hiredTimes, pt, 
                    lastOfficeVisit, idInsurance, idRecommentation")
                ->values(
                        $idContact . ", " . $values["showPhoto"] . ", " . $values["useMyData"] . ","
                        . $db -> quote ($values["dateOfBirth"] ) . ", " . $values["idGender"] . ", " . $values["idNationality"] . ", 0, 0,"
                        . "0,  Point(" . $values['lng'] . "," . $values['lat'] . "), " 
                        . $db->quote(($values['lastOfficeVisit'] == '' ? date('Y-m-d'): $values['lastOfficeVisit'])) . ", " . ($values['idInsurance'] == '' ? 0 : $values['idInsurance']) . ", " . ($values['idRecommentation'] == '' ? 0 :  $values['idRecommentation']) ) ;

        $db->setQuery($query)->execute();
        return $db->insertid();
    }

    private function updateBasicValues($db, $values, $idContact) {
        $query = $db->getQuery(true);
        $query->update("#__elg_ergasia_candidate_basic")
                ->SET(" 
                            showPhoto=1, 
                            useMyData=1, 
                            dateOfBirth= " . $db -> quote( $values['dateOfBirth'] ) . ", 
                            idGender=" . $values['idGender'] . ", 
                            idNationality=" . $values['idNationality'] . ",
                            suggestUp=0, 
                            suggestDown=0, 
                            hiredTImes=0, 
                            pt= Point(" . $values['lng'] . "," . $values['lat'] . "),
                            lastOfficeVisit = " . $db->quote(($values['lastOfficeVisit'] == '' ? date('Y-m-d'): $values['lastOfficeVisit'])) . ", 
                            idInsurance = " . ($values['idInsurance'] == '' ? 0 :  $values['idInsurance']) . ",
                            idRecommentation = " . ($values['idRecommentation'] == '' ? 0 : $values['idRecommentation'])
                        )
                ->where("  idContact=" . $idContact);
                // echo $query->dump();exit;
        return $db->setQuery($query)->execute();
    }

    private function insertPreferedSpecialities($db, $values, $idContact) {
        $query = $db->getQuery();
        $query->clear();
        $query->delete("#__elg_ergasia_candidate_preferencesspecialities")
                ->where("idContact = " . $idContact);
        $db -> setQuery($query) -> execute();
        $prefTable = parent::getPreferenceSpecialitiesTable();
        forEach($values['idSpeciality'] as $idSpeciality) {
            $prefTable -> id = null;
            $prefTable -> idContact = $idContact;
            $prefTable -> idSpeciality = $idSpeciality;
            $prefTable -> store();
        }
    }

    private function insertPreferedWorkingHours($db, $values, $idContact) {
        $query = $db->getQuery();
        $query->clear();
        $query->delete("#__elg_ergasia_candidates_hours")
                ->where("idContact = " . $idContact);
        $db -> setQuery($query)-> execute();
        $prefTable = parent::getPreferenceHoursTable();
        foreach( $values['idHour'] as $idHour) {
             $prefTable -> id = null;
             $prefTable -> idContact = $idContact;
             $prefTable -> idHour = $idHour;
             $prefTable -> store();
        }      
    }
    
      private function insertPreferedSpecialNeeds($db, $values, $idContact) {
        $query = $db->getQuery();
        $query->clear();
        $query->delete("#__elg_ergasia_candidate_specialneeds")
                ->where("idContact = " . $idContact);
        $db -> setQuery($query)-> execute();
        $prefTable = parent::getPreferenceSpecialNeedsTable();
        foreach( $values['idSpecialNeed'] as $idSpecialNeed) {
             $prefTable -> id = null;
             $prefTable -> idContact = $idContact;
             $prefTable -> idSpecialNeed = $idSpecialNeed;
             $prefTable -> store();
        }      
    }

    private function insertTeams($db, $values, $idContact) {
        $query = $db->getQuery();
        $query->clear();
        $query->delete("#__elg_ergasia_candidate_team")
                ->where("idContact = " . $idContact);
        $db -> setQuery($query) -> execute();
        
        forEach($values as $idContactTeam) {
            $data = new \stdClass();
            $data -> id = null;
            $data -> idContact = $idContact;
            $data -> idContactTeam = $idContactTeam;
            $db->insertObject('#__elg_ergasia_candidate_team', $data, 'id');
        }
        
       
        $query->clear();
        $query->delete("#__elg_ergasia_candidate_team")
                ->where("idContactTeam = " . $idContact);
        $db -> setQuery($query) -> execute();
        
        forEach($values as $idContactTeam) {
            $data = new \stdClass();
            $data -> id = null;
            $data -> idContactTeam = $idContact;
            $data -> idContact = $idContactTeam;
            $db->insertObject('#__elg_ergasia_candidate_team', $data, 'id');
        }
        
    }
    
     private function insertPapers( $values, $idContact) {
//        $query = $db->getQuery();
//        $query->clear();
//        $query->delete("#__elg_ergasia_candidate_specialneeds")
//                ->where("idContact = " . $idContact);
//        $db -> setQuery($query)-> execute();
        $papersTable = $this->getPapersTable();
        foreach( $values as $paperFile) {
             $papersTable -> id = null;
             $papersTable -> idContact = $idContact;
             $papersTable -> paperFile = $paperFile;
             $papersTable -> paperTitle = '';
             $res = $papersTable -> store();
             if (!$res) {
                 $error = $papersTable ->getError();
                 throw new Exception($error);
             }
        }      
        unset($paperFile);
    }

    
    
    

    protected function saveContact($values, $table) {
       
        if ( $values['id'] > 0 ) {
            $table -> load($values['id']);
        }
        else {
            $table -> default_con =0;
            $table -> ordering = 0;
            $table -> params = '{"show_contact_category":"","show_contact_list":"","show_tags":"","show_info":"","show_name":"","show_position":"","show_email":"","add_mailto_link":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_image":"","show_misc":"","allow_vcard":"","show_articles":"","articles_display_num":"","show_profile":"","contact_layout":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","validate_session":"","custom_reply":"","redirect":""}';
            // exit("ok1");
        }
        
        $table->bind($values);
        $table->sortname1 = $values['lastname'];

        if ($values['language'] == ""){
            $table->language = "el-GR";
        } 

        if ($values['accept_photo']){
            $table->sortname2 = $values['accept_photo'];
        }else {
            $table->sortname2 = "";
        }
        $date = Factory::getDate()->toSql();

        $table->name = htmlspecialchars_decode($table->name, ENT_QUOTES);
        $table->alias = $table->generateAlias();

        if (empty($table->id)) {
            
            // Set the values
            $table->created = $date;
            // Set ordering to the last item if not set
            if (empty($table->ordering)) {
                $db = $this->getDbo();
                $query = $db->getQuery(true)
                        ->select('MAX(ordering)')
                        ->from($db->quoteName('#__contact_details'));
                $db->setQuery($query);
                $max = $db->loadResult();
                
                $table->alias = $table->generateAlias() ."_". $max;
                $table->ordering = $max + 1;
                $table->params = '{"show_contact_category":"","show_contact_list":"","show_tags":"","show_info":"","show_name":"","show_position":"","show_email":"","add_mailto_link":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_image":"","show_misc":"","allow_vcard":"","show_articles":"","articles_display_num":"","show_profile":"","contact_layout":"","show_links":"","linka_name":"","linka":"","linkb_name":"","linkb":"","linkc_name":"","linkc":"","linkd_name":"","linkd":"","linke_name":"","linke":"","show_email_form":"","show_email_copy":"","validate_session":"","custom_reply":"","redirect":""}';
                $table->metadesc = '';
                $table->metadata = '';
                $table->featured = 0;
//                $table->published = 1;
                $table -> catid = 44;
            } else {
                // Set the values
                $table->modified = $date;
                $table->modified_by = Factory::getUser()->id;
            }

            // Increment the content version number.
            $table->version++;
            // var_dump($table);exit;
        }
       if ( ! $table->store() ) {
           return $table -> getErrors();
           
       }
        return $table->id;
    }

    private function storeImage($uploadedFile, $idContact, $commonUtils, $table) {

        if ($uploadedFile['name'] != '') {
            $storage = $this ->getCreateMonthFolder();
            $fileName = $idContact . "_1";
            $fileExt = strtolower(File::getExt($uploadedFile['name']));
            $originalFile = $storage . '/' . $fileName;
            File::upload($uploadedFile['tmp_name'], $originalFile . '.' . $fileExt);
            $commonUtils->compressImage($originalFile . '.' . $fileExt);
            $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_small.' . $fileExt, 94, 94);
            $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_medium.' . $fileExt, 300, 300);
            unlink($originalFile . '.' . $fileExt);
            $this -> updateImageToDB($idContact, str_replace(JPATH_SITE . '/', '', $originalFile) . '_small.' . $fileExt, $table);
            $this -> storeBase64Image($this ->getDbo(), $idContact, $originalFile . '_small.' . $fileExt);
            
        }
        
        
    }
    
//    private function storeFile($uploadedFile, $idContact, $commonUtils, $table, $num =1) {
//
//        if ($uploadedFile['name'] != '') {
//            $storage = $this ->getCreateMonthFolder("papers");
//            $fileName = $idContact . "_" . $num;
//            $fileExt = strtolower(File::getExt($uploadedFile['name']));
//            $originalFile = $storage . '/' . $fileName;
//            File::upload($uploadedFile['tmp_name'], $originalFile . '.' . $fileExt);
////            $commonUtils->compressImage($originalFile . '.' . $fileExt);
////            $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_small.' . $fileExt, 94, 94);
////            $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_medium.' . $fileExt, 300, 300);
//            unlink($originalFile . '.' . $fileExt);
//            $this -> updateImageToDB($idContact, str_replace(JPATH_SITE . '/', '', $originalFile) . '.' . $fileExt, $table);
//        }
//          
//    }

    private function getCreateMonthFolder($suffix="") {
        $path = JPATH_SITE . "/images/personnel" . $suffix . "/" . date('Ym');
        
        if ( !file_exists ( $path ) ) {
            mkdir($path);
        }
        return $path;
    }
    
    private function updateImageToDB( $idContact, $imagePath, $table) {
        $table -> load($idContact);
        $table -> image = $imagePath;
        $table -> store();        
    }

    
  
    
   
    private function storeBase64Image($db, $idContact, $imagePath) {
        try {
            $img64Quoted = $db -> quote ( base64_encode ( file_get_contents($imagePath) ) );
        }
        catch( Exception $e) {
            Factory::getApplication() ->enqueueMessage("Προβλημα στην κωδικοποιήση 64 εικόνας", 'warning');
            return false;
        }
        try {
            $this -> insertBase64Image($db, $idContact, $img64Quoted);
            return true; 
        }
        catch (Exception $e) {
            if (strpos($e -> getMessage(), 'duplicate' ) ) {
                try {
                    $this ->updateBase64Image($db, $idContact, $img64Quoted);
                    return true;
                } catch (Exception $ex) {
                    Factory::getApplication() -> enqueueMessage( $ex -> getMessage(), 'warning');
                    return false;  
                }
                
            }
            else {
                Factory::getApplication() -> enqueueMessage( $e -> getMessage(), 'warning');
                return false;  
            }
        }
        
    }
    
    private function insertBase64Image($db, $idContact, $img64Quoted) {
        $query = $db -> getQuery(true);
        $query -> insert("#__elg_ergasia_candidate_photo_base64")
                -> columns('idContact, base64Encode')
                -> values( $idContact . ', ' .  $img64Quoted);
        $db -> setQuery($query) -> execute();
    }
    
    private function updateBase64Image($db, $idContact, $img64Quoted) {
        $query = $db -> getQuery(true);
        $query -> update("#__elg_ergasia_candidate_photo_base64")
                -> set (" base64Encode = " . $img64Quoted )
                ->  where ( "idContact = " . $idContact);
        $db -> setQuery($query) -> execute();
    }
    
    
    
}
