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
 JHTML::_( 'behavior.modal', 'a.modalpop' );
 use Joomla\CMS\Factory;
?>


<div class="elg" >
    <?php require JPATH_COMPONENT_SITE . '/commons/html/candidatehead.php'; ?>
	<div class="col-md-12">
            <a href="index.php?option=com_elgergasia&controller=makecv&id=<?php echo $this->state->get('id'); ?>" class="btn btn-primary pull-left" target="_blank" ><?php echo JText::_('COM_ELGERGASIA_MAKECV'); ?></a> <button class="btn btn-warning pull-left" type="button" onclick="confirmDelete(<?php echo $this->state->get('id') ?>)"  ><?php echo JText::_('COM_ELGERGASIA_DELETE'); ?></button>
	</div>
       
	<div class="clearfix">&nbsp;</div>
        <script type="text/javascript">
            function confirmDelete(id) {
                var ans = confirm('Είστε σίγουροι για τη διαγραφή του υποψηφίου;');
                if(ans) {
                    location.href= 'index.php?option=com_elgergasia&controller=deletecandidate&id=' + id;
                }
            }
        </script>
	<a name="preferences"></a>
   <div class="candidate">
    <h3><?php echo JText::_('COM_ELGERGASIA_PREFERENCES') ?></h3>
		<div  class="preferences">
			<div class="pull-left">   
				<h4> <?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY'); ?></h4>
				<ul>
				 <?php 
					if(count($this->prefSpecialities) >0) :
						foreach($this->prefSpecialities as $item) :
							echo '<li>', $item->speciality, '</li>';
						endforeach; 
						unset($item);
					else : 
						echo '<li>', JText::_('COM_ELGERGASIA_NO_DATA_FOUND'), '</li>';
					endif; ?>
				</ul>
				<?php 
				if(utils::canUserEditData('', $this->state->get('id')))  : ?>
					<form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=preferencesspecialitiesedit&view=preferencesspecialitiesedit&layout=preferencesspecialitiesedit&idUser=' . $this->state->get('idUser', 0) . '&id=' . (isset($this->preferencesData->id)? $this->preferencesData->id :0) . '&lang=' . $this->state->get('lang', ''))?>" >
						<div>
							<button class="btn btn-primary">
								<?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
							</button>
						</div>
					</form>
				<?php endif ;?>
			</div>
			
            <div class="pull-left">
				<h4><?php echo JText::_('COM_ELGERGASIA_JOB_PLACE'); ?></h4>
				<ul>
					<?php
						if(count($this->countiesPrefrencesData) >0):
							foreach($this->countiesPrefrencesData as $item): ?>
								<li><?php echo $item->county; ?></li>
							<?php endforeach;
							 unset($item);
						
						else:
								echo '<li>', JText::_('COM_ELGERGASIA_NO_DATA_FOUND'), '</li>';
						endif; ?>
				</ul>
				<?php 	if(utils::canUserEditData('', $this->state->get('id')))  : ?>
					
					<form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=preferencessectionsedit&view=preferencessectionsedit&layout=preferencessectionsedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''));?>" >
						<div>
							<button class="btn btn-primary">
								<?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
							</button>
						</div>
					</form>
				<?php endif; ?>
			</div>
			
			<div class="pull-left" >
				<h4><?php echo JText::_('COM_ELGERGASIA_RELATION'); ?></h4>
				<ul>
				<?php
					if(count($this->relationData) >0):
						foreach($this->relationData as $item):
							echo '<li>', $item->relationType, '</li>';
						endforeach;
						unset ($item);
					else:
						echo '<li>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '</li>';
					endif;?>
				</ul>
				
				<?php 
					if(utils::canUserEditData('', $this->state->get('id')))  : ?>
					<form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=preferencesrelationsedit&view=preferencesrelationsedit&layout=preferencesrelationsedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''))?>" >
						<div class="formelm" >
							<button class="btn btn-primary">
								<?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
							</button>
						</div>
					</form>
				<?php endif ;?>
			</div> 
			
			<div class="pull-left" >
				<h4><?php echo JText::_('COM_ELGERGASIA_HOURS'); ?></h4>
				<ul>
				<?php
					if(count($this->hoursData) > 0 ) :
						foreach($this->hoursData as $item) :
							echo '<li>', $item->hour, '</li>';
						endforeach;
						unset ($item);
					else :
						echo '<li>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') , '</li>';
					endif;
				?>
				</ul>
	
				<?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
					<form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=preferenceshoursedit&view=preferenceshoursedit&layout=preferenceshoursedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''))?>" >
						<div>
							<button class="btn btn-primary">
								<?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
							</button>
						</div>
					</form>
				<?php endif; ?>
			</div>
			
			<div class="pull-left" >
				<h4><?php echo JText::_('COM_ELGERGASIA_TEAM'); ?></h4>
				<ul>
				<?php
					if(count($this->prefTeam) > 0 ) :
						foreach($this->prefTeam as $item) :
							echo '<li>', $item->name, ' (', $item->idUserTeam, ') </li>';
						endforeach;
						unset ($item);
					else :
						echo '<li>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') , '</li>';
					endif;
				?>
				</ul>
				
				<?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
					<form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=preferenceteamedit&view=preferenceteamedit&layout=preferenceteamedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''))?>" >
						<div class="formelm" >
							<button class="btn btn-primary">
								<?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
							</button>
						</div>
					</form>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="clearfix">&nbsp;</div>
	<div>
	
	<a name="photos"></a>
    <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS'); ?></h3>
    <table class="candidatephotos table table-bordered">
        <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
        <tfoot class="no-print">
           <tr>
               <td colspan="4">
                    <form method="post" action="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang') . '&view=candidatephotos&layout=photosedit&idUser=' . $this->state->get('id') . '&id=' . (isset($this->photosData[0])? $this->photosData[0]->id : 0 ) ); ?>" >
                       <div class="form">
                           <div class="elg-column" >
                               <div class="formelm" >
                                   <button class="btn btn-primary">
                                       <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                                   </button>

                               </div>
                           </div>
                       </div>
                   </form>
               </td>
           </tr>
       </tfoot>
       <?php endif; ?>
       <tbody> 
           <tr>
                <td class="photo" >
           <?php if(count($this->photosData) > 0) :?>
           <?php foreach($this->photosData as $photo) : ?>

               <?php echo '<a class="modalpop" href="'. JUri::base() . $this->photoUrlPart .  '/' . $photo->photo . '_large.' . $photo->photoExtension . '" ><img src="'. JUri::base() . $this->photoUrlPart .  '/' . $photo->photo . '_medium.' . $photo->photoExtension . '" /></a>' ?>

        <?php 
           endforeach;
           unset($photo);
           else : 
               if($this->isUserPrivileged) : 
                   echo '<tr><td>' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
               endif;
           endif;
       ?>
                    </td>
           </tr>
       </tbody>
    </table>
    </div>   
    <div class="clearfix">&nbsp;</div> 
	<br />
		<div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
	<br />
    <div class="clear-fix">&nbsp;</div>
  <?php if(utils::canUserEditData('', $this->state->get('id'))) : ?>
 <h3><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_ABILITIES') ?></h3>
 <div class="clear-ix">&nbsp;</div>
 <a name="basicdata"></a>
 <h4><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_BASIC_DATA'); ?></h4>
 
 
 <table class="table table-bordered">
     
    <tfoot class="no-print">
        <tr>
            <td colspan="4">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=' . $this->state->get('option') . '&Itemid=' . $this->state->get('Itemid') . '&lang=' . $this->state->get('lang') . '&model=candidatebasicedit&view=candidatebasicedit&layout=candidatebasicedit&idUser=' . $this->state->get('id') . '&id=' . (isset($this->basicData->id) ?$this->basicData->id:0) ); ?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
             </td>
        </tr>
    </tfoot>
   
    <tbody>
    <?php 
    
    if(isset($this->basicData)) { ?>
    <tr>
        <th>
            <?php echo JText::_('COM_ELGERGASIA_STATE'); ?>
        </th>
        <td><?php echo $this->basicData->candidateState ?></td>
        <th></th>
        <td></td>
    </tr>
    <tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_COUNTRY_LABEL'); ?></th><td><?php echo $this->basicData->country ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CITY_LABEL'); ?></th><td><?php echo($this->basicData->city) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_ADDRESS_LABEL'); ?></th><td><?php echo $this->basicData->address ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_POSTAL_CODE_LABEL'); ?></th><td><?php echo($this->basicData->postalCode) ?></td>
    </tr><tr>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_PHONE_LABEL'); ?></th><td><?php echo $this->basicData->phone ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MOBILE_LABEL'); ?></th><td><?php echo($this->basicData->mobile) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FAX_LABEL'); ?></th><td><?php echo $this->basicData->fax ?></td>
        <th></th><td></td>
    </tr>
    <?php if ( Utils::canUserEditData('', Factory::getUser() -> id ) ): ?>
    <tr>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SHOW_PHOTO'); ?></th><td><?php echo Utils::getYesNo( $this->basicData->showPhoto ); ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_USE_MY_DATA'); ?></th><td><?php echo Utils::getYesNo( $this->basicData->useMyData ); ?></td>
    </tr>
    <?php endif; ?>
       <?php }
    else {
        echo '<tr><td colspan="4" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
    }
    ?>
    </tbody> 
