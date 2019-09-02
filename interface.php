<!DOCTYPE html>

<html>
<head>

<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

<!-- Font Awesome -->
<script src="https://kit.fontawesome.com/1264232a04.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"> </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<style>

    h6 {
        font-size: 15px;
    }

</style>
<body>

<br>
 <form>

    <!--First Card, Find Papers-->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class ="card pb-3">
                
                <div class="card-header">
                    <h5>1. Find Papers</h5>
                </div>

                <div class="card-body">      
                    
                   
                    <p style="display:inline-block" >With <strong>all</strong> of the words:   </p>
              
                    <i class="far fa-question-circle ml-1" style="color:#333333; font-size:14px" title=""></i>
                
                    <input type = "text" name = "search_arxiv_and" style="display:block" />
                     
                    <br>


                    <p style="display:inline-block" >With <strong>at least one</strong> of the words:   </p>
              
                    <i class="far fa-question-circle ml-1" style="color:#333333; font-size:14px" title=""></i>
                
                    <input type = "text" name = "search_arxiv_or" style="display:block" />
                    
                    <br>

                    
                    
                </div>  <!--End of card-body-->
            </div> <!--End of card-->
        </div> <!--End col-->
    </div> <!--End row-->


    <br>


    <!--Second Card, Save Papers-->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class ="card pb-3">
                
                <div class="card-header">
                    <h5>2. Save Papers <h6>It's recommended to have a new, separate folder for everytime you use this tool</h6></h5>
                </div>

                <div class="card-body">      

                    <p>Directory to download results in: (using the synatx: C/Users/JohnDoe/Desktop/myresults/)</p>
                    <input type = "text" name = "dest">
                    <br>
                    <br>
                    <p>Number of Documents to be downloaded (Default: 10):</p>
                    <input type = "text" name = "max_len" value=10 >

                </div>  <!--End of card-body-->
            </div> <!--End of card-->
        </div> <!--End of col-->
    </div> <!--End of row-->


    <br>


    <!--Third Card, Search within Paper-->
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class ="card pb-3">
                
                <div class="card-header">
                    <h5>3. Search within Papers </h5>
                </div>

                <div class="card-body">      

                         <p style="display:inline-block" >With the word:   </p>
              
                    <i class="far fa-question-circle ml-1" style="color:#333333; font-size:14px" title=""></i>
                
                    <input type = "text" name = "search_paper" style="display:block" />
                     
                    <br>


                    

                </div> <!--End of card-body-->
            </div> <!--End of card-->
        </div> <!--End of col-->
    </div> <!--End of row-->

    <br>
    <br>
    <div class="text-center">
    <input type = "submit" name = "search" value = "Search"  class="btn btn-primary text-center" />
    </div>
    <br>
    <br>

</form>



<?php

if ($_GET){
    fun();
}



function fun(){    
ini_set('max_execution_time', 300); //300 seconds = 5 minutes


if (!empty($_GET['search_arxiv_and'])){
    $get_arxiv_and = escapeshellarg($_GET['search_arxiv_and']);
}
else {
    $get_arxiv_and = "0";
}

if (!empty($_GET['search_arxiv_or'])){
    $get_arxiv_or = escapeshellarg ($_GET['search_arxiv_or']);
}
else {
    $get_arxiv_or = "0";
}


$get_dest =escapeshellarg ( $_GET['dest']);
$get_len = escapeshellarg ($_GET['max_len']);
$get_paper = escapeshellarg ($_GET['search_paper']);



//echo "<script>console.log( 'Debug Objects: " . $get_dest . "' );</script>";

//echo $get_dest;

shell_exec("python /Users/Lobna/Desktop/Internship_files/extract.py '".$get_arxiv_and."' '".$get_arxiv_or."' '".$get_dest."' $get_len '".$get_paper."' ");

// $get_arxiv $get_dest $get_len 
}

?>
</body>
</html>