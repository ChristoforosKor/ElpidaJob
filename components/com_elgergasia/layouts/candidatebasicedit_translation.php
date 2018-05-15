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
    //utils::authorsedForAgent($this->retTo, JText::_('COM_ELGERGASIA_NOT_AUTHORISED'));
      utils::canUserEditData($this->retTo, $this->form->getValue('idUser'));
?>

               
    <div class="translateableContent">
        <div class="content" >
            <div>
                <div class="formelm" >    
                    <?php echo $this->form->getLabel('city') . $this->form->getInput('city') ?> 
                </div>
            </div>
            <div>
                <div class="formelm" >    
                    <?php echo $this->form->getLabel('address') . $this->form->getInput('address') ?> 
                </div>
            </div>
            
        </div>
    </div>
   
                