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

 $canEditData = utils::canUserEditData( '', $this->state->get('id') );
 $hasBasicData = count(  get_object_vars( $this -> basicData ) ) > 0;
    if ( $hasBasicData ):
        $showPhoto = (bool)$this -> basicData -> showPhoto && count( $this -> photosData) > 0 ;
    else:
        $showPhoto = false;
    endif;
   
?>



<div class="elg" >
    <p>
        <?php echo JText::_('COM_EGLERGASIA_VIEW_GDPR_STATE'); ?>
    </p>
 <h2><?php echo JText::_('COM_ELGERGASIA_PERSONNEL'). ': ' . $this -> candidate -> id;  ?>   </h2>
   <div class="candidate" >
    <h3><?php echo JText::_('COM_ELGERGASIA_PREFERENCES') ?></h3>
		<div class="preferences" >
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
			</div>
			<?php if(count($this->prefTeam) > 0 ) : ?>
			<div class="pull-left" >
				<h4><?php echo JText::_('COM_ELGERGASIA_TEAM'); ?></h4>
				<ul>
					<?php
						foreach($this->prefTeam as $item) :
							echo '<li>', $item->name, ' (', $item->idUserTeam, ') </li>';
						endforeach;
						unset ($item);
				?>
				</ul>				
			</div>
			<?php endif; ?>
		</div>
	</div>

	<div class="clearfix">&nbsp;</div>
          <?php if( $showPhoto ) :?>
<div>
	
   	
  <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_CANDIDATE_PHOTOS'); ?></h3>
    <table class="candidatephotos table table-bordered">
       
        <tfoot class="no-print">
           <tr>
               <td colspan="4">
                    
               </td>
           </tr>
       </tfoot>
     
       <tbody> 
           <tr>
                <td class="photo" >
        
           <?php
              
                foreach($this->photosData as $photo) : ?>

               <?php echo '<a class="modalpop" href="'. JUri::base() . $this->photoUrlPart .  '/' . $photo->photo . '_large.' . $photo->photoExtension . '" ><img src="'. JUri::base() . $this->photoUrlPart .  '/' . $photo->photo . '_medium.' . $photo->photoExtension . '" /></a>' ?>

        <?php 
           endforeach;
           unset($photo);
          
       ?>
                    </td>
           </tr>
       </tbody>
    </table>
  <div >
       <?php if( $canEditData )  : ?>
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
        <?php endif; ?>
  </div>
    
    </div>  
    <?php endif;  // end show photos?>
 <div class="clearfix">&nbsp;</div>
 
 
 
 
 <br />
	<div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
 <?php /**
        <br />
 <h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_BASIC_DATA'); ?></h3>
 <table class="table table-bordered">
   
    
   
    <tbody>
   
    
   
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
    </tr>
       
    </tbody> 
</table>
**/ ?>

<h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_CHARACTERISTICS_DATA'); ?></h3>
<table class="table table-bordered">
   
    
  
    <tbody>
   <?php /**
    <tr>    
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_GENDER'); ?></th><td><?php echo $this->characteristicData->gender ?></td>
        <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_FIELD_DOB'); ?></th><td><?php echo($this->characteristicData->dateOfBirth) ?></td>
    </tr>
    * **
    */ ?>
    <tr>    
        <th colspan="4" style="text-align: left" ><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_ABOUT_ME_LABEL'); ?></th>
    </tr>
    <tr>
        <td colspan="4" ><?php echo $this->characteristicData->aboutMe ?></td>
    </tr>
   
    </tbody>
    
</table>





<?php 
    if (($this->experienceData)): 
        $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
        ?>
<h3><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE'); ?></h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_DURATION') ?></th>
            <?php /**
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EMPLOYER') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_INDUSTRY') ?></th>
             * 
             */ ?>
            <th><?php echo JText::_('COM_ELGERGASIA_VIEW_EMPLOYEE_EXPERIENCE_SECTOR') ?></th>
           
    </thead>
    
    <tbody>
  <?php foreach($this->experienceData as $item) : 
      $commonUrl .= '&idUser=' . $item->idUser . '&id=' . $item->id ;
      ?>
        <tr>
            <td><?php echo $item->dateFrom . ' - ' .  $item->dateTo ?></td>
            <?php /**
            <td><?php echo $item->employerTitle?></td>
            <td><?php echo $item->industry?></td>
            **/ ?>
             <td><?php echo $item->speciality?></td>
             
          
            
        </tr>
    <?php endforeach;
    unset($item);
    ?>
     </tbody>
    
</table>
<?php endif; ?>


<?php  if (($this->specialitiesData)): ?>
<h3><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITIES'); ?></h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_SPECIALITY') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_EXPERIENCE_MONTH') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->specialitiesData as $item) : ?>
        <tr>
            <td><?php echo $item->speciality ?></td>
            <td><?php echo $item->experience?></td>
        </tr>
        
      
    <?php   endforeach; 
    unset($item);
    ?>
    </tbody>
   
</table>
 <?php
   
    endif;
    ?>

 <?php 
        if (($this->educationData)) : 
             $commonUrl = 'index.php?option=com_elgergasia&Itemid=' . $this->state->get('Itemid', 0) . '&lang=' . $this->state->get('lang', '');
            ?>
<h3><?php echo JText::_('COM_ELGERGASIA_CANDIDATE_EDUCATION'); ?></h3>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_EDUCATION_TITLE') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_LEVEL') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_INSTITUTION') ?></th>
            
            <th></th>
        </tr>
    </thead>
   
   
   
    <tbody>
        <?php foreach($this->educationData as $item) : 
               $commonUrl .= '&idUser=' . $item->idUser . '&id=' . $item->id ;
            ?>
        <tr>
            <td><?php echo $item->educationTitle ?></td>
            <td><?php echo $item->degreeLevel?></td>
            <td><?php echo $item->educationInstitute?></td>
            <td>
                <a href="<?php echo JRoute::_($commonUrl .'&view=candidateeducation&layout=candidateeducation', false)?>" title="<?php echo JText::_('COM_ELGERGASIA_SHOW'); ?>" >
                    <?php echo JText::_('COM_ELGERGASIA_SHOW'); ?>
                </a>
               
            </td>
        </tr>
        
         
    <?php   
        endforeach;
        unset($item);
        ?>
        </tbody>   
</table>
 <?php endif; ?>
 <?php if (($this->languageData)) : ?>
<h3><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGES'); ?></h3>
<table class="table table-striped table-bordered">
     <thead>
        <tr>
            <th><?php echo JText::_('COM_ELGERGASIA_SPOKEN_LANGUAGE') ?></th>
            <th><?php echo JText::_('COM_ELGERGASIA_LEVEL') ?></th>
           
        </tr>
    </thead>  
    <tbody>
        <?php
            foreach($this->languageData as $item) :
         ?>
        <tr>
            <td><?php echo $item->spokenLanguage ?></td>
            <td><?php echo $item->rankNeut?></td>
           
        </tr>
    <?php   endforeach; ?>
    </tbody>
    <?php unset($item); ?>
</table>
<?php endif; ?>
<div class="clearfix">&nbsp;</div>
   


<br />
	<div class="fb-like" data-href="<?php echo JURI::current(); ?>" data-layout="button" data-action="like" data-show-faces="true" data-share="true"></div>
 <br />
</div>