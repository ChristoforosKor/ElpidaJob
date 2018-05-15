<?php
/**
 * @copyright (c) 2013, e-logism.
 * @license http://www.gnu.org/licenses/gpl.txt GPL version 3.
 * 
 */
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/controller.php';
 /**
  * Default controller. This is the controller to be executed if no other controller found.
  * @package libraries.e-logism.php.joomla;
  * @subpackage controllers
  * @author Christoforos J. Korifidis
  * 
  */


class ControllerDefault extends  Controller
{
    
    public function execute() {
        $state = $this->getInitedState();
        echo $this->getViewReady($state)->render();
    }
}