</table>
<?php endif; ?>
<a name="characteristicdata"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?></h4>
<table class="table table-bordered">
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="4">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatecharacteristicsedit&view=candidatecharacteristicsedit&layout=candidatecharacteristicsedit&idUser=' . $this->state->get('idUser',0) . '&id=' . ( (isset($this->characteristicData->id))?$this->characteristicData->id:0) . '&lang=' . $this->state->get('lang',''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    <?php endif; ?>
    <tbody>
    <?php if (isset($this->characteristicData)) { ?>
    <tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_GENDER'); ?></th><td><?php echo $this->characteristicData->gender ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FIELD_DOB'); ?></th><td><?php echo($this->characteristicData->dateOfBirth) ?></td>
    </tr><tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_NATIONALITY_LABEL'); ?></th><td><?php echo $this->characteristicData->nationality ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MILITARYSTATUS_LABEL'); ?></th><td><?php echo($this->characteristicData->militaryStatus) ?></td>
    </tr><tr>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_MARITALSTATUS_LABEL'); ?></th><td><?php echo $this->characteristicData->maritalStatus ?></td>
         <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_SMOKING_LABEL'); ?></th><td><?php echo(CommonUtils::getYesNo($this->characteristicData->smoking)) ?></td>
    </tr><tr>    
        
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_DRIVER_LICENCE_LABEL'); ?></th><td colspan="3"><?php echo $this->characteristicData->driverLicence ?></td>
       
    </tr>
	  <?php  if(utils::canUserEditData('', $this->state->get('id')))  : ?>
	<tr>    
        <th colspan="4" style="text-align: left" ><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_ABOUT_ME_LABEL'); ?></th>
    </tr>

    <tr>
        <td colspan="4" ><?php echo $this->characteristicData->aboutMe ?></td>
    </tr>
		<?php endif; ?>
    <?php }
    else {
        echo '<tr><td colspan="4">' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_EDIT_FOR_NEW') . '</td></tr>';
    }
    ?>
    </tbody>
    
