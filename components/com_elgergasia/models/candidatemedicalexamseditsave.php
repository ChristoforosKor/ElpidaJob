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
 class ElgergasiaModelCandidateMedicalExamsEditSave extends JModelDatabase{ 
    public function __construct() {
        parent::__construct();
   }
    
   function setState(JRegistry $data) {
        $inp = JFactory::getApplication()->input;
        $language = $inp->post->getCMD('language');
        $table = JTable::getInstance('candidatemedicalexam');
        $storePlace = $data->get('storeFolder');
        $idUser = $data->get('idUser');
      
        $uploadedFile = $data->get('uploadedFile');
        if($uploadedFile->name != '') {
            $fileName = $idUser . '_' . date('YmdHis') . "." . strtolower(JFile::getExt($uploadedFile->name));
            $table->examFile = $fileName;
            $originalFile =  $storePlace  . '/' . $fileName ;
            jFile::upload($uploadedFile->tmp_name, $originalFile);
        }
        $id = $data->get('id', 0);
        if($table->examFile != '' || $id > 0) {
            $form = $data->get('formData');
            if($id > 0) $table->id = $id;
            $table->idUser = $idUser;
            $table->examDate =   $form->examDate;
            $table->store();
            $title = ComponentUtils::normData($form->examTitle, ['nogreekaccent', 'similar2Greek', 'escapeQuotes', 'siglewhitespace', 'upper']);
            
            if($title != '') {
                $data2Store = array('examTitle'=>$title, 'language'=> $language);
            }
            else {
                $data2Store = array();
            }
            Translations::saveTranslation('candidatemedicalexamtranslation', '#__elg_ergasia_candidate_medicalexam_translation', $table->id, 'idMedicalExam', $data2Store);
        }             
        parent::setState($data);
    }
    
        
}
?>