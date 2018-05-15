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

 class  ElgergasiaViewCandidatePhotos extends JViewHTML{
      
  
    public function render() {
       
        $state = $this->model->getState();
     
        $idUser = $state->get('idUser');     
        $data = $state->get('photos');
        
        switch($this->getLayout()) {
            case 'photosedit' : 
                $form = JForm::getInstance('candidatePhotoFrom', JPATH_COMPONENT_SITE . '/models/forms/candidatephotos.xml');
                if(isset($data)) {
                    $cnt = count($data);
                    for($i=0; $i < $cnt; $i++) {
                        $form->setValue('id' . ($i + 1), null, $data[$i]->id);
                        $form->setValue('photo' . ($i + 1), null, $data[$i]->photo);
                    }
                }
                $form->setValue('idUser', null, $idUser );
                $this->retTo =JRoute::_('index.php?option=com_elgergasia&view=candidate&layout=candidate&id=' .$idUser . '&Itemid=' . $state->get('Itemid') . '&lang=' . $state->get('lang'), false);
                
                $this->form = $form;
                break;
            case 'photosdeleteconfirm' :
                $idDel = $state->get('id', 0);
                foreach($data as $photo) {
                    if($photo->id == $idDel) {
                        $this->photo = $photo;
                        break;
                    }
                    unset($photo);
                }
                break;
           }
           $this->photoUrl = '/media/com_elgergasia/' . CommonUtils::getComponentParams()->get('candidatesPhotosFolder','candidatephotos');
           $this->data = $data;
           $this->candidate = CommonUtils::getUserTitleData($idUser);
           $this->state = $state;
           return parent::render();
     }    
    
 }
?>
