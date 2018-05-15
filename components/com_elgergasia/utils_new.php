<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );

 /**
  * Class f that holds static functions used by e-logism's components.
  * @package e-logism.joomla;
  * @author Christoforos J. Korifidis
  * 
  */


class Utils {
    const COMPONENT_FOLDER = 'com_elgergasia';
    const COMPONENT_NAME = 'elgergasia';
    const COMPONENT_URL_LOCALE ='el';
    const COMPONENT_DB_LOCALE='el-GR';
    const VIEW_TO_REPLACE_WITH_DEFAULT = 'jobs';
    
     /**
     * 
     * @return STRING The default path where xml forms files redides.
     */
    public static function getDefaultFormPath() {
        return JPATH_COMPONENT_ADMINISTRATOR . '/models/forms';
    }
    
    /**
     * This function checks to see if a user is priviliged to see additional info. The function return a tru or flase value that has stored in the useer session.
     * @param INT $idUser The id of the user to check.
     * @return BOOLEAN A true or false value that indicaties whether the user can see priviliged info. This boolean variable existe in the session key
     * com_elgergasia.canSeeContactInfo.
     */
    public static function canSeeContactInfo($idUser=null) {
        $session = JFactory::getSession();
        if($session->get('com_elgergasia.canSeeContactInfo') == null){
            $aViewLevels = JFactory::getUser($idUser)->getAuthorisedViewLevels();
            $params = CommonUtils::getComponentParams();
            if (/**in_array($params->get('candidateLevel', self::DEFAULT_AUTHORIZE_VIEW_LEVEL_CANDIDATE), $aViewLevels)
                    || in_array($params->get('employersLevel', self::DEFAULT_AUTHORIZE_VIEW_LEVEL_EMPLOYER), $aViewLevels)
                    || **/ in_array($params->get('jobAgent', self::DEFAULT_AUTHORIZE_VIEW_LEVEL_JOBAGENT), $aViewLevels)
                    ){
                $session->set('com_elgergasia.canSeeContactInfo', true);
            }
            else {
                $session->set('com_elgergasia.canSeeContactInfo', false);
            }
        }
        return true; //$session->get('com_elgergasia.canSeeContactInfo');
    }
    
     /**
     * Gets basic state data from joomla.CommonUtils and add any extra data that are common to the aplication.
     * Extra data are also sanitated. These extra data are:
      * 1. idCustomer
      * 2. idProject
      * 3. lang
      * 
     * @param JInput $input the input object to use use for reading request.
      * if no input given gets the default JInput from the application object.
     */
    public static function getBasicStateData(JInput $input = null) {
        if ($input == null) {
            $input = JFactory::getApplication()->input;
        }
                    
        $request =  CommonUtils::getBasicStateData($input);
        $request['idCustomer'] = $input->getInt('idCustomer',0);
        $request['idProject'] = $input->getInt('idProject',0);
        $request['idProjectState'] = $input->getInt('idProjectState',0);
        $request['lang'] =  $input->getWord('lang', self::COMPONENT_URL_LOCALE);
        $request['typeview'] = $input->getWord('typeview','');
        $request['idStep'] = $input->getInt('idStep',0);
        $request['reset'] = $input->getInt('reset',0);
        $request['idImplementation'] = $input->getInt('idImplementation',0);
        $input->set('basicData', $request);
        return $request;
    }
    
