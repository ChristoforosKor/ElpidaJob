<?php
namespace ELG\Component\ElgJobs\Site;

use Joomla\CMS\Image\Image;
use Joomla\CMS\Factory;
use Joomla\CMS\Filesystem\File;
class CommonUtils {
   
  
   
   

     /**
      * This function converts a value to literally "Yes" or "No" or "Not set". The value is converted 
      * according to these rules:
      * 1. If the $conVal is -1 or "" then is converted to "Not set", (Component translatable constant COM_ELG_NOTSET).
      * 2. 0 or false then is converted to "No", (CMS translatable constant JNO).
      * 2. Anything else is converted to "Yes", (CMS translatable constant JYES).
      * @param Mixed $intVal The value we want to convert.      
      * @return String. The litteraly "Yes" or "No" or "Not set".
      */
     public  function getYesNo($conVal) {
        if ($conVal == -1 || $conVal == "") {
            return JText::_('COM_ELG_NOTSET');
        }
        elseif ($conVal == 0 || $conVal == "" || $conVal === false ) {
            return JText::_('JNO');
        }
        else {
            return JText::_('JYES');
        }
    }
    
    
    
     
    /**
     * This function return the necessary values for a data list in a from of an array.
     
     * 
     * @param JInput $input The input object to be use for retrieving data from the request.
     * @param String $sessionNamespece The namspce of the session where the keys of the corresponding data belongs.
     * @param String $defaultOrder The column on which the data will be ordered by default.
     * @param String $orderDir The default ordering direction.
     * 
     * @return Array An array containg the values needed for creating lists of data. the array contains the following keys:
     *  1. limitastart : starting page counting from 0.
     *  2. limit: number of rows in the list.
     *  3. filter_order: the column on which the data are going to be order by
     *  4. filter_order_Dir: the direction of the ordering (asc or desc). 
     * 
     */
    public  function getListParams($input, $sessionNamespace, $defaultOrder, $defaultOrderDir='asc') {
        $listParams = array();
        $session = Factory::getSession();
        $params = self::getComponentParams();
        $listParams['limitstart'] = ($input->getInt('cp',0) == 1? $input->getInt('limitstart', 0): 0); 
        $listParams['limit'] = self::getRequestNoNull('limit', $params->get('listLimit', 50), $input->getInt('limit', null), $session, $sessionNamespace); 
        $listParams['filter_order'] =  self::getRequestNoNull('filter_order', $defaultOrder, $input->getWord('filter_order', null), $session, $sessionNamespace); 
        $listParams['filter_order_Dir'] =  self::getRequestNoNull('filter_order_Dir', $defaultOrderDir, $input->getWord('filter_order_Dir', null), $session, $sessionNamespace);
        return $listParams;
    }
    
    /**
     * This function returns the pagination object to be used on data lists.
     * @param INT $totalRecords Total number of records retrieved.
     * @param INT $limitStart The current page.
     * @param INT $limit The number of records a page should have.
     * @return JPagination $pagination the paginatoin object.
     */
    public  function getPagination($totalRecords, $limitStart=0, $limit=null) {
        if($limit == null) {
            self::getComponentParams()->get('listLimit', 50);
        }
        $pagination = new JPagination($totalRecords, $limitStart, $limit);
        $pagination->setAdditionalUrlParam('cp', 1);
        return $pagination;
    }
    
    
    public function resizeImage($originalFile, $destinationFile, $width, $height) {
      
        $image = new Image($originalFile);
        $properties = Image::getImageFileProperties($originalFile);
        $resizedImage = $image->resize($width, $height, true);
//        $mime = $properties->mime;
//        if ($mime == 'image/jpeg') {
//            $type = IMAGETYPE_JPEG;
//        }
//        elseif ($mime = 'image/png') {
//            $type = IMAGETYPE_PNG;
//        }
//        elseif ($mime = 'image/gif') {
//            $type = IMAGETYPE_GIF;
//        }       
        $resizedImage->toFile($destinationFile, $properties->type);
    }
    
    /**
     * 
     * @param String $folderPath where to store the files
     * @param array $uploadedFiles PHP uploaded files array
     * @return array [ $fileName => $storedFile, $fileName => '' (if file not stored because of error), ..] . 
     * Shows the result of the upload process for each file.
     */
    public function storeDocument( $folderPath, $uploadedFiles, $id ='') {

        $result = [];
               
        forEach( $uploadedFiles as $uploadedFile) {
            if ($uploadedFile['name'] != '') 
            {
                $storage = $this -> getCreateUploadFolder($folderPath);
                $fileExt = strtolower(File::getExt($uploadedFile['name']));
                $fileName = str_replace($fileExt, '', $uploadedFile['name']);
                $originalFile =  $storage . '/' . $id . '_' . $fileName;
                if ( File::upload($uploadedFile['tmp_name'], $originalFile . $fileExt) ) 
                {
                    $result[$uploadedFile['name']] = $originalFile . $fileExt;
                }
                else
                {
                   $result[$uploadedFile['name']] = ['']; 
                }
            }            
        }
        unset($uploadedFile);
        return $result;
    }
    
    
     
    public function getCreateUploadFolder( $folderPath) {
        if ( !file_exists ( $folderPath ) ) {
            mkdir($folderPath);
        }
        return $folderPath;
    }
    
    
    
    
     public  function getMonths1stDate($month=null, $year = null){
        $year = ($year == null)? date('Y'): $year;
        $month = ($month == null)? date('m') :$month;
        return  mktime (0, 0, 0, $month, 1, $year);
    }
    
    public  function getMonthsLasttDate($month=null, $year = null){
        $year = ($year == null)? date('Y'): $year;
        $month = ($month == null)? date('m') + 1 :$month;
        return  mktime(23, 59, 59, $month, 0,   $year);
    }
    
    public  function getDateFormated($date='0000-00-00',$format='d/ m/ Y') {
       // if($date == '0000-00-00' || checkdate()) {
        if(strtotime($date))   
        {
            return date($format, strtotime($date));
            
        }
        else {
            return JText::_('COM_ELG_NOTSET');
        }
    }
    
    
    public function compressImage($originalFile, $quality = 60)
    {
        imagejpeg( imagecreatefromjpeg( $originalFile ), $originalFile, $quality );      
    }
    
    
     
    /*************************** Component Specific *******************************/
    
    public function isOfficeUser() {
        $groups = Factory::getUser() -> getAuthorisedGroups();
        if ( in_array(12, $groups) ) {
            return true;
        }
	return false;
    }
    
    
    
     
    public function getDistanceKm($idDistance) 
    {

        switch ($idDistance) {
            case 2:
                return '10';
            case 3:
                return '20';
            case 4:
                return '50';
            default:
                return  '';
        }
    }
}
