<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency application
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (c) 2010-2020 e-logism.com. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );

 class  ElgergasiaViewCandidateUser extends JViewHTML{
      
  
    public function render() {
        $input = JFactory::getApplication()->input;
        
        $this->idUser = $input->get('id', 0, 'INT');
        $this->Itemid = $input->get('Itemid', 0, 'INT');
        $data = $this->model->getState();
//        switch($this->getLayout()) {
//            case 'edit' : 
//                $this->form = JForm::getInstance('basicForm', JPATH_COMPONENT . '/models/forms/employeesbasic.xml');
//                if(isset($data)) {
//                    $this->form->bind($data);
//                } 
//                else {
//                    $this->form->setValue('id', null, $this->id);
//                    $this->form->setValue('idUser', null, $this->idUser );
//                }
//                break;
//           }
           $this->employee = Helper::getUserTitleData( $this->idUser);
           return parent::render();
     }    
 }
?>
