<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2023s e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

namespace  ELG\Component\ElgJobs\Site\View\Jobsave;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;


class HtmlView  extends BaseHtmlView {
  
    public function display($template = null) {
        
        $doc = Factory::getDocument();
        $input = Factory::getApplication() -> input;
        $input = Factory::getApplication() -> input;
        print_r($input);
        exit;
        
        
        
        
        $id = $input -> getInt('id', 0);
        $model = $this -> getModel();
        $state = $this -> getModel() -> getItem($id);
        $state -> set('jid', $id);
        $state -> set('language', $input -> getString('lang'), '');
        $state -> set ('idUser', Factory::getUser() -> id);
        $this->form = $state->get('form');
        $this->form->setValue('id', null,$id);
        $this -> translatedLanguages = $state->get('translatedLanguages');
        $model -> setState($state);
        $doc -> addScriptDeclaration("var employers = " . json_encode( $state -> get('employers', [])) . ";var newEmployerUrl='index.php?option=com_elgergasia&controller=employersavequick';" );
        parent::display($template);
    }    
 }
