<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$user_id=$this->session->userdata('userid');
?>
<html lang="en" >
<head>
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>   -->
  
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  
  <title>Shank Tech</title>
  <style>
    .navbar, .navbar-inverse{
      border-radius: 0px !important;
    }
  </style>
</head>
<body>
<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url('appCtr/checkthelink');?>">Gedar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Go!</button>
            </span>
          </div>
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <div class="jumbotron">
    <div class="row">
      <div class="chatcont" style="height: 350px;overflow-y: scroll;overflow-x: hidden;">

      </div>

      <div class="input-group">
          <input type="text" class="form-control mesg" aria-describedby="basic-addon2" onfocus="updateConvFlag('1-2','N')">
          <span class="input-group-addon btn btn-default" id="basic-addon2" onclick="updateConvFlag('1-2','Y');updateConv('1')">send</span>
        </div>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
checkForNewMessage();
  

});
function checkForNewMessage(){
  $.ajax({
    url:"<?php echo base_url('appCtr/checkForNewMessage');?>",
    type: "POST",
    success:function(result){
      // console.log(result);
      $('.chatcont').html(result);
      // $('body').append("<h1>"+result+"</h1>");
      if(result){
      setTimeout(function(){ checkForNewMessage(); }, 2000);

      }
    }
  });
}
function updateConv(convId){
  $msg=$('.mesg').val();
  $.ajax({
    url:"<?php echo base_url('appCtr/updateConv');?>",
    type: "POST",
    data:{msg:$msg,convId:convId},
    success:function(result){
      console.log(result);
      $('#chatHistory').append('<div class="col-md-12"><button type="button" class="btn btn-default pull-right">'+$msg+'</button></div>');
      // $('body').append("<h1>"+result+"</h1>");
      setTimeout(function(){ checkForNewMessage(); }, 2000);
    }
  });
}
function updateConvFlag(convn_btwn,flag){
  $msg=$('.mesg').val();
  $.ajax({
    url:"<?php echo base_url('appCtr/updateConvFlag');?>",
    type: "POST",
    data:{convn_btwn:convn_btwn,flag:flag},
    success:function(result){
      console.log(result);
      // $('body').append("<h1>"+result+"</h1>");

    }
  });
}

</script>