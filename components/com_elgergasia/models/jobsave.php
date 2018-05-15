<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 jimport('joomla.filesystem.file');
 include JPATH_COMPONENT_SITE .'/libraries/joomla/models/translations.php';   
 class ElgergasiaModelJobSave extends JModelDatabase{ 
  
   private $form = null;
    
   public function __construct() {
        parent::__construct();       
        $this->form = JForm::getInstance('job', JPATH_COMPONENT . '/models/forms/job.xml');
    }  
    
    public function setState(JRegistry $state) {
        $inp = JFactory::getApplication()->input;
        $language = $inp->post->getString('language');
        $data = $state->toArray();
        $data['language'] =  $language;
        $table = JTable::getInstance('job');
        $table->bind($data);
        
        if(!$table->store()) {
            $state->set('errors', $table->getErrors());
        }
        else {
           $state->set('id', $table->id);
           Translations::saveTranslation('jobtranslation', '#__elg_ergasia_job_translation', $table->id, 'idJob', $data);
        }
       	$table2 = JTable::getInstance('jobphoto');
        $storePlace = $state->get('storeFolder');
	for($i=1; $i <= 3; $i++) {
            $uploadedFile = $state->get('uploadedFile' . $i);
	    if($uploadedFile->name != '') {
                $fileName = $table->id . '_' . $i;
                $fileExt = strtolower(JFile::getExt($uploadedFile->name));
		$found = $table2->load(array('idJob'=>$table->id, 'idPhotoType'=>$i));
		if($found === false)
		{
                    $table2->id = null;
		}
		$table2->idJob = $table->id;
                $table2->idPhotoType = $i;
                $table2->jobPhoto =   $fileName;
                $table2->photoExtension = $fileExt;
                $table2->store();
		$originalFile =  $storePlace  . '/' . $fileName ;
                jFile::upload($uploadedFile->tmp_name, $originalFile . '.' . $fileExt);   
                CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_thumb.' . $fileExt , 150, 150);
                CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_medium.' . $fileExt , 250, 250);
                CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_large.' . $fileExt , 800, 800);
            }
        }
        parent::setState($state);
    }
}