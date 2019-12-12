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
                            <li class="active"><a href = "Part03_SingleWork.php?id=394">Single Work (Part 3)</a></li>
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">
                <?php
                    if(isset($_GET['id'])){
                        include "connect.php";
                        $artID = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
                        if($artID == ""){
                            header('Location: Error.php');
                        }else{
                            $Title = "";
                            $ImageFileName = "";
                            $year = "";
                            $descrip = "";
                            $cost = "";
                            $home = "";
                            $sql2 = "SELECT * FROM Artworks WHERE ArtWorkID=".$artID;
                            $result2 = $conn->query($sql2);
                            if ($result2->num_rows > 0) {
                                while($row2 = $result2->fetch_assoc()) {
                                    $ImageFileName = $row2["ImageFileName"];
                                    $Title = $row2["Title"];
                                    $year = $row2["YearOfWork"];
                                    $artID = $row2["ArtWorkID"];
                                    $id = $row2["ArtistID"];
                                    $descrip = $row2["Description"];
                                    $cost = $row2["MSRP"];
                                    $medium = $row2["Medium"];
                                    $width = $row2["Width"];
                                    $height = $row2["Height"];
                                    $home = $row2["OriginalHome"];
                                }
                            } else {
                                header('Location: Error.php');
                            }

                            $lname = "";
                            $sql = "SELECT * FROM Artists WHERE ArtistID=".$id;
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    $fname = $row["FirstName"];
                                    $lname = $row["LastName"];
                                    echo "<h1>".$Title."</h1><h6>By <a href ='Part02_SingleArtist.php?id=".$id."'>".$fname." ".$lname."</a></h6>";      
                                }
                            } else {
                                header('Location: Error.php');
                            }
                            $conn->close();
                        }
                    }
                    ?>   
            <div class="col-md-3 profile">
                <?php
                    echo '<a data-toggle="modal" data-target="#myModal"><img class="img-responsive" src="images/art/works/medium/'.$ImageFileName.'.jpg"/></a>';
                ?>
            </div>
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            
                                <?php
                                    echo "<h4 class='modal-title'>".$Title." (".$year.") By ".$fname." ".$lname."</h4>";
                                ?>
                            
                        </div>
                        <div class="modal-body">
                            <?php
                                echo '<img class="img-responsive" style ="width:100%" src="images/art/works/medium/'.$ImageFileName.'.jpg"/>';
                            ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        
            
            <div class="col-md-6 art-details">
                <?php
                echo "<p>".$descrip."</p><p class= 'cost'><strong>$".number_format($cost, 2)."</strong></p>";
                ?>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-default fav"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Add to Wish List</a>
                    <a href="#" class="btn btn-default fav"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Add to Shopping Cart</a>
                </div>
                <div class="panel panel-default details">
                    <div class="panel-heading">Product Details</div>
                    <table class= "table">
                        <tr>
                            <td><strong>Date:</strong></td>
                            <?php
                                echo "<td>".$year."</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>Medium:</strong></td>
                            <?php
                                echo "<td>".$medium."</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>Dimensions:</strong></td>
                            <?php
                                echo "<td>".$width."cm x ".$height."cm</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>Home:</strong></td>
                            <?php
                                echo "<td>".$home."</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>Genres:</strong></td>
                            <td>
                            <?php include "connect.php";
                                $genre = "";
                                $sql1 = "SELECT * FROM genres WHERE GenreID IN (SELECT GenreID FROM artworkgenres WHERE ArtWorkID =".$artID.")";
                                $result1 = $conn->query($sql1);

                                if ($result1->num_rows > 0) {
                                    while($row1 = $result1->fetch_assoc()) {
                                        $genre = $row1["GenreName"];
                                        echo "<a href='#''>".$genre."</a><br>";      
                                    }
                                } else {
                                    header('Location: Error.php');
                                }
                                $conn->close();
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Subjects:</strong></td>
                            <td>
                            <?php include "connect.php";
                                $subject = "";
                                $sql3 = "SELECT * FROM Subjects WHERE SubjectID IN (SELECT SubjectID FROM artworksubjects WHERE ArtWorkID =".$artID.")";
                                $result3 = $conn->query($sql3);

                                if ($result3->num_rows > 0) {
                                    while($row3 = $result3->fetch_assoc()) {
                                        $subject = $row3["SubjectName"];
                                        echo "<a href='#''>".$subject."</a><br>";      
                                    }
                                } else {
                                    header('Location: Error.php');
                                }
                                $conn->close();
                            ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <div class="panel panel-info">
                    <div class="panel-heading">Sales</div>
                    <div class = "panel-body">
                    <?php include "connect.php";
                        $date = "";
                        $sql4 = "SELECT * FROM Orders WHERE OrderID IN (SELECT OrderID FROM orderdetails WHERE ArtWorkID =".$artID.")";
                        $result4 = $conn->query($sql4);

                        if ($result4->num_rows > 0) {
                            while($row4 = $result4->fetch_assoc()) {
                                $date = strtotime($row4["DateCreated"]);
                                $newdate= date('n/d/Y', $date);
                                echo "<a href='#''>".$newdate."</a><br>";      
                            }
                        } else {
                            header('Location: Error.php');
                        }
                        $conn->close();

                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
