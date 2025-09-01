<?php
namespace ELG\Component\ElgJobs\Site\Libs\Controller;
/* ------------------------------------------------------------------------
  # com_alumincocc - e-logism library
  # ------------------------------------------------------------------------
  # author    e-logism
  # copyright Copyright (c) 2010-2022 e-logism.com. All Rights Reserved.
  # @license - GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
  # Websites: http://www.e-logism.com
  # Technical Support: http://www.e-logism.gr/index.php?main_page=contact_us&zenid=5q08u7hbg8f4eitc4hb8dfmlq5

  ----------------------------------* */

defined('_JEXEC') or die('Restricted access');




class DevEx {
     
    public function setListParams($input) {     
      
        $data['filterData'] = [];
        $tmp =  json_decode( $this -> input -> getRaw("filter", "") );   
        if (  is_array( $tmp ) ) {
            if (!is_array($tmp[0])) {
                $data['filterData'][] =  $tmp ;
            }
            else {
                $data['filterData'] = $tmp;
            }
        }
      
      
        $dxeta = array_reduce ( $data['filterData'], function($curry, $item){
           if ( is_array($item) ) {
               if ( $item[0] === "dxeta" ) {
                   return $item[2];
               }
           }
        });
        
      if ( $dxeta == 1 ) {
          $input -> set('take', 10000000);
          $input -> set('skip', 0);
       
      }
//      $data['offset'] = $input -> getInt('skip', 0);
//      $data['limit'] = $input -> getInt('take', 10);
//      $data['start'] = $this->input->getInt('offset', 0);
//      $data['list.limit'] = $data['limit']; //$this -> input -> getInt('limit', 10);
      $this->input->set('limitstart', $input -> getInt('skip', 0)); //$this -> input -> getInt('offset', 0) );
      $this->input->set('limit', $input -> getInt('take', 10)); //$this -> input -> getInt('limit', 10) );
    
      $sort = json_decode ($input-> getRaw('sort', '') ) ;
      if ($sort != '') {
        if ( is_array($sort) ) {
            $sortBy = $sort[0] -> selector;
            if ( $sort[0] -> desc ) {
                $sortOrder = 'desc';
            }
            else {
                $sortOrder  = 'asc';
            }
            $data['sort'] = $sortBy;
            $data['order'] = $sortOrder;
        }
      }
      
//      $data['filterData'] = [];
//      $tmp =  json_decode( $this -> input -> getRaw("filter", "") );   
//      if (  is_array( $tmp ) ) {
//            if (!is_array($tmp[0])) {
//                $data['filterData'][] =  $tmp ;
//            }
//            else {
//                $data['filterData'] = $tmp;
//            }
//        }

      return  $data;
     }
}

