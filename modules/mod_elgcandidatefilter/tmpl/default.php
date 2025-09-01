<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<style>
    .form-group label.label-select::before {
        display:none;
    }
</style>
<div class ="filters_list_block" id="filterCandidates">
    <div class = "filters_list_block_title"><?php echo $module -> title; ?></div>
    <div class="form-group">
        <label for="candidateState" class="label-select">Κατάσταση</label>
        <select  id="candidateState" class="form-control" name="filter[candidateState]">
            <option value="">Όλα</option>
            <option value="1">Ενεργά</option>
            <option value="0">Μη ενεργά</option>
        </select>        
    </div>
    <div class="form-group">
        <label class="label-select" for="candIns">Ασφάλιση</label>
        <select class="form-control" name="filter[candIns]" id="candIns">
            <option value="">ΟΛΑ</option>
            <option value="1">ΙΚΑ</option>
            <option value="2">Εργόσημο</option>
        </select>
        
    </div>
<!--    <div>
        <?php // echo $form->getLabel('lastOfficeVisit'); ?>
        <?php // echo $form->getInput('lastOfficeVisit'); ?>
    </div>-->
    <div class="filters_list_block_checkboxes form-group">
        <input type="checkbox" id="candidateTeam" name="filter[candidateTeam]" value="1" >
        <label for="candidateTeam">Ομάδα</label>
    </div>
    <div class="filters_list_block_checkboxes form-group">
        <input type="checkbox" id="candRef" name="filter[candRef]" value="1" >
        <label for="candRef">Συστάσεις διαθέσιμες</label>
    </div>
    <?php /*foreach($data as $item): 

    ?>
        <div class = "filters_list_block_checkboxes form-group " >
            <input  type = "radio" id = "sizeFilter_<?php echo $item -> id; ?>" value="<?php echo $item -> id; ?>" name = "filter[sizeFilter]">
            <label for = "sizeFilter_<?php echo $item -> id; ?>"><?php echo $item -> areasize; ?> (τμ)</label>
        </div>
    <?php    endforeach; unset($item); */ ?>
    
</div>

