<?php
if(isset($_GET['text']) && isset($_GET['filter'])){
    include 'connect.php';
    $text= filter_input(INPUT_GET,"text",FILTER_SANITIZE_STRING);
    $filter= filter_input(INPUT_GET,"filter",FILTER_SANITIZE_NUMBER_INT);
    $str = "";
    if($filter == 0){
     $sql = "SELECT * FROM Artworks WHERE Title LIKE '%".$text."%'";
 }elseif($filter == 1) {
     $sql = "SELECT * FROM Artworks WHERE Description LIKE '%".$text."%'";
 }elseif($filter == 2){
    $sql = "SELECT * FROM Artworks";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $title= $row['Title'];
        $artID= $row['ArtWorkID'];
        $description= $row['Description'];
        $ImageFileName= $row['ImageFileName'];
        if($filter == 1) {
            $str = str_ireplace($text, "<mark>$text</mark>", $description);
        }else{
            $str = $description;
        }
        echo '<div class= "row" style="margin-left:0px">
        <div class= "col-md-2" style="padding-left:0px"><img class="img-responsive" style="width:100%;" src="images/art/works/square-medium/'.$ImageFileName.'.jpg"/></div>
        <div class="col-md-10">
            <h3 style="margin-top:0px"><a href="Part03_SingleWork.php?id='.$artID.'">'.$title.'</a></h3>
            <p>'.$str.'</p>
        </div>
    </div>';      
}
} else {
    echo '<div class="container"><center>
            <h2>No results found!</h2></center>
        </div>';
}
$conn->close();
}

?> 
