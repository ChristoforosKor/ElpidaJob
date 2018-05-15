<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/controller.php';

class ElgErgasiaControllerHouseCleaningEdit extends Controller
{
   
    public function execute() 
    {
        $state = $this->getInitedState();
        $state->set ('id', $this->input->getInt('id', 0));
        $view =  $this->getViewReady($state);
        echo $view->render();
      
    }    
}
