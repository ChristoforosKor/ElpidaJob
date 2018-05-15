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
<div class="elg well">
    <h2><?php echo JText::_('COM_ELGERGASIA_SUGGESTIONS_TITLE'); ?></h2>
    <?php  /**
    <div class="form" >
        <form method="post" >
            <fieldset> 
                <legend><?php echo Jtext::_('COM_ELGERGASIA_FILTERS_SEARCH') ?></legend>
                <div class="elg-column">
                    <div class="formelm">
                       <?php echo $this->form->getLabel('idUser') . '<br />' . $this->form->getInput('idUser');  ?>
                    </div>
                    <div class="formelm">
                       <?php echo $this->form->getLabel('idIndustry') . '<br />' . $this->form->getInput('idIndustry');  ?>
                    </div>
                    <div class="formelm">
                       <?php echo $this->form->getLabel('idJobState') . '<br />' . $this->form->getInput('idJobState');  ?>
                    </div>
                    <div class="formelm">
                       <?php echo $this->form->getLabel('jobTitle') . '<br />' . $this->form->getInput('jobTitle');  ?>
                    </div>
                    
                </div>    
            </fieldset>
            <div class="formelm" >
                <button>
                     <?php echo JText::_('COM_ELGERGASIA_SEARCH') ; ?>
                </button>
            </div>
            <?php echo JHtml::_('form.token'); ?>
        </form>
    </div>
    */ ?>
    <table>
        <thead>
            <tr>
                <th colspan="4"><?php echo JText::_('COM_ELGERGASIA_SUGGESTION_JOB') ?></th>
                <th colspan="2"><?php echo JText::_('COM_ELGERGASIA_SUGGESTIONS_CANDIDATE') ?></th>
                <th colspan="5"><?php echo JText::_('COM_ELGERGASIA_SUGGESTION_MATCH') ?></th>
            </tr>
            <tr>
                <th><?php echo JText::_('COM_ELGERGASIA_ID') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_JOBS_LISTING_DATE') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_TITLE') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_PLACE') ?></th>
                
                <th><?php echo JText::_('COM_ELGERGASIA_ID') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_SUGGESTIONS_CANDIDATE') ?></th>
                
                <th><?php echo JText::_('COM_ELGERGASIA_EDUCATION') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_EXPERIENCE') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_SPECIALITY') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_SPECIALITYPREFERENCE_R2') ?></th>
                <th><?php echo JText::_('COM_ELGERGASIA_COUNTYPREFERENCE_R2') ?></th>
                
            </tr>
        </thead>
        <?php if(count($this->data) > 0) : 
            $cnt = 0;
            ?>
        <tbody>
        <?php foreach($this->data as $item): ?>
            <tr>
                <td><a href="<?php echo JRoute::_('index.php?option=com_elgergasia&view=job&layout=job&id=' . $item->idJob . '&lang=' . $this->lang . '&Itemid=' .$this->Itemid, false );?>" ><?php echo $item->idJob ; ?></a></td>
                <td><?php echo $item->submitDate ?></td>
                <td><?php echo $item->jobTitle ?></td>
                <td><?php echo $item->county ?></td>
                
                <td><a href="<?php echo JRoute::_('index.php?option=com_elgergasia&view=candidate&id=' . $item->idUser . '&lang=' . $this->lang . '&Itemid=' .$this->Itemid, false );?>" ><?php echo $item->idUser ?></a></td>
                <td><?php echo $item->name ?></td>
              
                <td><?php echo Helper::getYesNo($item->hasEducation) ?></td>
                <td><?php echo Helper::getYesNo($item->hasExperience) ?></td>
                <td><?php echo Helper::getYesNo($item->hasSpeciality) ?></td>
                <td><?php echo Helper::getYesNo($item->hasPrefSpeciality) ?></td>
                <td><?php echo Helper::getYesNo($item->hasPrefCounty) ?></td>
                 
            </tr>
        <?php endforeach; 
            unset($item);
        ?>           
        </tbody>
        <?php endif; ?>
    </table>
 
   

</div>