<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism jon agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/

 defined( '_JEXEC' ) or die( 'Restricted access' );
 class  ElgergasiaViewSuggestions extends JViewHTML{
      
    public function render() {
        
        $state = $this->model->getState();
        $this->data = $state->get('data');
        //$this->form = JForm::getInstance('jobs', JPATH_COMPONENT . '/models/forms/jobs.xml');
        //$this->form->bind($state->get('filter'));
        $this->lang= $state->get('lang');
        $this->Itemid = $state->get('Itemid');
        return parent::render();
    }    
 }
?>
