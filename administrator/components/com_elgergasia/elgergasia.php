<?php
/**
 * @author e-logism
 * @copyright (c) e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/
    defined( '_JEXEC' ) or die( 'Restricted access' );
    if (!JFactory::getUser()->authorise('core.manage', 'com_elgergasia')) 
    {
        return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    }
    JLoader::register('elgergasiaHelper', dirname(__FILE__) . '/helpers/elgergasia.php');
    jimport('joomla.application.component.controller');
    $comPath = JURI::base() . 'components/com_elgergasia/';
    $document = JFactory::getDocument();
   
    $document->addStyleSheet($comPath, 'text/css');
    $document->addStyleSheet($comPath . 'libraries/e-logism/joomla/styles/styles.css');

   
    $controller = JControllerLegacy::getInstance('elgergasia');
    $controller->execute(JRequest::getCmd('task'));
    $controller->redirect();
 

?>
