<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<div class = "filters_list_block" id="filterJobState">
    
<!--     
        <label for="jobState" class="filters_list_block_title">Κατάσταση</label>
        <select  id="jobState" class="form-control" name="filter[jobState]">
            <option value="0">Όλα</option>
            <option value="1">ΣΕ ΕΠΙΘΕΩΡΗΣΗ</option>
            <option value="2">ΕΝΕΡΓΟ</option>
            <option value="3">ΑΝΕΝΕΡΓΟ</option>
            <option value="4">ΕΚΛΕΙΣΕ ΘΕΤΙΚΑ</option>
            <option value="5">ΕΚΛΕΙΣΕ ΑΡΝΗΤΙΚΑ</option>
        </select>  -->
<div class="filters_list_block_title" >
     <?php echo $stateField->label; ?>
    </div>
      <?php echo $stateField->input; ?>
    
</div>



