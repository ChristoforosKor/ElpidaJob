 <?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 require JPATH_COMPONENT_SITE . '/views/elgviewform.php';
 class  ElgergasiaViewEmployerEdit extends ElgergasiaViewElgViewForm{
    public function render() {
        $state = $this->model->getState();
        $this->retTo = JRoute::_('index.php?option=' . $this->state->get('option') . '&view=employer&id=' . $this->state->get('id') , '&Itemid='  . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang'));
        $this->itemCaption = CommonUtils::getUserTitleData($this->state->get('id'));
        $this->setLayout('default');
        $this->translatedLanguages = $state->get('translatedLanguages');
        return parent::render();
       
    }    
 }
?>
