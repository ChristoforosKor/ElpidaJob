<?php
namespace ELG\Component\ElgJobs\Site\Model;

/**
 * Description of DataParams
 *
 * @author christoforos
 */
class ListParams {

    private $listParams;
    

    public function __construct($listParams) {
        
        $this->listParams = $listParams;
       
    }

    
    public function getOrdering() {
        return (isset($this -> listParams['fullordering'] ) ? $this -> listParams['fullordering'] : '' );
    }
    
    public function getPageSize($default = 5){
        return (isset($this -> listParams['limit'] ) ? $this -> listParams['limit'] : $default );
    }
    
    public function getPage($default = 0) {
        return (isset($this -> listParams['start'] ) ? $this -> listParams['start'] : $default );
    }
}
