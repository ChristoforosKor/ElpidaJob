<?php
/*------------------------------------------------------------------------
# com_elglibraries - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/


class Utils {
   
    const DEFAULT_AUTHORIZE_VIEW_LEVEL_CANDIDATE = 6;
    const DEFAULT_AUTHORIZE_VIEW_LEVEL_EMPLOYER = 7;
    const DEFAULT_AUTHORIZE_VIEW_LEVEL_JOBAGENT = 8;
    const COMPONENT_FOLDER = 'com_elgergasia';
    const COMPONENT_NAME = 'elgergasia';
    
    
    /**
     * This function checks to see if a user is priviliged to see additional info. The function return a tru or flase value that has stored in the useer session.
     * @param INT $idUser The id of the user to check.
     * @return BOOLEAN A true or false value that indicaties whether the user can see priviliged info. This boolean variable existe in the session key
     * com_elgergasia.canSeeContactInfo.
     */
    public static function canSeeContactInfo($idUser=null) {
        $session = JFactory::getSession();
        $arrRestrGorups = array(1, 9, 13, 14);
        $user = JFactory::getUser();
        //if($session->get('com_elgergasia.canSeeContactInfo') == null){
        $canSee = false;
        if(count(array_intersect($arrRestrGorups, $user->groups)) > 0  ) {
           $canSee = false;
           $session->set('com_elgergasia.canSeeContactInfo', false);
        }
        else {
            $aViewLevels = JFactory::getUser($idUser)->getAuthorisedViewLevels();
            $params = CommonUtils::getComponentParams();
            $canSee = true;
            /**if ( in_array($params->get('jobAgent', self::DEFAULT_AUTHORIZE_VIEW_LEVEL_JOBAGENT), $aViewLevels)
                    ){ **/
                $session->set('com_elgergasia.canSeeContactInfo', true);
                
            /**}
            else {
                $session->set('com_elgergasia.canSeeContactInfo', false);
            }**/

        }
        return  $canSee; //true; //$session->get('com_elgergasia.canSeeContactInfo');
    }
    
    public static function canUserEditData($retTo, $idSubject)
    {
        $currentUser = JFactory::getUser();
        if(in_array(12, $currentUser->groups))
        {
            return true;
        }
        else
        {
            if($currentUser->id == $idSubject && $currentUser->id > 0)
            {
                return true;
            }
        }
        if($retTo != '')
        {
            JFactory::getApplication()->redirect($retTo, JText::_('COM_ELGERGASIA_NOT_AUTHORISED'), 'error');
        }
        return false;
    }
    
    public static function authorsedForAgent($retTo, $msg, $msgType='error') {
         if(!self::canSeeContactInfo()) {
            JFactory::getApplication()->redirect($retTo, $msg, $msgType);
        }
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
        $input->set('basicData', $request);
        return $request;
    }
    
        public static function getYesNo($intVal) {
        if ( $intVal == 1):
            return JText::_('JYes');
        else:
            return JText::_('JNo');
        endif;
    }
}