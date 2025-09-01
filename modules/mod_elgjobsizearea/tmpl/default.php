<?php 
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );


?>
<div class = "filters_list_block" id="filterSizes">
    <div class = "filters_list_block_title"><?php echo $module -> title; ?></div>
    <div class = "filters_list_block_checkboxes form-group " >
            <input  type = "radio" id = "sizeFilter_" value="" name = "filter[sizeFilter]">
            <label for = "sizeFilter_">Όλα</label>
    </div>
    <?php foreach($data as $item): 

    ?>
        <div class = "filters_list_block_checkboxes form-group " >
            <input  type = "radio" id = "sizeFilter_<?php echo $item -> id; ?>" value="<?php echo $item -> id; ?>" name = "filter[sizeFilter]">
            <label for = "sizeFilter_<?php echo $item -> id; ?>"><?php echo $item -> areasize; ?> (τμ)</label>
        </div>
    <?php    endforeach; unset($item); ?>
    
</div>

