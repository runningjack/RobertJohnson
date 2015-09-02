<?php

class Pagination{

	public $nr;

	public $pn;

	public $itemsPerPage;

	public $limit;

	

	//public 

	public function render($pg){

	  $purl = array();

		$myurl = new Url("");

		if(isset($_GET['url'])){

			

			$purl	=	$_GET['url'];

			$purl	=	rtrim($purl);

			$purl	=	explode('/',$_GET['url']);

			

			

		}else{

			$purl =null;

			

		}

		if(!isset($purl['2'])){

			$pn = 1;

		}else{

		$pn = $purl['2'];

		}

		if($this->itemsPerPage > $this->nr  ){

			$this->itemsPerPage = $this->nr;

		}

	  if ($this->nr == 0){ // checks if no data in the data table

		  $this->nr = 1;

		  $this->itemsPerPage = $this->nr;

	  }

	  $lastPage=ceil($this->nr/$this->itemsPerPage);

	  if($pn<1){

		  $pn =1;

	  }

	  else if($pn > $lastPage){

		  $pn=$lastPage;

	  }

	  //

	  $centerPages="";

	  $sub1 = $pn-1;

	  $sub2 = $pn-2;

	  $add1 = $pn+1;

	  $add2 = $pn+2;

	  if($pn==1){

		  $centerPages .=" <span class='pagNumActive'>".$pn."</span> ";

		  $centerPages .=" <a href='"; 

		  $centerPages .= $myurl->link("$pg/index/$add1")."' >$add1</a>";

	  }

	  else if($pn==$lastPage){

		  $centerPages .=" <a href='"; 

		  $centerPages .=$myurl->link("$pg/index/$sub1")."' >$sub1</a>";

		 	$centerPages .=" <span class='pagNumActive'>".$pn."</span> ";

	  }

	  else if($pn > 2 && $pn < ($lastPage-1)){

		  $centerPages .=" <a href='"; 

		  $centerPages .=$myurl->link("$pg/index/$sub2")."' >$sub2 </a>  ";

		  $centerPages .=" <a href='"; 

		  $centerPages .=$myurl->link("$pg/index/$sub1")."' >$sub1 </a>  ";

		  $centerPages .=" <span class='pagNumActive'>".$pn."</span> ";

		   $centerPages .=" <a href='"; 

		   $centerPages .=$myurl->link("$pg/index/$add1")."' >$add1 </a>  ";

		  $centerPages .=" <a href='"; 

		  $centerPages .=$myurl->link("$pg/index/$add2")."' >$add2 </a>  ";

	  }

	  else if($pn>1 && $pn < $lastPage){

		   

		  $centerPages .=" <a href='"; 

		  $centerPages .=$myurl->link("$pg/index/$sub1")."' >$sub1 </a>  ";

		  $centerPages .=" <span class='pagNumActive'>".$pn."</span> ";

		   $centerPages .=" <a href='"; 

		   $centerPages .=$myurl->link("$pg/index/$add1")."' >$add1 </a>  ";

		  

	  }

	  

	  //

	  //displaying Pagination

	  

	  $paginationDisplay ="";

	  if($lastPage !="1"){

	  	$paginationDisplay .="<span style='margin-right:50px' class='page_of'>Page <strong>".$pn."</strong> of ".$lastPage."</span>";

		if($pn != 1){

			$previous = $pn -1;

			$paginationDisplay .=" <a href='";

			$paginationDisplay .=$myurl->link("$pg/index/$previous")."' >&laquo</a>  ";

		}

		$paginationDisplay .="<span class='paginationNumbers'>".$centerPages."</span>";

		if($pn != $lastPage){

			$nextPage = $pn+1;

			$paginationDisplay .=" <a href='";

			$paginationDisplay .= $myurl->link("$pg/index/$nextPage")."' >&raquo; </a>  ";

		}

	  }

		

		return $paginationDisplay; 

		

	}

	

	function pgLimit($pn=1){

		return $this->limit =' LIMIT '.($pn -1)*$this->itemsPerPage.",".$this->itemsPerPage;

	}

	

}

