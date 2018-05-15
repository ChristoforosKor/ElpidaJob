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
     utils::canUserEditData($this->retTo, $this->form->getValue('idUser'));
?>

<div class="elg">
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>  
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS'); ?></h3>
    <form name="candidatephotoform" method="post" enctype="multipart/form-data" class="candidate">   
        <?php 
            echo JHtml::_('form.token'); 
            echo $this->form->getInput('idUser'); 
         ?>
        <input type="hidden" name="controller" value="candidatephotossave" />
        <div class="form">
            <div>
                <?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS_EXPLANATION'); ?>
            </div>
            <fieldset>
                <?php for($i=0; $i < 3; $i++): ?>
                <div class="yjsg-col-1-3">
                    <div class="formelm">
                        <?php if(isset($this->data[$i]->photo)) :?>
                        <img src="<?php echo JUri::base()  . $this->photoUrl  . '/' . $this->data[$i]->photo . '_thumb.' . $this->data[$i]->photoExtension ?>" />
                        <br />
                        <a href="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&view=candidatephotos&layout=photosdeleteconfirm&idUser=' . $this->state->get('idUser') . '&id=' . $this->data[$i]->id . '&lang=' . $this->state->get('lang') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                            <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                        </a>
                        <?php else : 
                         echo $this->form->getLabel('candidatePhotoUpload' . ($i + 1)) . $this->form->getInput('candidatePhotoUpload' . ($i + 1)) ;
                        endif;
                        ?>
                    </div>
                </div>
                <?php endfor; ?>
               <div class="clear-fix">&nbsp;</div>
			   <br><br>
				<div class="formelm">
					<button class="btn btn-primary">
						 <?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SUBMIT') ; ?>
					</button>
					<a class="btn btn-default" href="<?php echo $this->retTo ?>" ><?php echo JText::_('COM_ELGERGASIA_RETURN_TO_INFO_TAB') ?></a>
				</div>
            </fieldset>
            
        </div>
    </form>
</div>