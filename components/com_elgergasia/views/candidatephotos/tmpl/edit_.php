<?php
/*------------------------------------------------------------------------
# com_elgalocrm - e-logism job agency
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr
 
----------------------------------**/
    defined('_JEXEC') or die('Restricted access');
  
?>


    <h2><?php echo '(' . $this->employee->id . ') ' . $this->employee->name ?></h2>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS'); ?></h3>
    <form name="candidatephotoform" method="post" enctype="multipart/form-data" >   
        <?php 
            echo $this->form->getInput('id')  ;
            echo $this->form->getInput('idUser'); 
            echo $this->form->getInput('photo'); 
          
        ?> 
        
            <div>
                <?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS_EXPLANATION'); ?>
            </div>
            <div class="elg-column" >
                <?php echo $this->form->getLabel('candidatePhotoUpload') ?> 
                <br />
                <?php echo $this->form->getInput('candidatePhotoUpload') ?> 
                <br />
                <?php
                if (isset($this->data)) {
                    echo '<img src="' . JUri::base() . $this->data->photo . '" />';
                }
                ?>
            </div>
             <div style="clear:left">&nbsp;</div>
            <div class="elg-column">
                 <button>
                     <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
                 </button>
            </div>
            <div class="elg-column">
                <a href="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&view=candidatephotos&layout=deleteconfirm&idUser=' . $this->state->get('idUser') . '&id=' . $this->state->get('id') . '&lang=' . $this->state->get('lang') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
            </div>
           <div style="clear:left">&nbsp;</div>
        <input type="hidden" name="controller" value="candidatephotossave" />
        <?php echo JHtml::_('form.token'); ?>
    </form>
