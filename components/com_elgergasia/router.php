<?php 
defined('_JEXEC') or die;

function ElgErgasiaBuildRoute(&$query)
{
	$segments = array();
	// var_dump($query);
	if(isset($query['view']))
	{
            switch ($query['view'])
            {
                case 'candidate':
                    $segments[] = $query['id'];
                    unset($query['id']);
                    unset($query['layout']);
                    unset( $query['view'] );
                break;
                case 'job' :
                    $segments[] = $query['id'];
                    unset($query['id']);
                    unset($query['layout']);
                    unset( $query['view'] );                    
                    break;
                case 'employer' :
                    $segments[] = $query['id'];
                    unset($query['id']);
                    unset($query['layout']);
                    unset( $query['view'] );
                    break;
                case 'employeredit' :
                    $segments[] = strtolower(JText::_('COM_ELG_EDIT'));
                    $segments[] = $query['id'];
                    unset($query['id']);
                    unset($query['idUser']);
                    unset($query['layout']);
                    unset( $query['view'] );
                    
            }
        }
        if(isset($query['idSpeciality']))
        {
            if(isset($query['slug']))
            {
                $segments[] = $query['idSpeciality'] . '-' . $query['slug'];
                unset($query['slug']);
            }
            else
            {
                $segments[] = $query['idSpeciality'];
            }
            unset($query['idSpeciality']);
            
        }
        if(isset($query['idIndustry']))
        {
            if(isset($query['slug']))
            {
                $segments[] = $query['idIndustry'] . '-' . $query['slug'];
                unset($query['slug']);
            }
            else
            {
                $segments[] = $query['idIndustry'];
            }
            unset($query['idIndustry']);
            
        }
            
   return $segments;
}

function ElgErgasiaParseRoute($segments)
{
    $Itemid = JFactory::getApplication()->getMenu()->getActive()->id; 
    $vars = array();
    $sNo = count($segments);
    
        if($Itemid === '196' || $Itemid === '219' || $Itemid === '229') // candidate
        {
            if($sNo == 1)
            {
                if(is_numeric($segments[0]))
                {
                    $vars['view'] = 'candidate';
                    $vars['id'] = $segments[0];
                }
                else 
                {
                    $vars['view'] = 'candidates';
                    $vars['controller'] = 'candidates';
                    $parts = explode('-',$segments[0]);
                    $vars['idSpecialization'] = $parts[0];
                }
            }
        }
        elseif($Itemid === '201' || $Itemid === '231' || $Itemid === '221')
        {
          
            if($sNo == 1)
            {
                if(is_numeric($segments[0]))
                {
                    $vars['view'] = 'job';
                    $vars['model'] = 'job';
                    $vars['id'] = $segments[0];
                }
                else
                {
                    $vars['view'] = 'jobs';
                    $vars['controller'] = 'jobs';
                    $parts = explode('-',$segments[0]);
                    $vars['idSpeciality'] = $parts[0];
                    $vars['layout'] = 'jobs';
                }
            }
        }
        elseif($Itemid === '228' || $Itemid === '233' || $Itemid === '203')
        {
            if($sNo == 1)
            {
                if(is_numeric($segments[0]))
                {
                    $vars['view'] = 'employer';
                    $vars['model'] = 'employer';
                    $vars['id'] = $segments[0];
                }
                else
                {
                    $vars['view'] = 'employers';
                    $vars['controller'] = 'employers';
                    $parts = explode('-',$segments[0]);
                    $vars['idIndustry'] = $parts[0];
                    $vars['layout'] = 'employers';
                }
            }
        }
    
   
	
    return $vars;
}