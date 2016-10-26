<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appCtr extends CI_Controller {
    
    function appCtr()
    {
	parent::__construct();
	$this->load->model('appMod');
    }
    
    public function index()
    {
	$this->load->view('header');
    }
    
    public function signUp(){
	$result=$this->appMod->signup();
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
	$result=$this->appMod->insertLocation();
	$status['status']='Record created successfully';
	echo json_encode($status);
    }
    public function Ai(){
    	$data['result']['question']='';
    	$data['result']['answer']='';
    	if(isset($_POST['save'])){
    		$question=$_POST['question'];
    		$questionStack=explode(" ",$question);
    		$a=array('what','where','how','when','why','which','who','');
    		$a1=array('is','the','of','does','');
    		$b=array('he','she','it','they','');
    		$workArray=array('do','work','occupation', 'doing', 'place');
    		$questionStack=array_diff($questionStack,$a1);
    		print_r($questionStack);echo ":questionStack <br> ";
    		$qType=array_values(array_intersect($a,$questionStack));
    		print_r($qType);echo ":qType <br> ";
    		$workDetail=array_values(array_intersect($workArray,$questionStack));
    		print_r($workDetail);echo "workDetail<br> ";
    		$toGetName=array_values(array_merge($qType,$workDetail));
    		print_r($toGetName);echo " toGetName<br>";
    		$name=array_values(array_diff($questionStack,$toGetName));
    		print_r($name);echo "name<br> ";
    		echo $name=reset( $name);
    		if($workDetail && $qType[0]=='what' &&  $qType[0]!='place' ){
    			$sql="SELECT occupation FROM users WHERE name='$name'";
            	$result = $this->db->query($sql, $return_object = TRUE)->result_array();
            	print_r($result);
            	if(empty($result) && $_POST['answer']!=''){

            	}
            	$data['result']['answer']=$result[0]['occupation'];
    		}else if($workDetail && ($qType[0]=='where' || $qType[0]=='which' )){
    			$sql="SELECT place FROM users WHERE name='$name'";
            	$result = $this->db->query($sql, $return_object = TRUE)->result_array();
            	$data['result']['answer']=$result[0]['place'];
    		}
    		else{
    			$data['result']['answer']='false';
    		}
        $data['result']['question']=$question;
    	}
    	$this->load->view('Ai',$data);
    }
    
}
