 <?php

const MAX_ROWS = 5;
 
/**
* Function for pagination
**/
function Pagination($rows, array $current_page = array())
{
    $pagination = array();

if (!(isset($pagenum))) 
    { 
        $pagenum = 1; 
    }

if (isset($_GET['pn'])) 
    {
        $pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);   
    }

$last_page = ceil($rows/MAX_ROWS);
    
if ($last_page < 1) 
    {
        $last_page = 1;
    }

if ($pagenum < 1) 
    {
        $pagenum = 1;
    } 
elseif($pagenum > $last_page) 
    {
        $pagenum = $last_page;
    }
    
    $max = 'limit ' .($pagenum - 1) * MAX_ROWS.',' .MAX_ROWS;
    $link_page =& $current_page['pn'];
    $paginationCtrls = "";
    if ($last_page != 1) 
    {
        if ($pagenum > 1) 
          {
            $link_page = $pagenum - 1;
            $paginationCtrls .= "<a href='" . url('', $current_page) . "'> 
                Previous </a> &nbsp; &nbsp;";
            
            for ($i = $pagenum - 4; $i < $pagenum; $i++) 
             { 
                if ($i > 0) 
                 {
                    $paginationCtrls .= "<a href='".url('', $current_page)."'>$i</a> &nbsp; ";
                 }
             }
          }

        $paginationCtrls .= ''.$pagenum.' &nbsp; ';
        for ($i = $pagenum + 1; $i <= $last_page; $i++) 
        {
            $link_page = $i;
            $paginationCtrls .= "<a href='".url('', $current_page)."'>$i</a> &nbsp; ";
            if ($i >= $pagenum + 4) 
                {
                    break;
                }
        }

        if ($pagenum != $last_page) 
         {
            $page_link = $pagenum + 1;
            $paginationCtrls .= " &nbsp; &nbsp; <a href='".url('', $current_page)."'>Next</a>";
         }
    }
    $pagination = array(
        'max' => $max,
        'last_page' => $last_page,
        'pagenum' => $pagenum,
        'paginationCtrls' => $paginationCtrls,
    );
    return $pagination;
}