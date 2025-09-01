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
 
 use ELG\Component\ElgJobs\Site\Model\JobeditModel;
 use Joomla\CMS\Form\Form;
 use Joomla\CMS\Factory;
 use Joomla\Database\DatabaseDriver;
 use Joomla\CMS\Language\Text;
 use Joomla\CMS\Filesystem\File;
 use \Exception;
 
  
 
 class JobsaveModel extends JobeditModel { 
  

     
    public function save($values) {
      
       $values['idUser'] = Factory::getUser() -> id;
       $db = $this -> getDbo();
       $app = Factory::getApplication();
     
       $db ->transactionStart();
       
       $idGeo =  $this -> storeGeo($db, $values, $app);
      
       if ( $idGeo === false ) {
           $db ->transactionRollback();
           
           return; 
       }
      
       $values['idGeo'] = $idGeo;
      
       $id = $this -> storeJobData($values, $app);
       
       if ( $id === false ) {
           
           $db ->transactionRollback();
          
           return;
       }
       
       try {
        $values['idJob'] = $id; 
        $oValues = $this -> getTranslationObject($values);      
         if ( $this ->translationExists($db,  $values['language'], $values['idJob'] ) ) {
            $translateAction = 'updateTranslation';
            $isNew = false;
         }
         else {
              $translateAction = 'insertTranslation'; 
              $isNew = true;
         }

         $this -> $translateAction($db, $oValues);
         
         
         $result = $this -> storeDocument($values['idEmployer'], $values['idJob'], $values['documentFile']);
       }
       catch(Exception $e) {
            $app -> enqueueMessage( $e -> getMessage(), 'danger' );
            $db ->transactionRollback();
            return false;
       }
       $db ->transactionCommit();
       $app -> enqueueMessage( Text::_('COM_ELGJOBS_SAVE_SUCCESS'), 'success' );
       return true;
              
    }
    
    
    private function storeJobData($data, $app) {
        $table = parent::getTable('job');
        
        
        if ( $data['id'] == 0 ) {
            $table -> id = null;
            $data['stateChangedDate'] = date('Y-m-d H:i:s');
        }
        else {
			$table -> load($data['id']);
			if ( $data['idJobState'] != $table -> idJobState ) {
				$data['stateChangedDate'] = date('Y-m-d H:i:s');
			}
		}
        if ( !empty($data['idCandidate'])) {
            $data['idCandidate'] = implode(',', $data['idCandidate']);
        }
        else {
            $data['idCandidate'] = '';
        }
        $table -> bind($data);
        
        if ( $table -> store() ) {
           
            return $table -> id;
        } 
        else {
           
            forEach( $table -> getErrors() as $error ) {
                $app -> enqueueMessage($error, 'danger');
            }
            
            return false;
        }
        
        
    }
    
    
    private function storeDocument($idEmployer, $idJob, $uploadedFiles) {

        if ( count($uploadedFiles) < 1  ) {
            return true;
        }
		
        forEach( $uploadedFiles as $uploadedFile) {
            if ($uploadedFile['name'] != '') {

                $storage = $this -> getCreateJobFolder($idJob);
                $fileExt = strtolower(File::getExt($uploadedFile['name']));
                $fileName = str_replace($fileExt, '', $uploadedFile['name']);
                $originalFile = $storage . '/' . $fileName;
                File::upload($uploadedFile['tmp_name'], $originalFile . $fileExt);
                /*
                $commonUtils->compressImage($originalFile . '.' . $fileExt);
                $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_small.' . $fileExt, 94, 94);
                $commonUtils->resizeImage($originalFile . '.' . $fileExt, $originalFile . '_medium.' . $fileExt, 300, 300);
                unlink($originalFile . '.' . $fileExt);
                */
//                echo str_replace(JPATH_SITE . '/', '', $originalFile) . $fileExt;
                $this -> storeFilePathToDB($idEmployer, $idJob, str_replace(JPATH_SITE . '/', '', $originalFile) . $fileExt );
               // $this -> storeBase64Image($this ->getDbo(), $idContact, $originalFile . '_small.' . $fileExt);

            }
            else {
                return true;
            }
        }
        
        
    }
    
    private  function storeFilePathToDB($idEmployer, $idJob, $documentFilePath) {
		$table = parent::getTable('Employerjobdocument');
		$table -> id = null;
		$table -> idJob = $idJob;
		$table -> idEmployer = $idEmployer;
		$table -> documentFilePath = $documentFilePath;
		$table -> store();
		$errors = $table -> getErrors();
		$errorMsg = '';
		forEach($errors as $error) {
			if ( strpos($error, 'Duplicate entry') !== false ) {
				continue;
			}
			else {
				throw new Exception($error);
			}
		}
	
	}
	
	
    
    private function getCreateJobFolder( $idJob) {
        $path = JPATH_SITE . "/images/job/" . $idJob ;
        
        if ( !file_exists ( $path ) ) {
            mkdir($path);
        }
        return $path;
    }
    
    
    
    private function insertTranslation(DatabaseDriver $db, $dataO) {
		
        return $db ->insertObject('#__elg_ergasia_job_translation', $dataO);
    } 
    
    private function updateTranslation(DatabaseDriver $db, $dataO) {
        
        return $db ->updateObject('#__elg_ergasia_job_translation', $dataO, ['language', 'idJob']);
    }
    
    private function translationExists($db, $language, $idJob) {
        $query = $db -> getQuery(true);
        $query -> select ("idJob") -> from ("#__elg_ergasia_job_translation") 
                -> where ("idJob = " . $idJob . " and language = " . $db -> quote($language) );
        $result = $db -> setQuery( $query ) -> loadResult();
        return ($result === null ? false: true);
    }
    
 
    
    
    private function getTranslationObject($values) {
        $o = new \stdClass();
        $o -> idJob = $values['idJob'];
        $o -> language = $values['language'];
        $o -> jobTitle = $values['jobTitle'];
        $o -> jobDescription = $values['jobDescription'];
        $o -> jobComment = '';
        $o -> jobCity = '';
        $o -> isDefault = false;
        $o -> isAutranslated = false;
        return $o;
    }

    
    protected function storeGeo($db, $values, $app ) {
        
        $idGeo = $this -> getExistingGeoId($db, $values['address'] );
        try {
            if ( $idGeo > 0 ) {
                $this ->updateGeo($db, $values, $idGeo);
            }
            else {
                $idGeo = $this ->insertGeo($db, $values);
            }
        }
        catch(Exception $e) {
            $app -> enqueueMessage($e -> getMessage(), 'danger');
            return false;
        }
        return $idGeo;
        
    }
    
    private function getExistingGeoId($db, $address) {
        $query = $db -> getQuery(true);
        $query -> select("id")
                -> from ("#__elg_geo")
                -> where(" address = " . $db -> quote($address) );
        return $db -> setQuery ( $query ) -> loadResult();
    }
    
    private function insertGeo($db, $values ) {
        $query = $db -> getQuery(true);
        $query -> insert("#__elg_geo")
                -> columns("city, county, country, address, postcode, lat, lng, geoPoint")
                -> values ($db -> quote($values['city']) . "," . $db -> quote($values['county']) . "," . $db -> quote($values['country'])  
                         . "," . $db -> quote($values['address']) . "," . $db -> quote($values['postcode'])
                         . "," . $values['lat'] . "," . $values['lng'] . ", Point(" . $values['lat'] . "," . $values['lng'] . ") ");
        $db -> setQuery($query) -> execute();
        return $db->insertid();
    }
    
    
    
    private function updateGeo($db, $values, $id) {
        $query = $db -> getQuery(true);
        $query  -> UPDATE ("#__elg_geo")
                -> set ("city= " .$db -> quote($values['city'])
                        . ", county= " . $db -> quote($values['county']) 
                        . ", country= " . $db -> quote($values['country']) 
                        . ", address= " . $db -> quote($values['address'])
                        . ", postcode= " . $db -> quote($values['postcode']) 
                        . ", lat= ". $values['lat'] . ", lng= ". $values['lng'] 
                        . ", geoPoint= Point(" . $values['lat'] . ", " . $values['lng'] . ")" )
                -> WHERE ("id = " . $id); 
        return $db -> setQuery ($query) -> execute();

    }
    

}
