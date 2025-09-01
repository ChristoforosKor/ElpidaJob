<?php

namespace  ELG\Component\ElgJobs\Site\View\PersonnelList;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\JsonView as BaseJsonView;
use Joomla\CMS\Factory;


/**
 * @package     ELG.Job.Site
 * @subpackage  com_elgjob
 * 
 *
 * @copyright   Copyright (C) 2022 E-Logism. All rights reserved.
 * @license     E-Logism Propriatery Licence.
 *
 */

class JsonView extends BaseJsonView {
    
    /*
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
 */
}
