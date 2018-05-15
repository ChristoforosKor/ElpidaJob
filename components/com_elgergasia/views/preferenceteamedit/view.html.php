<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewPreferenceTeamEdit extends JViewHTML{
    public function render() {
        $path = JPATH_COMPONENT . '/models/forms/preferenceteam.xml';                                                                                 
        $form = JForm::getInstance('preferenceteam', $path);
        $state = $this->model->getState();
        $form->setValue('idUser', null, $state->get('idUser'));
		$tmp = $state->get('idUserTeam', 0);
		
                if(count($tmp) > 0)
		{
			$val = $tmp[0];                        
		}
		else
		{
			$val = '';
		}
        $form->setValue('idUserTeam', null, $val );
        $this->form = $form;
        $this->candidate = CommonUtils::getUserTitleData($state->get('idUser', 0));
        return parent::render();
     }    
    
 }