    public static function authorsedForAgent($retTo, $msg, $msgType='error') {
         if(!self::canSeeContactInfo()) {
            JFactory::getApplication()->redirect($retTo, $msg, $msgType);
        }
    }
    
    
    public static function getHypsometriesNL($data,$idHypsometryType, $form)
    {
        $value = str_replace(',', PHP_EOL, $data);
        switch ($idHypsometryType)
        {
            case 3:
                $form->setValue('hypsometries', null, $value);
                break;
            case 4:
                $form->setValue('dryHeight', null, $value);
                break;
            case 5:
               $form->setValue('area', null, $value);
                break;
            case 6:
                $form->setValue('perimeter', null, $value);
                break;
            case 7:
                $form->setValue('measurementArea', null, $value);
                break;
            case 8:
                $form->setValue('measurementFrameMeters', null, $value);
                break;
            case 9:
                $form->setValue('measurementCornerStuff', null, $value);
                break;
            case 10:
                $form->setValue('measurementSkoties', null, $value);
                break;
            case 11:
                $form->setValue('measurmentKornizes', null, $value);
                break;
            case 12:
                $form->setValue('measurementBoxesPipes', null, $value);
                break;
            case 13:
                $form->setValue('measurementLampades', null, $value);
                break;
            case 14:
                $form->setValue('measurementsadd', null, $value);
                break;
            case 15:
                $form->setValue('measurementssubstract', null, $value);
                break;
             case 16:
                $form->setValue('measurements', null, $value);
                break;
            case 17:
                $form->setValue('measurementsarea', null, $value);
                break;
            case 18:
                $form->setValue('measuremetnsareasubt', null, $value);
                break;
            case 19:
                $form->setValue('measuremetnshypsometries', null, $value);
                break;
            case 20:
                $form->setValue('mesuremetnsdryHeight', null, $value);
                break;
           case 21:
                $form->setValue('measurementsPerimeter', null, $value);
                break;
            case 22:
                $form->setValue('measurementsHypsometriesOutside', null, $value);
                break;
            case 23:
                $form->setValue('measurementsHypsometriesInside', null, $value);
                break;
            case 24:
                $form->setValue('measurementAreaOutside', null, $value);
                break;
             case 25:
                $form->setValue('measurementAreaInside', null, $value);
                break;
              case 26:
                $form->setValue('measurementPerimetricOutside', null, $value);
                break;
            case 27:
                $form->setValue('measurementPerimetricInside', null, $value);
                break;
            case 28:
                $form->setValue('measurementsHypsometries', null, $value);
                break;
            case 29:
                $form->setValue('areaSM', null, $value);
                break;
            case 30:
                $form->setValue('areaSMSub', null, $value);
                break;
            case 31:
                $form->setValue('moldMeters', null, $value);
                break;
             case 32:
                $form->setValue('downloadMeters', null, $value);
                break;
            case 33:
                $form->setValue('corners', null, $value);
                break;
            case 34:
                $form->setValue('corners45', null, $value);
                break;
            case 36:
                $form->setValue('measurementsHypsometriesOutside', null, $value);
                break;
            case 37:
                $form->setValue('measurementsHypsometriesInside', null, $value);
                break;
            case 38:
                $form->setValue('measurementAreaOutside', null, $value);
                break;
             case 39:
                $form->setValue('measurementAreaInside', null, $value);
                break;
            case 40:
                $form->setValue('measurementPerimetricOutside', null, $value);
                break;
            case 41:
                $form->setValue('measurementPerimetricInside', null, $value);
                break;
        }
    }
    
    /**
     * This function returns the next step for a given project type and a given project step.
     * @param INT $idProjectType The project type of a project we are examining.
     * @param INT $idCurrentStep The current project step of a project we are examining.
     * @return INT The id of the next step of a project we are examining.
     */
    public static function getNextImplementationStep($idProjectType, $idCurrentStep)
    {
        if($idCurrentStep == 0)
        {
            switch($idProjectType)
            {
                case 1: return 14;
                case 6: return 22;
                case 7: return 24;
                case 4: return 27;
                case 2: return 30;
                case 15: return 35;
                case 5: return 41;
                case 8: return 43;
            }
        }
        else
        {
             switch($idCurrentStep)
            {   
             
                case 14: return 17;
                case 17: return 18;
                case 18: return 20;
                case 20: return 12;
                    
                case 22: return 23;
                case 23: return 12;
                    
                case 24: return 25;
                case 25: return 26;
                case 26: return 12;
                    
                case 27: return 28;
                case 28: return 29;
                case 29: return 12;
                    
                case 30: return 31;
                case 31: return 32;
                case 32: return 33;
                case 33: return 34;
                case 34: return 12;
                
                case 35: return 36;
                case 36: return 37;
                case 37: return 38;
                case 39: return 40;
                case 40: return 12;
                
                case 41: return 42;
                case 42: return 12;
                    
                case 43: return 44;
                case 44: return 45;
                case 45: return 46;
                case 46: return 12;
            }
            
        }
        return 0;
    }
    
    public static function getInitImplementationSteps()
    {
        return array(22, 24, 27, 30,35, 41, 43);
    }
    
    
    public static function getPjojectTypeImplementationCode($idProjectType)
    {
        switch($idProjectType)
        {
            case 1: return 'ΘΔΩ';
            case 6: return 'ΣΑΜ';
            case 7: return 'ΥΔΑ';
            case 4: return 'ΣΥΠ';
            case 2: return 'ΘΠΡ';
            case 15: return 'ΣΒΔ';
            case 5: return 'ΥΔΡ';
            case 8: return 'ΣΤΔ';
        }
        return '';
    }
    public static function storeHypsometries($db, $data)
    {
        $query = $db->getQuery(true);
        $query->delete('#__elg_ergon_projectstates_hypsometries')->where("idProjectState=" . $data->idProjectState . " and idHypsometryType = " . $data->idHypsometryType);
       //$dbg  = $query->dump();
        $db->setQuery($query);
        $db->execute();
        $values = explode(PHP_EOL, $data->values);
        $row = new stdClass();
        $row->idProjectState = $data->idProjectState;
        for($i=count($values)-1; $i >=0; $i--) 
        {
            if(trim($values[$i] != ""))
            {
                $row->idHypsometryType = $data->idHypsometryType;
                $row->length1 = $values[$i];
                $db->insertObject('#__elg_ergon_projectstates_hypsometries', $row);
                
            }
            $row->idHypsometryType = null;
            $row->length1 = null;            
        }
    }
    
    
}    



?>
