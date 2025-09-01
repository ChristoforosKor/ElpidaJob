<?php

namespace ELG\Component\ElgJobs\Site\Interfaces;

use Joomla\Input\Input;

/**
 *
 * @author ckorifidis
 */
interface IListInputAdapter {
    public function setListParams(Input $input) : void;
}
