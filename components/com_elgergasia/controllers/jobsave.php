<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency component
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr

----------------------------------**/

defined( '_JEXEC' ) or die( 'Restricted access' );
require_once JPATH_COMPONENT_SITE .'/controllers/controller.php' ;
require_once JPATH_COMPONENT_SITE .'/models/datautils.php' ;

class ElgergasiaControllerJobSave extends ElgergasiaController {
    
    public function execute() {
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
        $app = JFactory::getApplication();
        $input = $this->input;
        $this->request['storeFolder'] = JPATH_SITE . '/media/com_elgergasia/jobphotos';
        $this->request['uploadedFile1'] = $this->getInput()->files->get('jobImage1',null);
        $this->request['uploadedFile2'] = $this->getInput()->files->get('jobImage2',null);
        $this->request['uploadedFile3'] = $this->getInput()->files->get('jobImage3',null);
        if($this->request['id'] == 0) {
            $this->request['id'] = "";
            $this->request['submitDate'] = $input->getCmd('submitDate', date('Y-m-d',time()));
        }
        $this->request['idSpeciality'] = $input->getInt('idSpeciality',0);
        $this->request['idJobState'] = $input->getInt('idJobState',0);
        $this->request['jobTitle'] = $input->getString('jobTitle','');
        $this->request['idCounty'] = $input->getInt('idCounty',0);
        $this->request['idHour'] = $input->getInt('idHour', 0);
        $this->request['idMedicalCare'] = $input->getInt('idMedicalCare',0);
        $this->request['idOldPeople'] = $input->getInt('idOldPeople',0);
        $this->request['idSpecilaity'] = $input->getInt('idSpeciality', 0);
        $this->request['idDegreeLevel'] = $input->getInt('idDegreeLevel', 0);
        $this->request['minExperience'] = $input->getInt('minExperience', 0);
        $this->request['jobDescription'] = $input->getString('jobDescription', '');
        $this->request['jobComment'] = $input->getString('jobComment', 0);
        $this->request['jobCost'] = $input->getFloat('jobCost', 0);
        $this->request['language'] = $input->post->getCmd('language');
        $this->request['jobSalary'] = $input->post->getInt('jobSalary', 0);
        $this->request['daysOff'] = $input->post->getInt('daysOff', 0);
        $this -> request['extUrl'] = $input ->  post -> getString('extUrl', '');
        $this->model->setState(new JRegistry($this->request));
        $state = $this->model->getState();
        $errors =  $state->get('errors');
        $cnt = count($errors);
        if($cnt > 0 ) {
            for ($i = 0; $i < $cnt ; $i++) {
                if ($errors[$i] instanceof Exception) {
                    
                    $app->enqueueMessage($errors[$i]->getMessage(), 'error');
                }
                else{
                    $app->enqueueMessage($errors[$i], 'error');
                }
            }
            require JPATH_COMPONENT_SITE . '/views/jobedit/view.html.php';
            $viewClass = 'ElgergasiaViewJobEdit';
            $paths = new   SplPriorityQueue();
            $paths->insert(JPATH_COMPONENT_SITE . '/layouts', 'normal');
            $view = new $viewClass($this->model, $paths);
            echo $view->render();
        }
        else {
            $app->setUserState('com_elgergasia.view.jobedit.data',null);
            $app->enqueueMessage(JText::_('COM_ELGERGASIA_VIEW_SUBMIT_SUCCESS'));
			$db = JFactory::getDBO();
			$query = $db->getQuery(true);
			$db->setQuery($query);
            $redUrl =JRoute::_('index.php?option=com_elgergasia&view=job&layout=job&id=' .  $state->get('id') . '&Itemid='  . DataUtils::getLanguageItemid($db, 201, jFactory::getLanguage()->getTag()) . '&lang=' . $state->get('lang'), false);
            //echo $redUrl;
			JFactory::getApplication()->redirect($redUrl);
        }
             
    }

    protected function setSessionNamespace() {
        
    }   
}