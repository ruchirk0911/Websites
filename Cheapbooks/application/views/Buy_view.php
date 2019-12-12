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
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="mynav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo explode("index.php", site_url())[0].'index.php/page2'?>">CheapBooks</a>
    </div>
  
    <div class="nav navbar-nav navbar-right">
    <div class="navbar-form navbar-right" >

      <button onclick="logout()" class="btn btn-primary" aria-label="Left Align"><center><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log out</center></button>
    </div>
    </div>
  </div>
  </nav>
<div class= "container data"></div>
<script type="text/javascript">
  $(document).ready(function(){
      var url= "<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/buy';?>";
      $.post(url,{}, function( data )
      {
        $( ".data" ).html( "<h3><center>Thankyou for Shopping with us.</center></h3>" );
      });
    });
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