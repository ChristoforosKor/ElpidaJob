<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/elogismjoomlautils.php';
 /**
  * Class f that holds static functions used by e-logism's components.
  * @package e-logism.joomla;
  * @author Christoforos J. Korifidis
  * 
  */


class ComponentUtils  extends ELogismJoomlaUtils
{
    public static function getAppData(JInput $input)
    {
            return $input->get('appData', array(), 'ARRAY');
    }    
        
        
    public static function canUserEditData($idSubject, $retTo='index.php')
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
       
}