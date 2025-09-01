<?php

namespace  ELG\Component\ElgJobs\Site\Model;
defined('_JEXEC') or die;

use ELG\Component\ElgJobs\Site\Model\Helpers\Translations;
use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Factory;

class JobeditModel extends AdminModel {
   
    public function getTranslatedLanguages($idJob) {
        return Translations::getTranslatedLanguages("#__elg_ergasia_job_translation", $idJob, 'idJob', $this ->getDbo());
        
    }

   
    public function getTable($name = 'Job', $prefix = '', $options = []) {
        return parent::getTable($name, $prefix, $options);
    }
    
    public function getForm($data = [], $loadData = true): Form {

        $form = Form::getInstance('job', JPATH_COMPONENT_ADMINISTRATOR . '/forms/job.xml', ['control' => 'jobForm']);
        
        if ( $loadData ) {
            $form -> bind($data);
        }
        $form->setValue("idUser", null, Factory::getUser() -> id);

        return $form;
    }
    
    public function getFormEmployer($data =[], $loadData = true) {
		$form = Form::getInstance('employer', JPATH_COMPONENT_ADMINISTRATOR . '/forms/employer.xml', ['control' => 'employerForm']);
        
        if ( $loadData ) {
            $form -> bind($data);
        }
       

        return $form;
		
	}
      public function getItem($pk = null) {
        //$pk = (!empty($pk)) ? $pk : (int) $this->getState($this->getName() . '.id');
        $itemModel = $this -> getMVCFactory() ->createModel("Job");
       // print_r($pk);
        return $itemModel -> getItem($pk);
    }
    
}
