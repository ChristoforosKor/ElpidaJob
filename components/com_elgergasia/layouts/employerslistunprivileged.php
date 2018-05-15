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
                   
                    <th>
                        <?php echo  JHtml::_('grid.sort', 'COM_ELGERGASIA_EMPLOYER_SITATION', 'citation', $this->filter_order_Dir, $this->filter_order); ?>
                    </th>
                    
                   
                </tr>
            </thead>
			
             <?php 
               if(count($this->data) >0 ) { ?>
            <tbody>
               <?php foreach($this->data as $item) { ?>
               <tr>
                   <td rowspan="2">
                     <a href="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&view=employer&idUser=' . $item->id . '&lang=' . $this->state->get('lang') , false)?>"  ><?php echo $item->id; ?></a>
                   </td>
                   <td rowspan="2" >
                      <?php echo $item->employerName; ?>
                   </td>
                   <td>
                      <?php echo $item->industry; ?>
                   </td>
                   
                   <td>
                      <?php echo $item->country . '<br />' . $item->city ; ?>
                   </td>
                  
                   
                   
               </tr>
               <?php }
               unset($item);
               ?>
           </tbody>
           <?php }?>
       </table>
		<?php echo ($this->state->get('pagination')->getListFooter()); ?> 
