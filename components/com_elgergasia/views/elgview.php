<?php
/*------------------------------------------------------------------------
# com_elgergasia - e-logism job agency.
# ------------------------------------------------------------------------
# author    e-logism
# copyright Copyright (C) 2013 e-logism.gr. All Rights Reserved.
# @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
# Websites: http://www.e-logism.gr 
----------------------------------**/
 defined( '_JEXEC' ) or die( 'Restricted access' );
 class  ElgergasiaViewElgView extends JViewHTML{
    protected $state;
    public function __construct(JModel $model, SplPriorityQueue $paths = null) {
        parent::__construct($model, $paths);
        $this->state = $this->model->getState();
        $arrRestrGorups = array(1, 9, 13, 14);
        $this->user = JFactory::getUser();
        //if(count(array_intersect($arrRestrGorups, $this->user->groups)) > 0  )
        if(Utils::canUserEditData('', $this->state->get('id')))
        {
            $this->isUserPrivileged = true;
        }
        else {
            $this->isUserPrivileged = false;
        }
    }
 }
?>
