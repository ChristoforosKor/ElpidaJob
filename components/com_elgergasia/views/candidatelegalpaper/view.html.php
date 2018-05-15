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
require JPATH_COMPONENT_SITE  . '/views/elgview.php';
 class  ElgergasiaViewCandidateLegalPaper extends ElgergasiaViewElgView{
    public function render() {
      $data = $this->state->get('data');
      $id = $this->state->get('id');
      $idUser = $this->state->get('idUser');
      $commonUrl =  'index.php?option=' . $this->state->get('option') . '&idUser=' . $idUser . '&Itemid='  . $this->state->get('Itemid') . '&lang=' .$this->state->get('lang');
      switch($this->getLayout()) {
          case 'candidatelegalpaperdelete' :
              $this->retNoAuthorise = JRoute::_($commonUrl . '&id=' . $idUser . '&view=candidate&layout=candidate', false);
              $this->deleteFormAction =  JRoute::_($commonUrl . '&id=' . $id . '&controller=candidatelegalpaperdelete', false);
              $this->cancelFormAction = JRoute::_($commonUrl . '&id=' . $idUser . '&view=candidate&layout=candidate', false);
              $this->deleteSpecificText = JText::_('COM_ELGERGASIA_OF_LEGALPAPER');
              break;
          default:
            $this->retToCandidate = JRoute::_($commonUrl . '&id=' . $idUser . '&view=candidate&layout=candidate', false);
            $this->editAction = JRoute::_($commonUrl . '&id=' . $id . ' &view=candidatelegalpaperedit&layout=candidatelegalpaperedit', false);
      }
      $this->candidate = CommonUtils::getUserTitleData($this->state->get('idUser'));
      $this->data = $data;
      $this->dataLayout = JPATH_COMPONENT_SITE . '/layouts/candidatelegalpaperdata.php';
      return parent::render();
    }    
 }
?>
