<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class appMod extends CI_Model {
    
    public function signup(){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $phone=$_POST['phone'];
        $sql="SELECT count(email) FROM users WHERE email='$email'";
        $result = $this->db->query($sql, $return_object = TRUE)->result_array();
        if($result[0]['count(email)']!=0){
            return false;
        }
        $sql="INSERT INTO users (name, email, password, phone) VALUES ('$name','$email','$password', '$phone')";
        $this->db->query($sql);
        return true;
    }
    public function insertLocation(){
        $user_id=$_POST['user_id'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $sql="INSERT INTO location (user_id, latitude, longitude) VALUES ('$user_id','$latitude','$longitude')";
        $this->db->query($sql);
        return true;
    }
    
}