</table>
<a name="medical"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_MEDICAL_EXAMS'); ?></h4>
<table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_FILE') ?></th>
            <th></th>
    </thead>
    <?php  if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="2">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatemedicalexamsedit&view=candidatemedicalexamsedit&layout=candidatemedicalexamsedit&idUser=' . $this->state->get('idUser',0) . '&lang=' . $this->state->get('lang',''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary" >
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    <?php endif; 
    if (($this->medicalData)): 
        $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
        ?>
    <tbody>
  <?php foreach($this->medicalData as $item) : 
      $editUrl = $commonUrl .  '&idUser=' . $item->idUser . '&id=' . $item->id ;
      ?>
        <tr>
            <td>
                <a href="<?php echo JRoute::_('media/com_elgergasia/medicalexams/' . $item->examFile, false)?>" target="_blank">
                    <?php echo $item->examTitle; ?>
                </a>
            </td>               
            <td>
                <a href="<?php echo JRoute::_($editUrl . '&model=candidatemedicalexamsedit&view=candidatemedicalexamsedit&layout=candidatemedicalexamsedit')?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_($editUrl . '&view=candidatemedicalexams&layout=candidatemedicalexamsdelete', false)?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>                
           </td>
        </tr>
    <?php endforeach;
    unset($item);
    ?>
     </tbody>
    <?php 
    else :
        echo '<tr><td colspan="2" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>

<a name="legalpapers"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_LEGAL_PAPERS'); ?></h4>
<table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_FILE') ?></th>
            <th></th>
    </thead>
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="2">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatelegalpaperedit&view=candidatelegalpaperedit&layout=candidatelegalpaperedit&idUser=' . $this->state->get('idUser',0) . '&lang=' . $this->state->get('lang',''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary" >
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    <?php endif; 
    if (($this->legalData)): 
        $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
        ?>
    <tbody>
  <?php foreach($this->legalData as $item) : 
      $editUrl = $commonUrl . '&idUser=' . $item->idUser . '&id=' . $item->id ;
      ?>
        <tr>
            <td>
                <a href="<?php echo JRoute::_('media/com_elgergasia/legalpaper/' . $item->legalFile, false)?>" target="_blank">
                    <?php echo $item->legalTitle; ?>
                </a>
            </td>               
            <td>
                <a href="<?php echo JRoute::_($editUrl . '&model=candidatelegalpaperedit&view=candidatelegalpaperedit&layout=candidatelegalpaperedit')?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_($editUrl . '&view=candidatelegalpaper&layout=candidatelegalpaperdelete', false)?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
           </td>
        </tr>
    <?php endforeach;
    unset($item);
    ?>
     </tbody>
    <?php 
    else :
        echo '<tr><td colspan="2" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>


