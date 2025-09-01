<?php

/**
 * @author e-logism http://www.e-logism.gr
 * @copyright (C) 2013-2030 e-logism. All rights reserved.
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 * */

namespace ELG\Component\ElgJobs\Administrator\Table;

use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class Personnelpreferencehours extends Table {

    var $id = null;
    var $idCandidate = null;
    var $idHour = null;
    

    public function __construct(DatabaseDriver $db) {
        parent::__construct('#__elg_ergasia_candidates_hours', 'id', $db);
    }

}
