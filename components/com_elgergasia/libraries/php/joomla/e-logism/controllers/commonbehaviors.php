<?php
/*------------------------------------------------------------------------
# com_elgsustainability - e-logism, dexteraconsulting  application
# ------------------------------------------------------------------------
# copyright Copyright (C) 2014 e-logism, dexteraconsulting. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr, http://dexteraconsulting.com
----------------------------------**/
defined( '_JEXEC' ) or die( 'Restricted access' );

class CommonBehaviors 
{   
//    /**
//     * Binds submited data to the forms thsi controller manages
//     * @param array<string> $forms Array with forms objects.
//     * @param array $data the data submitted by the form.
//     */
//    public function bindArrayManually($forms, $data)
//    {
//       
//        foreach($data as $key=>$item):
//            if(is_array($item)) :
//                foreach($item as $key2=>$subItem):
//                    $data[$key . '[' .$key2 . ']'] = $subItem;                
//                endforeach;
//                unset($subItem);
//                unset($data[$key]);
//            endif;
//        endforeach;
//        unset($item);
//        unset($key);
//        foreach($forms as $form):
//            $form->bind($data);            
//        endforeach;
//        unset($form);
//        return $forms;
//    }
    
    /**
     * Validates given forms
     * @param JForm $forms JForm object to validate against the data.
     * @param Array $data Data to bind and validate with forms
     */
    
    public function validateForm($form , $data = array()) 
    {
        try{
            $form->validate($data);
            foreach($form->getErrors() as $error):
                JFactory::getApplication()->enqueueMessage($error->getMessage(), 'warning');
            endforeach;
            unset($error);
        } catch (Exception $ex) {
            JFactory::getApplication()->enqueueMessage(JText::_('COM_ELG_ERROR_PAUSE') . ': ' . $ex->getCode(), 'error');
            JLog::add(JText::_('COM_ELG_ERROR_PAUSE') . ': ' . $ex->getMessage(), jLog::ERROR, 'com_elgsustainabiliity');
        }        
    }  
    
     
   
}