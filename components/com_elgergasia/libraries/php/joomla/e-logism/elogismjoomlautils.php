<?php
/**
 * General Joomla utitlies .<br/>
 * @author Christoforos J. Korifidis
 * @copyright (c) e-logism 2013-2014. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/elogismjoomladbutils.php';
class ELogismJoomlaUtils extends JoomlaDBUtils
{
      
    
    /**
     * Enqueues a message only if it is custom application exception. That is a message with code  > 10000. Otherwise it shows the massage passed in the dfMessage parameter
     * @param Exception $e The exception to examin if it is custom application exception. That is an application exception with code > 10000
     * @param String $dfMessage The message to replace the exception message, if the excpetion is not a custom application exception. Default is empty string.
     * @isDebug Boolean. If true it always shows details message of the excecptions. Defaults to false;  
     * @return String. The message to be shown.
     */
    public static function onlyCustomErrorMessages(\Exception $e, $dfMessage = '', $isDebug = false)
    {
        JLog::add($e->getCode() . ', ' . $dfMessage . ', ' . $e->getFile() . ', ' . $e->getLine() . ', ' . $e->getMessage(), JLog::WARNING, 'error');
        return '(' . $e->getCode() . '): ' . ($e->getCode() > 10000 ? $e->getMessage() : $dfMessage ) . ( $isDebug ? ' [ ' . $e->getMessage() . '] <br /> file:' . $e->getFile() . ' <br /> line :' . $e->getLine () . ' <br />Trace<br />' . $e->getTraceAsString() : ''); 
    }
    
    /**
     * Returns Current Languge ID for use in sef e.g. "el".
     * @return Sting language sef indicator
     */
    public static function getLanguageSefTag()
    {
        $languages = JLanguageHelper::getLanguages();
        $lang_code = JFactory::getLanguage()->getTag();
        return $languages[$lang_code]->sef;
    }

    /**
      * This function converts a value to literally "Yes" or "No" or "Not set". The value is converted 
      * according to these rules:
      * 1. If the $conVal is -1 or "" then is converted to "Not set", (Component translatable constant COM_ELG_NOTSET).
      * 2. 0 or false then is converted to "No", (CMS translatable constant JNO).
      * 2. Anything else is converted to "Yes", (CMS translatable constant JYES).
      * @param Mixed $intVal The value we want to convert.      
      * @return String. The litteraly "Yes" or "No" or "Not set".
      */
     public static function getYesNo($conVal) {
        if ($conVal == -1 || $conVal == "") {
            return JText::_('COM_ELG_NOT_SET');
        }
        elseif ($conVal == 0 || $conVal == "" || $conVal === false ) {
            return JText::_('JNO');
        }
        else {
            return JText::_('JYES');
        }
    }
    
        
    /**
     * Deletes a directory and its contents
     * @param string $dirPath The directory to delete.
     * @throws InvalidArgumentException
     */
     public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            JLog::add("$dirPath must be a directory", JLog::ERROR, 'importer');
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    
    
    
    /**
     * Inserts a new row into a db table and return the new inserted id for that value.
     * Optionally checks if the row exists already exists. If the row exists it returns it's existing id.
     * If en error occurs it return -1.
     * 
     * @param JTable $dbTable The table into which we want to insert the value
     * @param array $values The values of the the row's columns. It must by in the form array("columnName", column Value, array(normRules))
     * @param String $id The name of the id column. Default is id.
     * @param boolean $checkExists If ture it will check if the row already exists. Default is true.
     * @return mixed The value of the id column.
     */
    
    public static function insertNewValue($dbTable, $values=array(), $idColumnName="id", $checkExists=true )
    {
        $cnt = count($values);
        if( $cnt <= 0) 
        {
            return -1;
        }
        $rV = array();
        for($i = $cnt -1; $i>=0; $i--)
        {
            $values[$i][1] = self::normData($values[$i][1], $values[$i][2]);
            $rV[$values[$i][0]] = $values[$i][1];
        }
        
        
        if($checkExists)
        {
            if($dbTable->load($rV))
            {
                return $dbTable->$idColumnName;
            }
        }
        for($i = $cnt -1; $i >=0; $i-- )
        {
            $dbTable->$values[$i][0] = $values[$i][1];
        }
        
        if($dbTable->store())
        {
            return $dbTable->$idColumnName;
        }
        else
        {
            return -1;
        }
        
    }
    
    /**
     * This function returns the pagination object to be used on data lists.
     * @param INT $totalRecords Total number of records retrieved.
     * @param INT $limitStart The current page.
     * @param INT $limit The number of records a page should have.
     * @return JPagination $pagination the paginatoin object.
     */
    public static function getPagination($totalRecords, $limitStart=0, $limit=null) {
        if($limit == null) {
            self::getComponentParams()->get('listLimit', 50);
        }
        $pagination = new JPagination($totalRecords, $limitStart, $limit);
        $pagination->setAdditionalUrlParam('cp', 1);
        return $pagination;
    }
    
    /**
     * Resizes the dimensions of an Image
     * @param String originalFile Path to the original fiel to resize. 
     * @param String destinationFile Full image path where the new resized image will be stored.
     * @param Int width The new width of the image.
     * @param Int height The new height of the image.
     */
    public static function resizeImage($originalFile, $destinationFile, $width, $height) {
      
        $image = new JImage($originalFile);
        
        if($image->getWidth() > 0)
        {
            $properties = JImage::getImageFileProperties($originalFile);
            $resizedImage = $image->resize($width, $height, true);
            $resizedImage->toFile($destinationFile, $properties->type);
        }
    }    
    
    /**
     * Redirects to a given url optionally with a message, Teh redirections is using jroute
     * @param String $redirectUrl The url to redirect
     * @param String $msg The optionally message
     * @param String $msgType The message type. Default to empty string.
     * @param boolean $xhtml The parametere $xhtml from JRoute::_ function. Replace & with &amp; from xhtml complianece. Default is true.
     * @param integer $ssl The ssl parameter from JRoute::_ function.
     * $param boolean $moved The moved parameter of application redirect. if true a header of moved permantly will be added. Defautl is false
     */    
    public static function redirectWithMessage($redirectUrl, $msg ='', $msgType = '', $xhtml = true, $ssl = null, $moved = false) {
        if($msgType !== '')
        {
            JFactory::getApplication() -> enqueueMessage($msg, $msgType);
        }
        if($redirectUrl != '' ) 
        {
            JFactory::getApplication() -> redirect(JRoute::_($redirectUrl, $xhtml, $ssl), $moved);
        }
    }
	
	
}
