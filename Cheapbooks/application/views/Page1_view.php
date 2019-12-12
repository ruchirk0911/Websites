<!--  
    Student Name : Kadam, Ruchir Ravindra
    Project Name: PHP Scripting with Relational Database
    Project No.: Programming Assignment 5
    Due Date: 30th November 2016
-->
<html>
<head>
  <title>Cheapbooks</title>
  <link href="<?php echo base_url().'assets/css/bootstrap.css';?>" rel="stylesheet">


  <link href="<?php echo base_url().'assets/css/style.css';?>" rel="stylesheet">
  <!-- jQuery -->
  <script src="<?php echo base_url().'assets/js/jquery.js';?>"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="<?php echo base_url().'assets/js/bootstrap.min.js';?>"></script>
</head>
<body>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="mynav">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="">CheapBooks</a>
    </div>
  </div>
</nav>
<div class="container vertical-center">
  <div class="jumbotron">
    <div class="row">
      <div class="col-sm-6 col-md-4 col-md-offset-4 form-horizontal back1">
        <!-- <form class="form-horizontal" role="form" method="POST"> -->
          <h2 style="margin-left: 100px;">Login to Cheapbooks</h2>
          <label> Username:</label><br>
          <input type="text" class="form-control" id="username" placeholder="Username" required autofocus><br>
          <label> Password:</label><br>
          <input type="password" class="form-control" id= "password" placeholder="Password" required><br>
          <button class="btn btn-lg btn-primary btn-block" id="btnLogin" type="submit">Sign in</button><br>
          <hr/>
          <label>Don't have account?</label>
          <a class="btn btn-lg btn-success btn-block" onclick="window.location='index.php/page4'">Register</a><br>
        <!-- </form> -->
      </div> 
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $("#btnLogin").click(function() {
          var username = $("#username").val();
          var password = $("#password").val();
          $.post('<?php echo site_url('MainAppController/login')?>',{username: username, password:password}, function(data){
            if(data){
              window.location = "index.php/page2";
            }else{
              $("#username").val("");
              $("#password").val("");
              alert("Invalid Username or password.");
            }
          });
        });
  });
</script>   
</body>
</html>
