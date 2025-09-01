<?php
namespace  ELG\Component\ElgJobs\Site\View\Jobsave;

 defined( '_JEXEC' ) or die( 'Restricted access' );
 
use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Factory;

class JsonView  extends BaseJsonView {
  
     public function display($template = null) {
        $input = Factory::getApplication() -> input;
        print_r($input);
        exit;
        $model = $this -> getModel();
        $this->form = $state->get('form');   
        $id = $state->get('id');
        $this->form->setValue('id', null,$id);
        $this->state = $state;
        $this->translatedLanguages = $state->get('translatedLanguages');
        return parent::render();
    }    
 }
