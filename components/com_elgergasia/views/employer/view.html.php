<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism library
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
----------------------------------**/
defined( '_JEXEC' ) or die( 'Restricted access' );
//require JPATH_COMPONENT_SITE  . '/views/elgview.php';
require JPATH_COMPONENT_SITE . '/libraries/joomla/views/itemvieweditable.php';
class  ElgergasiaViewEmployer extends ItemViewEditable//ElgergasiaViewElgView {
{
    public function render() {
        unset($this->linksUrls[0]);
        $this->data = $this->state->get('data');
        $this->modelData = $this->model->getState();
        $this->itemCaption = CommonUtils::getUserTitleData($this->state->get('id'));
        $this->buttonsTexts[0] = JText::_('COM_ELGERGASIA_ADD');
     
        if(!Utils::canUserEditData('', $this->state->get('id') ) )
        {
            $this->setLayout('employerunprivileged');
        }
        else
        {
            $this->setLayout('default');
        }
        return parent::render();
    }    
    
    
    protected function getGoToEditScript()
    {
        return ' function goToItemEdit0(){ location.href = "' . $this->commonUrl . '&id=0&view=paymentedit&layout=paymentedit&idUser=' . $this->state->get('idUser') . '&type=1" ;}';
    }
    
   
 }
?>
