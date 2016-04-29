<?php 
namespace Core;
/**
*  Class Pagination
*/
class Pagination
{
	
	public function generate_paging_text($curPage,$totalRec,$maxRec){
        $totalPage=ceil($totalRec/$maxRec);
        $str="";
        
        /*prev button*/
        if($curPage>1){             
            $prevPage = $curPage-1;
            $str.=" ".makeLink("prev","?p=".$prevPage)." ";            
        }
        
        /*generate page number*/
        for($i=1;$i<=$totalPage;$i++){
            if($i==$curPage){
                $bold=true;
            }else{
                $bold=false;
            }
            $str.=" ".makeLink($i,"?p=".$i,$bold)." ";
        }
        
        /*next button*/
        if($curPage<$totalPage){             
            $nextPage=$curPage+1;
            $str.=" ".makeLink("next","?p=".$nextPage)." ";            
        }
        
        return $str;
        
    }
    
    public function makeLink($str,$url,$bold="false"){
        if($bold){
            $str="<b>".$str."</b>";
        }
        return '<a href="'.$url.'">'.$str.'</a>';
    } 
}