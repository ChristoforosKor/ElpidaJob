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
    $app = JFactory::getApplication();
    $user = JFactory::getUser();
    $levels = $user->getAuthorisedViewLevels();
    $menu = $app->getMenu();
    $langs = JLanguageHelper::getLanguages();
    
    $u = JUri::getInstance();
    $u->delVar('controller');
    $curUrl = $u->toString();
    $curLang = $u->getVar("lang"); 
    
    $homes = array();
    
    foreach ($menu->getMenu() as $item)
    {
        if ($item->home)
        {
                $homes[$item->language] = $item;
        }
    }
   
    foreach ($langs as $i => $language) {
        if (!JLanguage::exists($language->lang_code))
        {
           unset($langs[$i]);
        }
        elseif (!isset($homes[$language->lang_code]))
        {
            unset($langs[$i]);
        }
        elseif (isset($language->access) && $language->access && !in_array($language->access, $levels))
        {
            unset($langs[$i]);
        }
        
    }
   
?>


<ul class="nav nav-tabs translateBar">
   <?php foreach($langs as $value): 
        $liClass = ($value->sef == $curLang ? "active" : "");
        $textClass = (in_array($value->lang_code, $this->translatedLanguages) ? "" : "text-error" );
        ?>
    <li class="<?php echo $liClass;?>" id="trans_<?php echo $value->sef; ?>" > <a  class="<?php echo $textClass ?>" onclick="checkUnsubmitData('<?php echo  $value->sef ;?>', '<?php echo $value->lang_code  ?>')"  ><?php echo $value->title_native; ?> </a></li>
    <?php 
        endforeach;
        unset($value);
   ?>
</ul>
<script type="text/javascript">
    var curLang = '<?php echo $curLang; ?>';
    var trasnlateableContainer = 'translateableContent';
    var idV= <?php echo $u->getVar('id', 0); ?>, idUserV = <?php echo $u->getVar("idUser", 0) ?>, langV, langCodeV;
   
    function checkUnsubmitData(lang, langCode) {
        langV = lang;
        langCodeV =langCode;
        if(isUnsubmitedDataExists('')) {
            var langNative = jQuery('.translateBar li.active').text();
            var modal = jQuery('#myModal');
            modal.find('#dirtyLanguage').text(langNative);
            modal.modal();
        }
        else {
            getLangDataTranslation();
        }
    }
    
    function getLangDataTranslation() {
        jQuery('.translateableContent .content').css('visibility', 'hidden');
        jQuery.ajax({
            url: '?option=com_elgergasia&view=<?php echo $u->getVar('view'); ?>&model=<?php echo $u->getVar('model', $u->getVar('view')); ?>&layout=<?php echo $u->getVar('layout') . '_translation'; ?>&controller=ajaxproxy&format=ajax&data[language]=' + langCodeV + '&data[idUser]=' + idUserV + '&data[id]=' +idV,
            success : showLangData
        });        
    }
    
    function showLangData(data) {
       jQuery('#translateBar .active').removeClass('active');
       jQuery('#trans_' + langV).addClass('active');
       var tbc = jQuery('.translateableContent');
       tbc.html(data);   
       tbc.children('.content').css('visibility', 'visible');
       tbc.parents('form').find('input[name=language]').val(langCodeV);
    }
    
    function isUnsubmitedDataExists(container) {
        var res = false;
        jQuery('.' + trasnlateableContainer).find('input[type=text], textarea').each(function(index, item){
            if(item.defaultValue != item.value) {
                res =  true;
                return;
            }
        });
        return res;

    }
</script>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel"><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA'); ?></h4>
      </div>
      <div class="modal-body text-left">
          <p><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_1') . ' "<em id="dirtyLanguage"></em>".'; ?></p>
          <p><em><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_2') ?></em></p>
          <p><?php echo JText::_('COM_ELGERGASIA_UNSUBMITED_DATA_CLAUSE_3'); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" ><?php echo JText::_('JNO') ?></button>
        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="getLangDataTranslation()"><?php echo JText::_('JYES') ?></button>
       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->