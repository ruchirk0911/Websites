<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Art Gallery</title>

    
    <link href="css/bootstrap.css" rel="stylesheet">

    
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
     <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="mynav">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="Default.php">Art gallery</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="Default.php">Home</a>
                    </li>
                    <li>
                        <a href="about.php">About</a>
                    </li>
                    <li class = "dropdown">
                        <a href = "#" class = "dropdown-toggle" data-toggle = "dropdown" role="button" aria-haspopup="true" aria-expanded = "false">Pages<b class = "caret"></b></a>
            
                        <ul class = "dropdown-menu">
                            <li><a href = "Part01_ArtistsDataList.php">Artist Data List (Part 1)</a></li>
                            <li><a href = "Part02_SingleArtist.php?id=19">Single Artist (Part2)</a></li>
                            <li><a href = "Part03_SingleWork.php?id=394">Single Work (Part 3)</a></li>
                            <li class="active"><a href = "Part04_Search.php">Advanced Search (Part 4)</a></li>
                        </ul>
            
                    </li>
                </ul>
                <div class="nav navbar-nav navbar-right">
                    <div class="navbar-form navbar-right" >
                        <div class="form-group">
                            <lable id="name">Ruchir Ravindra Kadam</lable>

                            <input type="text" placeholder="Search Paintings" name="title" class="form-control" id="search" required>
                        </div>
                        <button class="btn btn-primary" id="btnsearch" onclick="searchurl()">Search</button>
                    </div>
                </div>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <script>
    function searchurl(){
        var titlevalue= $("#search").val();
        
        if(titlevalue !== ""){
            window.location = 'Part04_Search.php?title='+titlevalue;
        }else{
        	alert("Search box empty!");
            return false;
        }
    }
    </script>
<?php
include 'connect.php'; 
$autorun = "";
$titlevalue = "";
if(isset($_GET['title']))
{
	$titlevalue = filter_input(INPUT_GET,"title",FILTER_SANITIZE_STRING);
	if($titlevalue == ""){
		header('Location: Error.php');
	}else{
		$autorun = "
		<script>
		$(function(){
			filterajax('Filter.php?filter=0&text=".$titlevalue."')
		});
		</script>
		";
	}
}


?>
	<div class="row">
		<div class="container">
			<div class="col-lg-12" style="padding-left: 0px; padding-bottom: 0px;">
            	<h1 class="page-header">Search Results</h1>
        	</div>
        </div>
   	</div>
	<div class="container">
		<div class="row">
        	<div class="jumbotron filter">
        	<!-- <form> -->
        		<p><input type="radio" name="filter" id="ftitle" value="0" <?php if(isset($_GET['title'])){ echo 'checked="checked"';} ?> > Filter by Title:</p>
   				<input class="form-control form-control-lg <?php if(!isset($_GET['title'])){ echo 'hidden';} ?>" type="text" placeholder="Title" id="Title" name="Title" value="<?php echo $titlevalue; ?>"><br>
        		<p><input type="radio" name="filter" id= "fdescription" value="1"> Filter by Description:</p>
   				<input class="form-control form-control-lg hidden" type="text" placeholder="Description" id="Description" name="Description"><br>
        		<p><input type="radio" name="filter" id="all" value="2"> No Filter (show all art works)</p>
        		<button class="btn btn-primary" onclick="f1()">Filter</button>
        	<!-- </form>    -->
        	</div>
		</div>
	</div>

 		<div class="container data">
    		<?php echo $autorun; ?>
    	</div>
  
 	<script>
	$("input[name=filter]").change(function(){
		var filter= $("input[name=filter]:checked").val();
		if(filter=="0"){
			$("#Description").addClass("hidden");
        	$("#Title").removeClass("hidden");
        	$("#Description").val("");
		}
		else if(filter=="1"){
			$("#Description").removeClass("hidden");
        	$("#Title").addClass("hidden");
        	$("#Title").val("");
		}
		else if(filter=="2"){
			$("#Description").addClass("hidden");
        	$("#Title").addClass("hidden");
        	$("#Description").val("");
        	$("#Title").val("");
		}
	});
	function f1(){
		var urlFilter="";
		var filter= $("input[name=filter]:checked").val();
		if(filter=="0"){
			if($('#Title').val()!=""){
				urlFilter="Filter.php?filter=0&text="+$('#Title').val();
				filterajax(urlFilter);
			}
		}
		else if(filter=="1"){
			if($('#Description').val()!=""){
				urlFilter="Filter.php?filter=1&text="+$('#Description').val();
				filterajax(urlFilter);
			}
		}
		else if(filter=="2"){
			urlFilter="Filter.php?filter=2&text=abc";
			filterajax(urlFilter);
		}else{
			return false;
		}
		
	}
	function filterajax(url)
	{
		$.get(url, function( data ) {
  			$( ".data" ).html( data );
  			//alert( "Load was performed." );
		});
	}
</script>
</body>
</html>
