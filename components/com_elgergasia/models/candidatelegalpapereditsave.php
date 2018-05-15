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
 class ElgergasiaModelCandidateLegalPaperEditSave extends JModelDatabase{ 
    public function __construct() {
        parent::__construct();
   }
    
   function setState(JRegistry $data) {
        $table = JTable::getInstance('candidatelegalpaper');
        $storePlace = $data->get('storeFolder');
        $inp = JFactory::getApplication()->input;
        $language = $inp->post->getCMD('language');
        $idUser = $data->get('idUser');
        $uploadedFile = $data->get('uploadedFile');
        if($uploadedFile->name != '') {
            
            $fileName = $idUser . '_' . date('YmdHis') . "." . strtolower(JFile::getExt($uploadedFile->name));
            
            $table->legalFile = $fileName;
            $originalFile =  $storePlace  . '/' . $fileName ;
            jFile::upload($uploadedFile->tmp_name, $originalFile);
            $ext = pathinfo($uploadedFile->name, PATHINFO_EXTENSION);
            if($ext === 'jpg' || $ext === 'jpeg'):
                imagejpeg( imagecreatefromjpeg( $originalFile ), $originalFile, 70 );
            endif;
        }
        $id = $data->get('id', 0);  
        if($table->legalFile != '' || $id > 0) {
            $form = $data->get('formData');
            if($id > 0) $table->id = $id;
            $table->idUser = $idUser;
            $table->legalDateExpire =   $form->legalDateExpire;
            $table->store();
            
            $title = $form->legalTitle;
            if($title != '') {
                $data2Store = array('legalTitle'=>$title, 'language'=>$language  );
            }
            else {
                $data2Store = array();
            }
            Translations::saveTranslation('candidatelegalpapertranslation', '#__elg_ergasia_legalpaper_translation', $table->id, 'idLegalPaper', $data2Store);
            
               
                
        }
        parent::setState($data);
    }
    
        
}
?>