<a name="degress"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_DEGREES_CV'); ?></h4>
<table class="table table-striped table-bordered" >
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_FILE') ?></th>
            <th></th>
    </thead>
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="2">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatepaperedit&view=candidatepaperedit&layout=candidatepaperedit&idUser=' . $this->state->get('idUser',0) . '&lang=' . $this->state->get('lang',''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary" >
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    <?php endif; 
    if (($this->paperData)): 
        $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
        ?>
    <tbody>
  <?php foreach($this->paperData as $item) : 
      $editUrl = $commonUrl .  '&idUser=' . $item->idUser . '&id=' . $item->id ;
      ?>
        <tr>
            <td>
                <a href="<?php echo JRoute::_('media/com_elgergasia/paper/' . $item->paperFile, false)?>" target="_blank">
                    <?php echo $item->paperTitle; ?>
                </a>
            </td>               
            <td>
                <a href="<?php echo JRoute::_($editUrl . '&model=candidatepaperedit&view=candidatepaperedit&layout=candidatepaperedit')?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_($editUrl . '&model=candidatepaper&view=candidatepaper&layout=candidatepaperdelete', false)?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
           </td>
        </tr>
    <?php endforeach;
    unset($item);
    ?>
     </tbody>
    <?php 
    else :
        echo '<tr><td colspan="2" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>






<a name="experience"></a>

<h4><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE'); ?></h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_DURATION') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EMPLOYER') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_INDUSTRY') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_SECTOR') ?></th>
            <th></th>
    </thead>
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="5">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidateexperienceedit&view=candidateexperienceedit&layout=candidateexperienceedit&idUser=' . $this->state->get('idUser',0) . '&lang=' . $this->state->get('lang',''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
                
            </td>
        </tr>
    </tfoot>
    <?php endif; 
    if (($this->experienceData)): 
        $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
        ?>
    <tbody>
  <?php foreach($this->experienceData as $item) : 
      $commonUrl .= '&idUser=' . $item->idUser . '&id=' . $item->id ;
      ?>
        <tr>
            <td><?php echo $item->dateFrom . ' - ' .  $item->dateTo ?></td>
            <td><?php echo $item->employerTitle?></td>
            <td><?php echo $item->industry?></td>
            <td><?php echo $item->speciality?></td>
            <td>
                <a href="<?php echo JRoute::_($commonUrl .'&controller=candidateexperience&view=candidateexperience&layout=candidateexperience', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_SHOW'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_SHOW'); ?>
                </a>
                <?php if(utils::canSeeContactInfo()) : ?>
                <br />
                <a href="<?php echo JRoute::_($commonUrl .'&model=candidateexperienceedit&view=candidateexperienceedit&layout=candidateexperienceedit', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_($commonUrl . '&view=candidateexperience&layout=candidateexperiencedelete', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
                <?php endif; ?>
            </td>
            
        </tr>
    <?php endforeach;
    unset($item);
    ?>
     </tbody>
    <?php 
    else :
        echo '<tr><td colspan="5" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>
<?php /**
<a name="specialities"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITIES'); ?></h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_EXPERIENCE_MONTH') ?></th>
          
            <?php if(utils::canSeeContactInfo()) : ?>
                <th></th>
            <?php endif; ?>
        </tr>
    </thead>
     <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot>
        <tr>
            <td colspan=" <?php echo (utils::canUserEditData('', $this->state->get('id')) ? 3 :2);  ?>">
                 <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatespecialityedit&view=candidatespecialityedit&layout=candidatespecialityedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''));?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    
    <?php 
    endif;
    
    if (($this->specialitiesData)): ?>
    <tbody>
    <?php foreach($this->specialitiesData as $item) : ?>
        <tr>
            <td><?php echo $item->speciality ?></td>
            <td><?php echo $item->experience?></td>
           
            <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
            <td>
                <a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatespecialityedit&view=candidatespecialityedit&layout=candidatespecialityedit&idUser=' . $item->idUser . '&id=' . $item->id . '&lang=' . $this->state->get('lang', '') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid' , 0) . '&view=candidatespeciality&layout=candidatespecialitydelete&idUser=' . $item->idUser . '&id=' . $item->id . '&lang=' . $this->state->get('lang' ,'') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
            </td>
            <?php endif; ?>
        </tr>
        
      
    <?php   endforeach; 
    unset($item);
    ?>
    </tbody>
    <?php
    else:
      echo '<tr><td colspan="4" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>
 * 
 */ ?>
