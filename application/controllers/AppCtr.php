<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AppCtr extends CI_Controller {
    
    function AppCtr()
    {
	parent::__construct();
	$this->load->model('AppMod');
    }
    
    public function index()
    {
	//$this->load->view('header');
	echo "welcome";
    }
    
    public function signUp(){
	$result=$this->AppMod->signup();
	if($result==true){
	    $status['status']='Registered successfully!';
	    echo json_encode($status);
	}else{
	    $status['status']='The email id you have given already exists';
	    echo json_encode($status);
	}
    }
    
    public function authenticate(){
	$email=$_POST['email'];
        $password=$_POST['password'];
        $sql="SELECT count(email) id FROM users WHERE email='$email' AND password='$password'";
	$result = $this->db->query($sql, $return_object = TRUE)->result_array(); 
        if($result[0]['count(email)']==0){
	    $status['status']='You dont have access to this page';
	    echo json_encode($status);
	    exit;
	}else{
	    $id['id']=$result[0]['id'];
	    echo json_encode($id);
	}
    }
    
    public function insertLocation(){
	$this->authenticate();
	$result=$this->AppMod->insertLocation();
	$status['status']='Record created successfully';
	echo json_encode($status);
    }
    
}
