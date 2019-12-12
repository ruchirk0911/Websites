
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
                <a class="navbar-brand" href="<?php echo explode("index.php", site_url())[0]?>">CheapBooks</a>
            </div>
        </div>
    </nav>
    <div class="container vertical-center">
    <div class="jumbotron">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 form-horizontal back1">
                <h2>Registration Form</h2>
                <div class="form-group">
                    <label for="username" class="col-sm-3 control-label">Username</label>
                    <div class="col-sm-9">
                        <input type="text" id="username" placeholder="Username" class="form-control" autofocus>
                    </div>
                </div>
                <div class="form-group">
                    <label for="address" class="col-sm-3 control-label">Address</label>
                    <div class="col-sm-9">
                        <input type="text" id="address" placeholder="Address" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" id="email" placeholder="Email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>
                    <div class="col-sm-9">
                        <input type="password" id="password" placeholder="Password" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="phone" class="col-sm-3 control-label">Phone</label>
                    <div class="col-sm-9">
                        <input type="text" id="phone" placeholder="Phone #" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-4 col-sm-offset-3">
                        <button class="btn btn-primary btn-block" onclick="register()">Register</button>
                    </div>
                </div>
        </div> 
    </div>
    </div>
    </div> 
    <script type="text/javascript">
    function register(){
        var username = $("#username").val();
        var address = $("#address").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var phone = $("#phone").val();
        if(username != "" && email !="" && password != ""){
           var url= "<?php echo explode("index.php", site_url())[0].'index.php/MainAppController/register';?>";
            $.post(url,{username: username, address: address, email: email, password: password, phone: phone}, function( data ){
                    alert("Successfully registered!")
                    window.location = "<?php echo explode("index.php", site_url())[0];?>";
            }); 
        }else{
            alert("Please fill in all the information!");
        }
      
    }
    </script>  
</body>
</html>
