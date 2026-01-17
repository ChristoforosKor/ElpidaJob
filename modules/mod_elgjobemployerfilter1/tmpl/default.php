<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<div class = "filters_list_block" id="filterHour">
    <div class = "filters_list_block_title"><?php echo $module -> title; ?></div>
    <?php foreach($data as $item): 

        
        ?>
        <div class="filters_list_block_checkboxes form-group">
            <se" id="hourFilter_<?php echo $item -> idHour; ?>" value = "<?php echo $item -> idHour; ?>" name="filter[hourFilter][]">
            <label for="hourFilter_<?php echo $item -> idHour; ?>"><?php echo $item -> hour; ?></label>
        </div>
    <?php    endforeach; unset($item); ?>
    
</div>