<a name="education"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_EDUCATION'); ?></h4>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_EDUCATION_TITLE') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_LEVEL') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_INSTITUTION') ?></th>
            <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
            <th></th>
            <?php endif; ?>
        </tr>
    </thead>
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="4">
                <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid') . '&model=candidateeducationedit&view=candidateeducationedit&layout=candidateeducationedit&idUser=' . $this->state->get('idUser', 0) . '&lang=' . $this->state->get('lang', ''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
                
            </td>
        </tr>
    </tfoot>
    <?php 
        endif;
        if (($this->educationData)) : 
             $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
            ?>
   
    <tbody>
        <?php foreach($this->educationData as $item) : 
               $commonUrl .= '&idUser=' . $item->idUser . '&id=' . $item->id ;
            ?>
        <tr>
            <td><?php echo $item->educationTitle ?></td>
            <td><?php echo $item->degreeLevel?></td>
            <td><?php echo $item->educationInstitute?></td>
            <td>
                <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
                <br />
                <a href="<?php echo JRoute::_($commonUrl .'&model=candidateeducationedit&view=candidateeducationedit&layout=candidateeducationedit', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_($commonUrl . '&view=candidateeducation&layout=candidateeducationdelete', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
                <?php endif; ?>
            </td>
        </tr>
        
         
    <?php   
        endforeach;
        unset($item);
        ?>
        </tbody>
        <?php
    else:
        echo '<tr><td colspan="4" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>

<a name="spokenlanguages"></a>
<h4><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGES'); ?></h4>
<table class="table table-striped table-bordered">
     <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGE') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_LEVEL') ?></th>
            <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
            <th></th>
            <?php endif; ?>
        </tr>
    </thead>
    <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
    <tfoot class="no-print">
        <tr>
            <td colspan="3">
                <form method="post" action="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatespokenlanguageedit&view=candidatespokenlanguageedit&layout=candidatespokenlanguageedit&idUser=' . $this->state->get('idUser') . '&lang=' . $this->state->get('lang', ''))?>" >
                    <div class="form">
                        <div class="elg-column" >
                            <div class="formelm" >
                                <button class="btn btn-primary">
                                    <?php echo JText::_('COM_ELGERGASIA_ADD'); ?>
                                </button>
                                
                            </div>
                        </div>
                    </div>
                </form>
            </td>
        </tr>
    </tfoot>
    <?php 
    endif;
    if (($this->languageData)) : ?>
   
    <tbody>
        <?php
            foreach($this->languageData as $item) :
         ?>
        <tr>
            <td><?php echo $item->spokenLanguage ?></td>
            <td><?php echo $item->rankNeut?></td>
            <?php if(utils::canUserEditData('', $this->state->get('id')))  : ?>
            <td>
                <a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&model=candidatespokenlanguageedit&view=candidatespokenlanguageedit&layout=candidatespokenlanguageedit&idUser=' . $this->state->get('idUser', 0) . '&id=' . $item->id . '&lang=' . $this->state->get('lang', '') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_EDIT'); ?>
                </a>
                <br />
                <a href="<?php echo JRoute::_('index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&view=candidatespokenlanguage&layout=candidatespokenlanguagedelete&idUser=' . $this->state->get('idUser', 0) . '&id=' . $item->id . '&lang=' . $this->state->get('lang', '') , false)?>" title="<?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_DELETE'); ?>
                </a>
            </td>
            <?php endif; ?>
        </tr>
    <?php   endforeach; ?>
    </tbody>
    <?php 
    unset($item);
    
    else :
        echo '<tr><td colspan="3" >' . JText::_('COM_ELGERGASIA_NO_DATA_FOUND') . '<br />' .  JText::_('COM_ELGERGASIA_USE_ADD_FOR_NEW') . '</td></tr>';
    endif;
    ?>
</table>

</div>
<div class="clear-fix">&nbsp;</div>
<br />
	<div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
 <br />