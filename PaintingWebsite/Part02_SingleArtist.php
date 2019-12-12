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
                            <li class="active"><a href = "Part02_SingleArtist.php?id=19">Single Artist (Part2)</a></li>
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

    <!-- Page Content -->
    <div class="container">

        <div class="row">
            <?php include "connect.php";
            $id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
            if($id == ""){
                header('Location: Error.php');
            }else{
                $details = "";
                $birth = "";
                $death = "";
                $nationality = "";
                $alink = "";
                $fname = "";
                $lname = "";
                $sql = "SELECT * FROM Artists WHERE ArtistID=".$id;
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $fname = $row["FirstName"];
                        $lname = $row["LastName"];
                        $details = $row["Details"];
                        $birth = $row["YearOfBirth"];
                        $death = $row["YearOfDeath"];
                        $nationality = $row["Nationality"];
                        $alink = $row["ArtistLink"];
                        echo "<h1>".$fname. " " .$lname."</h1>";      
                    }
                } else {
                    header('Location: Error.php');
                }
                $conn->close();
            }
            ?>  

            <div class="col-md-3 profile">
                <?php
                echo '<img class="img-responsive" src="images/art/artists/medium/'.$id.'.jpg"/>';
                ?>
            </div>

            
            <div class="col-md-5">
                <?php
                echo "<p>".$details."</p>"
                ?>
                <a href="#" class="btn btn-default fav"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Add to Favorites List</a>
                <div class="panel panel-default details">
                    <!-- Default panel contents -->
                    <div class="panel-heading">Artist Details</div>
                    <table class= "table">
                        <tr>
                            <td><strong>Date:</strong></td>
                            <?php
                            echo "<td>".$birth." - ".$death."</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>Nationality:</strong></td>
                            <?php
                            echo "<td>".$nationality."</td>"
                            ?>
                        </tr>
                        <tr>
                            <td><strong>More Info:</strong></td>
                            <?php
                            echo "<td><a href= '".$alink."'>".$alink."</a></td>"
                            ?>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div class="row">
            <h3><?php echo "Art by ".$fname. " " . $lname; ?></h3>
            <?php include "connect.php";
            $Title = "";
            $ImageFileName = "";
            $year = "";
            $artID = "";
            $sql1 = "SELECT * FROM Artworks WHERE ArtistID=".$id;
            $result1 = $conn->query($sql1);

            if ($result1->num_rows > 0) {
                while($row1 = $result1->fetch_assoc()) {
                    $ImageFileName = $row1["ImageFileName"];
                    $Title = $row1["Title"];
                    $year = $row1["YearOfWork"];
                    $artID = $row1["ArtWorkID"];
                    echo '<div class="col-md-3 artwork">
                    <div class="thumbnail">
                        <img class="art-img" src="images/art/works/square-medium/'.$ImageFileName.'.jpg"/>
                        <div>
                            <p style="padding-top:5px; padding-bottom:5px; height:37px"><a href= "Part03_SingleWork.php?id='.$artID.'">'.$Title.', '.$year.'</a></p>
                            <p>
                                <a href="Part03_SingleWork.php?id='.$artID.'" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> View</a> <a href="#" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> Wish</a> <a href="#" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Cart</a>
                            </p>
                        </div>
                    </div>
                </div>'
                ;
            }
        } else {
            header('Location: Error.php');
        }
        $conn->close();
        ?>
    </div>
</div>
</body>
</html>
