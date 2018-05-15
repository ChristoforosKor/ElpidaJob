<?php

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_COMPONENT_SITE . '/libraries/php/joomla/e-logism/controllers/controller.php';

class ElgErgasiaControllerHouseCleaningSave extends Controller
{
   
    public function execute() 
    {
        $app = JFactory::getApplication();
        $state = $this->getInitedState();
        $model = Factory::getModel('ElgErgasia', 'HouseCleaningSave', $state);
        try {
           
            $submData = [];
            $submData['id'] = $this->input->getInt('id', null);
            $submData['fullname'] = $this->input->getString('fullname', '');
            $submData['address'] = $this->input->getString('address', '');
            $submData['telephone'] = $this->input->getString('telephone', '');
            $submData['email'] = $this->input->getString('email', '');
            $submData['area_description'] = $this->input->getString('area_description', '');
            $submData['idExtraInfo'] = $this->input->get('idExtraInfo', [], 'ARRAY');
            $submData['idCleaningFrequency'] = $this->input->getInt('idCleaningFrequency', 0);
            $submData['idCleaningStart'] = $this->input->getInt('idCleaningStart', 0);
            $submData['idΒuying'] = $this->input->getInt('idΒuying', 0);
            $submData['idCommunicationTime'] = $this->input->getInt('idCommunicationTime', 0);
            $state->set('submData', $submData);
            $model->setState($state);
            $app->enqueueMessage(JText::_('COM_ELGERGASIA_HOUSE_CLEANING_SUBMIT SUCCESS'), 'success');
        }
        catch(Exception $e) 
        {
            $app->enqueueMessage(JText::_('COM_ELGERGASIA_ERROR_NO_SAVE'));
        }
        $appData = $state->get('appData');
        $view = Factory::getView('ElgErgasia', $appData['view'], $model, $appData['format']);
        echo $view->render();
      
    }    
}
