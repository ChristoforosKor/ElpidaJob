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
 class ElgergasiaModelCandidatePhotosSave extends JModelDatabase{ 
    public function __construct() {
        parent::__construct();
   }
    
//   function setState(JRegistry $data) {
//        $table = JTable::getInstance('candidatesphotos','Table');
//        $storePlace = $data->get('storeFolder');
//        $idUser = $data->get('idUser');
//        for($i=1; $i <= 3; $i++) {
//            $uploadedFile = $data->get('uploadedFile' . $i);
//            if($uploadedFile->name != '') {
//                $fileName = $idUser . '_' . $i;
//                $fileExt = strtolower(JFile::getExt($uploadedFile->name));
//                $table->id = $data->get('id' .  $i);
//                $table->idUser = $idUser;
//                $table->idPhotoType = $i;
//                $table->photo =   $fileName;
//                $table->photoExtension = $fileExt;
//                $table->store();
//                $originalFile =  $storePlace  . '/' . $fileName ;
//                jFile::upload($uploadedFile->tmp_name, $originalFile . '.' . $fileExt);   
//                CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_thumb.' . $fileExt , 250, 170);
//                CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_large.' . $fileExt , 600, 390);
//            }
//        }
//        parent::setState($data);
//    }
    
        function setState(JRegistry $data) {
        $table = JTable::getInstance('candidatesphotos','Table');
        $storePlace = $data->get('storeFolder');
        $idUser = $data->get('idUser');
        for($i=1; $i <= 3; $i++) {
            $uploadedFile = $data->get('uploadedFile' . $i);
            if($uploadedFile->name != '') {
                $fileName = $idUser . '_' . $i;
                $fileExt = strtolower(JFile::getExt($uploadedFile->name));
                $table->id = $data->get('id' .  $i);
                $table->idUser = $idUser;
                $table->idPhotoType = $i;
                $table->photo =   $fileName;
                $table->photoExtension = $fileExt;
                $table->store();
                $originalFile =  $storePlace  . '/' . $fileName ;
                jFile::upload($uploadedFile->tmp_name, $originalFile . '.' . $fileExt);   
                $this -> compressImage($originalFile . '.' . $fileExt);
                $this -> makeImageVersions($originalFile, $fileExt);
                unlink($originalFile . '.' . $fileExt);
            }
        }
        parent::setState($data);
    }
    
    private function compressImage($originalFile)
    {
        imagejpeg( imagecreatefromjpeg( $originalFile ), $originalFile, 60 );      
    }
    
    private function makeImageVersions($originalFile, $fileExt)
    {
        CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_medium.' . $fileExt , 250, 250);
        CommonUtils::resizeImage( $originalFile . '.' . $fileExt, $originalFile . '_large.' . $fileExt , 800, 800);
    }
}