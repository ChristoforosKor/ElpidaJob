<?php
namespace   ELG\Component\ElgJobs\Site\Lib\Adapter;
          
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
use Joomla\Input\Input;
use ELG\Component\ElgJobs\Site\Interfaces\IListInputAdapter;


class DevexListInputAdapter implements IListInputAdapter {
     
    public function setListParams(Input $input): void {     
      
        
        $requestFilters =  json_decode( $input -> getRaw("filter", "") );   
      
        if ( !is_array ( $requestFilters ) ) // no filters at all
        {
            $filters = [];
        }
        elseif ( !is_array($requestFilters[0] ) ) // single dimension array means only one filter
        {
            $filters[ $requestFilters[0]] = $requestFilters;
        }
        else // we have multiple filters and loop over them 
        {
            foreach($requestFilters as $requestFilter)
            {
                if (  is_array( $requestFilter[0] ) ) // this is a filter 
                {
                    $filters[ $requestFilter[0] ] =  $requestFilter ;
                }
                else // this is not a filter is an operand like "and", "or" etc. 
                {
                    $filters[] = $requestFilter;
                }
            }
        
        }
        
        
        
        $dxeta = array_reduce ( $filters, function($curry, $item){
           if ( is_array($item) ) {
               if ( $item[0] === "dxeta" ) {
                   return $item[2];
               }
           }
        });
        
        
        $input -> set("filter", ( $filters === null ? [] : $filters ) );
        
        
        
      if ( $dxeta == 1 ) {
          $input -> set('take', 10000000);
          $input -> set('skip', 0);
       
      }

      $sort = json_decode ($input-> getRaw('sort', '') ) ;
      $sortBy = '';
      $sortOrder = '';
      if ($sort != '') {
        if ( is_array($sort) ) {
            $sortBy = $sort[0] -> selector;
            if ( $sort[0] -> desc ) {
                $sortOrder = 'desc';
            }
            else {
                $sortOrder  = 'asc';
            }
        }
      }
      
      
      $list = [
          'start' => $input -> getInt('skip', 0), 
          'limit' => $input -> getInt('take', 10),
          'fullordering' => $sortBy . ' ' . $sortOrder
        ];
      /**
       * @todo The below must be a  bug on joomla. It should not be neccesary to set limitstart on session. 
       * $list['start'] should be enough. 
       * I must make a question to joomla team.
       */
      $input -> set('limitstart', $list['start']); 
      $input -> set('list', $list);
//      $input -> set('adapter ', 'Devex');
    }
}

