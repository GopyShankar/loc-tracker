<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   
   ?>
<style>
    .done-true {
      text-decoration: line-through;
      color: grey;
    }
</style>
<script>
    function fetchPrint(){
	$.ajax({
	    type:"POST",
	    url:"<?php echo base_url('appCtr/printTemplate') ?>",
	    success: function (result){
		//$('#previewiframe').html(result);
	    }
	});
    }
    var app = angular.module("todoApp" , []);
    app.controller("TodoListController" , function(){
	var todoList = this;
	console.log(todoList);
	todoList.todos = [{text:"learn angular",done:true},{text:"switch the company",done:false}];
	todoList.addTodo = function(){
	    todoList.todos.push({text:todoList.todoText, done:false});
	    todoList.todoText = '';
	};
	todoList.remaining = function(){
	    var count = 0;
	    angular.forEach(todoList.todos, function(todo){
		console.log(todo.done);
		count += todo.done ? 0 : 1;
		console.log(count);
	    });
	    return count;
	};
	todoList.archive = function() {
	    var oldTodos = todoList.todos;
	    todoList.todos = [];
	    angular.forEach(oldTodos, function(todo) {
	      if (!todo.done) todoList.todos.push(todo);
	    });
	};
    });
</script>
<div class="container">
    <input class="btn btn-success" type="button" value="print" data-target="#printPreview" data-toggle="modal">
    <div ng-app="todoApp">
	<h2>Todo</h2>
	<div ng-controller="TodoListController as todoList">
	    <span>{{todoList.remaining()}} of {{todoList.todos.length}} remaining</span>
	    [ <a href="" ng-click="todoList.archive()">archive</a> ]
	    <ul class="unstyled">
		<li ng-repeat="todo in todoList.todos">
		    <label class="checkbox">
			<input type="checkbox" ng-model="todo.done">
			<span class="done-{{todo.done}}">{{todo.text}}</span>
		    </label>
		</li>
	    </ul>
	    <form ng-submit="todoList.addTodo()">
		<input type="text" ng-model="todoList.todoText"  size="30" placeholder="add new todo here">
		<input class="btn-primary" type="submit" value="add">
	    </form>
	</div>
    </div>
    <form action="<?php echo base_url('appCtr/uploadFile') ?>" enctype="multipart/form-data" method="POST" class="">
	<table class="table table-bordered table-responsive nowrap">
	    <thead>
		<tr>
		    <th><center>File Name</center></th>
		    <th><center>File Preview</center></th>
		    <th><center><button data-template="textbox" class="btn btn-add2 btn-sm btn-success glyphicon glyphicon-plus" onclick="addImageRow($(this))" type="button"></button></center></th>
		</tr>
	    </thead>
	    <tbody class="imageUpload">
		<tr class="odd_file">
		    <td>
			<input type="file" name="userfile">
		    </td>
		    <td>
			<img height="30" data-target="#imgPreview" data-toggle="modal" onclick="getSrcForGallery($(this));" alt="Click for Preview" src="https://sedarspine.s3.amazonaws.com/LOGI/1465372973.png" name="imgId[]" class="galleryP" id="blah">
		    </td>
		    <td>
			<input type="submit" value="save">
		    </td>
		</tr>   
	    </tbody>
	</table>
    </form>
    <div class="modal fade" id="printPreview" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
         <div class="modal-content">
            <form  id="category-form" class="smart-form">
               <div class="modal-header" style="border-bottom: 1px solid #e5e5e5; min-height: 16.4286px; padding: 15px;">
                  <b><img alt="" data-id="login-cover-image" src="http://localhost/spine/assets/img/mantis_logo.jpg"></b>
                  <button aria-hidden="true" data-dismiss="modal" class="close" type="button onClick="onClickHandler(this)"><i class="fa  fa-times-circle "></i></button>
                  <div class="col-md-2 pull-right">
                     <div class="btn-group m-r-5 m-b-5 pull-right">
                        <a class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false"><i class="fa fa-gear"></i> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                           <li><a data-toggle="modal" data-target="#getToEmail" id="sendEmail" name="sendEmail"><i class="fa fa-envelope"></i>email</a></li>
                           <li onclick="window.previewiframe.print()"><a name="printNormal"><i class="fa fa-print"></i> print </a></li>
                        </ul>
                     </div>
                  </div>
               </div>
		<div class="model-body">
			<iframe class="responsiveiframe table-responsive" src="<?php echo base_url('appCtr/printTemplate') ?>" width="100%" id="previewiframe" name="previewiframe" height="700px">
			</iframe>
		</div>
            </form>
         </div>
      </div>
    </div>
</div>