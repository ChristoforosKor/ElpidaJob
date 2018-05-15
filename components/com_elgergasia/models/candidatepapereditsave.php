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
 class ElgergasiaModelCandidatePaperEditSave extends JModelDatabase{ 
    public function __construct() {
        parent::__construct();
   }
    
   function setState(JRegistry $data) {
        $table = JTable::getInstance('candidatepaper');
        $storePlace = $data->get('storeFolder');
        $idUser = $data->get('idUser');
        $inp = JFactory::getApplication()->input;
        $language = $inp->post->getCMD('language');
        $uploadedFile = $data->get('uploadedFile');
        if($uploadedFile->name != '') {
            $fileName = $idUser . '_' . date('YmdHis') . "." . strtolower(JFile::getExt($uploadedFile->name));
            $table->paperFile = $fileName;
            $originalFile =  $storePlace  . '/' . $fileName ;
            jFile::upload($uploadedFile->tmp_name, $originalFile);   
        }
        $id = $data->get('id', 0);
        if($table->paperFile != '' || $id > 0) {
            $form = $data->get('formData');
            if($id > 0) $table->id = $id;
            $table->idUser = $idUser;
            $table->store();
            $title = $form->paperTitle;
            if($title != '') {
                $data2Store = array('paperTitle'=>$title, 'language'=>$language );
            }
            else {
                $data2Store = array();
            }
            Translations::saveTranslation('candidatepapertranslation', '#__elg_ergasia_candidate_paper_translation', $table->id, 'idCandidatePaper', $data2Store);            
        }
        parent::setState($data);
    }
    
        
}
?>