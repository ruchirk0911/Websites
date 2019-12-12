
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
                <a class="navbar-brand" href="Default.php">Art Gallery</a>
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
                            <li><a href = "Part04_Search.php">Advanced Search (Part 4)</a></li>
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

    
    <div class="jumbotron">
        <div class="container">
            <h1>Welcome to Art Gallery.</h1>
            <p>This website will help you get information about artworks and artists.</p>
        </div>
    </div>

    <div class="container">
        <div class = "row">
            <div class="col-md-2">
                <h3><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> About us</h3>
                <p>What is this all about and other stuff</p>
                <p>
                    <a href="about.php" class="btn btn-default"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Visit Page</a>
                </p>                    
            </div>

            <div class="col-md-2">
                <h3><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Artist List</h3>
                <p>Displays list of artist names as links</p>
                <p>
                    <a href="Part01_ArtistsDataList.php" class="btn btn-default"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Visit Page</a>
                </p>  
            </div>

            <div class="col-md-2">
                <h3><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Single Artist</h3>
                <p>Displays information for a single artist</p>
                <p>
                    <a href="Part02_SingleArtist.php?id=19" class="btn btn-default"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Visit Page</a>
                </p>
            </div>

            <div class="col-md-2">
                <h3><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Single Work</h3>
                <p>Displays information for a single work</p>
                <p>
                    <a href="Part03_SingleWork.php?id=394" class="btn btn-default"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Visit Page</a>
                </p>    
            </div>

            <div class="col-md-2">
                <h3><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search</h3>
                <p>Performs search on ArtWorks tables</p>
                <p>
                    <a href="Part04_Search.php" class="btn btn-default"><span class="glyphicon glyphicon-link" aria-hidden="true"></span> Visit Page</a>
                </p>
            </div>
        </div>
    </div>
    <!-- /.container -->
</body>
</html>

