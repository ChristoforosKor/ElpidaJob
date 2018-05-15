<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewJobEdit extends JViewHTML{
  
    public function render() {
        $doc = JFactory::getDocument();
        $state = $this->model->getState();
        $this->form = $state->get('form');   
        $this->form2 = $state->get('form2');   
        $id = $state->get('id');
        $this->form->setValue('id', null,$id);
        $this->state = $state;
        $this->translatedLanguages = $state->get('translatedLanguages');
        $doc->addScriptDeclaration("var employers = " . json_encode( $state -> get('employers', [])) . ";var newEmployerUrl='index.php?option=com_elgergasia&controller=employersavequick';" );
        $doc->addStylesheet('media/com_elgergasia/css/select2.min.css');
        $doc->addStylesheet('media/com_elgergasia/css/site.stylesheet.css');
        return parent::render();
    }    
 }
