<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2023s e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

namespace  ELG\Component\ElgJobs\Site\View\Jobedit;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;

class PartView  extends BaseHtmlView {
    
    public function display($template = null) {
        
        $input = Factory::getApplication() -> input;
        $data =  $input -> get('data', [], 'array');
//        $id = $data['id'];
//        $state = $this -> getModel() -> getItem($id);      
//        $this->form = $state->get('form');
//        $this->form2 = $state->get('form2');   
        
//        $input = Factory::getApplication() -> input;
//        $jid = $input -> getInt('jid', 0);
        $model = $this -> getModel();
        $state = $model -> getState();
        
        $id = $data['id'];
        $state -> set('id', $data['id']);
        $state -> set('language', $data['language'], '');
        $state -> set ('idUser', Factory::getUser() -> id);
        $model -> setState($state);
        $itemState = $this -> getModel() -> getItem($id);
        
        $this->form = $itemState->get('form');
        $this->form->setValue('id', null,$id);
        $translatedLanguages = $model -> getTranslatedLanguages($id);
        $this -> form = $model -> getForm($translatedLanguages);
//       $model -> setState($state);
        
        
        
        
        
//        $this -> form->setValue('id', null,$jid);
//        $this -> translatedLanguages = $itemState -> get('translatedLanguages');
        parent::display($template);
    }    
}
