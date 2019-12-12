<!--  
    Student Name : Kadam, Ruchir Ravindra
    Project Name: PHP Scripting with Relational Database
    Project No.: Programming Assignment 5
    Due Date: 30th November 2016
-->
<html>
<head>
  <title>Cheapbooks</title>
  <link href="<?php echo explode("index.php", site_url())[0].'assets/css/bootstrap.css';?>" rel="stylesheet">


  <link href="<?php echo explode("index.php", site_url())[0].'assets/css/style.css';?>" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo explode("index.php", site_url())[0].'assets/js/jquery.js';?>"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo explode("index.php", site_url())[0].'assets/js/bootstrap.min.js';?>"></script>
</head>
<body>
<?php $basketId= $this->session->user_session['basketId'];?>
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="mynav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php site_url()?>">CheapBooks</a>
    </div>
  
    <div class="nav navbar-nav navbar-right">
    <div class="navbar-form navbar-right" >
      <button onclick='window.location = "page3";' class="btn btn-primary" aria-label="Left Align"><center><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Shopping Cart(<span id= "count"></span>)</center></button>
      <button onclick="logout()" class="btn btn-primary" aria-label="Left Align"><center><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log out</center></button>
    </div>
    </div>
  </div>
  </nav>
  <div class="row">
    <div class="container">
      <input type="text" class="form-control" placeholder="search" name="query" autofocus><br>
      <center>
      <button class="btn btn-lg btn-primary" onclick="search(1)">Search by Author</button>
      <button class="btn btn-lg btn-success" onclick="search(2)">Search by Book Title</button>
      </center>
    </div>
  </div>
  <div class="container data"></div>
<script type="text/javascript">
  $(document).ready(function(){
    var basketId = "<?php echo $basketId ?>";
    $.post("<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/shoppingCount';?>",{basketId : basketId}, function(data){
      $("#count").html(data);
    });
  });

  function search(n){
    var btn= n;
    var text= $("input[name=query]").val();
    if(text == null || text == ''){
      alert( "Search box empty!" );
      return false;
    }
    var url= "<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/Search';?>";
    $.post(url,{btn:btn,text:text}, function( data )
    {
      $( ".data" ).html( data );
    });
  }

  function addCart(isbn,total){
    var total = parseInt(total);
    var qty = parseInt($("#"+isbn).val());
    var url= "<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/addToCart';?>";
    if (qty <= total) {
      $.post(url,{isbn: isbn, qty: qty},function(result){
        $('#count').html(result);
        $("#"+isbn).val("");
        alert("Successfully added!");
      });
    }else{
      alert("Quantity exceeded!");
    }
  }

  function logout(){
    var url= "<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/logout';?>";
    $.post(url,{}, function( data )
    {
      window.location = "<?php echo explode("index.php", site_url())[0]?>";
    });
  }
</script>
</body>
</html>
