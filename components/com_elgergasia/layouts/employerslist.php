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

        <table class="table table-striped table-bordered">
            <thead>
                <tr class="nowrap" >
                    <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_ID', 'id', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_VIEW_EMPLOYER_NAME', 'employerName', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    <th >
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_VIEW_EMPLOYER_INDUSTRY', 'industry', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    <?php if($this->canSeeContactInfo): ?>
                    <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_EMPLOYER_SITATION', 'citation', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    
                    <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_PHONES', 'telephones', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                     <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_LAST_UPDATE', 'datemodified', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    <?php endif; ?>
                </tr>
            </thead>
            <?php   if(count($this->data) >0 ) { ?>
            <tbody>
               <?php foreach($this->data as $item) { ?>
               <tr>
                   <td rowspan="2" >
                     <a   href="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&view=employer&id=' . $item->id . '&lang=' . $this->state->get('lang') , false)?>"  ><?php echo $item->id; ?></a>
                   </td>
                   <td rowspan="2" >
                      <?php echo $item->employerName; ?>
                   </td>
                   <td>
                      <?php echo $item->industry; ?>
                   </td>
                   <?php if($this->canSeeContactInfo) : ?>
                   <td>
                        <?php echo $item->country . '<br />' . $item->city ; ?>
                     </td>

                     <td>
                        <?php 
                         echo 
                             JText::_('COM_ELGERGASIA_PHONE_SHORT'), ': ', $item->phone, '<br />',
                             JText::_('COM_ELGERGASIA_MOBILE_SHORT'), ': ', $item->mobile, '<br />',
                             JText::_('COM_ELGERGASIA_FAX_SHORT'), ': ', $item->fax,
                             JText::_('COM_ELGERGASIA_EMAIL'), ': ', $item->email;
                        ?>
                     </td>
                       <td>
                        <?php echo CommonUtils::getDateFormated($item->datemodified) ; ?>
                     </td>
                   <?php endif; ?>
               </tr>
               <tr>
                   <td cOlspan="<?php echo ($this->canSeeContactInfo ? 4 : 3)?>" >
                       <a class="btn btn-primary" href="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&view=employer&id=' . $item->id . '&lang=' . $this->state->get('lang') , false)?>"  ><?php echo JText::_('COM_ELGERGASIA_SHOW_DETAILS'); ?></a>
                   </td>
               </tr>
               <?php }
               unset($item);
               ?>
           </tbody>
           <?php }?>
       </table>
        <?php echo ($this->state->get('pagination')->getListFooter()); ?> 
