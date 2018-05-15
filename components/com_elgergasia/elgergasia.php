<?php
/**
 * com_elgergasia : job agency application by e-logism
 * @author e-logism <info@e-logism.gr>
 * @copyright (C)  2013, e-logism.gr
 * @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined( '_JEXEC' ) or die( 'Restricted access' );

$input = JFactory::getApplication()->input;

JTable::addIncludePath(JPATH_ADMINISTRATOR . '/components/com_elgergasia/tables/');
JForm::addFieldPath(JPATH_COMPONENT_ADMINISTRATOR . '/models/fields');
 JLoader::register('ComponentUtils', JPATH_COMPONENT_SITE . '/componentutils.php');
if($input->getInt('Itemid', 0) === 297 || $input->getInt('Itemid', 0) === 298):
   
    require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/controller.php';
    $controller = new Controller();
    $controller->execute();
else:
    
    JLoader::register('CommonUtils', dirname(__FILE__) . '/commons/commonutils.php');
    JLoader::register('Utils', dirname(__FILE__) . '/utils.php');
    JLoader::register('NullsFactory', dirname(__FILE__) . '/models/nullsfactory.php');
    $request = CommonUtils::getBasicStateData(JFactory::getApplication()->input);
    require JPATH_COMPONENT . '/controllers/' . $request['controller'] . '.php';
    $controllerName = Utils::COMPONENT_NAME . 'Controller' . $request['controller'];
    $controller =  new $controllerName();
    $doc = JFactory::getDocument();

//    foreach ( $doc->_links as $k => $array ) {
//            if ( $array['relation'] == 'canonical' ) {
//                    unset($doc->_links[$k]);
//            }
//    }

    if(strpos ($controllerName , "registration") > 0)
    {

        $controller->execute(JFactory::getApplication()->input->get('task', 'display'));
    }
    else
    {
        $controller->execute();
    }
endif;



