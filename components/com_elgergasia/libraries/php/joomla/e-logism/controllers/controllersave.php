<?php
/*------------------------------------------------------------------------
# com_elgsustainability - e-logism, dexteraconsulting  application
# ------------------------------------------------------------------------
# copyright Copyright (C) 2014 e-logism, dexteraconsulting. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr, http://dexteraconsulting.com
----------------------------------**/
defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/controller.php';        
require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/commonbehaviors.php'; 

/**
 * Class that holds common procedure for all controllers that manage submitted data.
 * 
 */

class ControllerSave extends Controller
{
   /**
     *
     * @var Array<String>   $formNames holds the form names that the subclass controller will manages their data.
     *  
     */
    protected $formNames = array();
    
   
    /**
     *
     * @var Array $submittedData The data submitted by the user. Witrh defaults filters applied.
     */
    protected $submitedData = array();
    
//    protected function __construct(\JInput $input = null, \JApplicationBase $app = null) {
//        parent::__construct($input, $app);
//        $bh = new CommonBehaviors();       
//   
//    }
    
       
    public function execute() 
    {
       // $bh = new CommonBehaviors();
        $forms = array();
  
        $inp = $this->getInput();
        $submData = $inp->getArray();
        foreach($this->formNames as $formName):
            $forms[$formName] = JForm::getInstance($formName, JPATH_COMPONENT_SITE . '/models/forms/' . $formName . '.xml'); 
            $filteredData = $inp->getArray(self::getFormFiltersRules($forms[$formName], $submData));
            if($forms[$formName]->validate($filteredData)):
                $forms[$formName]->bind($filteredData);
            endif;
        endforeach;
        
        $appData = $inp->get('appData', array(), 'ARRAY');
        $model = Factory::getModel($appData['componentname'], $appData['model'], new JRegistry($appData));
        if(!ComponentUtils::hasErrorMessages(JFactory::getApplication()->getMessageQueue())):
            $state = new JRegistry();
            $state->set('forms', $forms);
            $state->set('filteredData', $filteredData);
            $model->setState($state);
        endif;
        echo Factory::getView($appData['componentname'], $appData['view'],  $model, $appData['format'])->render();
    }   
    

    
    
//    /**
//     * Binds submited data to the forms thsi controller manages
//     * @param array<string> $forms Array with form names. If no data given them memebr variable will be used. The memeber variable is populated by the subclasses and usually containes all the formnames the subclass controller manages.
//     * @param array $data the data submitted by the form. If no data given the memeber variable will be used. The memeber variable defaults to all teh data submitted.
//     */
//    protected function bindDataToForms($formNames = null, $data = null)
//    {
//        $forms = array();
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
//        foreach($formNames as $formName):
//            $forms[$formName] =  JForm::getInstance($formName);
//            $forms[$formName]->bind($data);            
//        endforeach;
//        unset($formName);
//    }
    
    /**
     * makes a mutlidimensional array singlie dimension using as key a string that contains all subkeys.
     * @param Array $data the data array to make flat.
     * @return Array the array with the flatten data.
     */
//    public static function makeDataFlat($data)
//    {
//        $flatData = array();
//        foreach($data as $key=>$item):
//            if(is_array($item)) :
//                foreach($item as $key2=>$subItem):
//                    $flatData[$key . '[' .$key2 . ']'] = $subItem;                
//                endforeach;
//                unset($subItem);
//                unset($key2);
//            else:
//                $flatData[$key] = $item;
//            endif;
//        endforeach;
//        unset($item);
//        unset($key);
//        return $flatData;
//    }
//    
    /**
     * Utility function to return an array with form filters rules that must be applied on some data. 
     * @param JForm $form
     * @param array $submData
     * @return array The array with ther rules.
     */
    
    public static function getFormFiltersRules(JForm $form, Array $submData)
    { 
        $fR = array();
        foreach($submData as $key=>$sDItem):
            if(is_array($sDItem)):
                $fR[$key] = array();
                foreach(array_keys($sDItem) as $key2):
                    $fR[$key][$key2] = $form->getFieldAttribute($key . '[' . $key2 . ']', 'filter', 'STRING');
                endforeach;              
                unset($key2);
            else:
                $fR[$key] = $form->getFieldAttribute($key, 'filter', 'STRING');
            endif;
        endforeach;
        unset($key);
        unset($sDItem);
        return $fR;
    }
    
    
   
    public function getInvalidFromFilters(array $submData, array $filteredData)
    {
        $invalid = array();
        foreach($filteredData as $key=>$item):
            if(is_array($item)){
                $invalid =  array_merge($invalid, $this->getInvalidFromFilters($item, $submData[$key]));
            }
            elseif($item != $submData[$key])
            {
                $invalid[$key] = $item;
            }
        endforeach;
        unset($key);
        unset($item);
        return $invalid;
    }
    
    public static function validateFilters(array $data, array $rules)
    {
        
    }
    
    
//        $app = JFactory::getApplication();
//        
//        
//        foreach($form->getFieldset() as $field):
//            $filter = $field->getAttribute('filter', '');
//            $name = $field->getAttribute('name');
//            $p1 = strpos($name, '[');
//            if($p1 !== false):
//                $ind1= substr($name, $p1);
//                $ind0 = str_replace($ind1, '', $name);
//                $nInd1 = str_replace(']', '', str_replace('[', '', $ind1));
//                $v1 = $inp->get('sector_property_id', null, ($filter === '' ? 'STRING' : $filter));
//            else: 
//                $v1 = $inp->get($name, null, ($filter === '' ? 'STRING' : $filter));
//            endif;
//            $v2 = $flatData[$name];           
//            if( $v1 !== $v2 ):
//                $message = $field->getAttribute('message', '');
//                $app->enqueueMessage(($message === '' ? JText::_('COM_ELG_WRONG_DATA') : $message). ': ' . JText::_('COM_ELG_FIELD') . ' ' . $field->getAttribute('label'), 'error');
//            endif;               
//        endforeach;
   // }   
}