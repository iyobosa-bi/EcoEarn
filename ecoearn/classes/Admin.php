<?php

require_once "Db.php";

class Admin extends Db{

            private $dbconn;

            function __construct(){
                $this->dbconn =  $this->connect();
            }

            public function adminlogin($email){

                $sql = "SELECT * FROM admin where admin_email = ? LIMIT 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$email]);
                $recs = $stmt->fetch(PDO::FETCH_ASSOC);
                return $recs;
            }


            public function logout(){

                session_destroy();
            }

            public function insert_waste_category($cat_name,$points,$price){
                $sql = "INSERT INTO waste_cat (cat_name,points_per_kg,price_per_point) VALUES (?,?,?)";
                $stmt =  $this->dbconn->prepare($sql);
                $stmt->execute([$cat_name,$points,$price]);
                $id=$this->dbconn->lastInsertId();
                return $id;
            }


            public function get_category_admin(){
                $sql = "SELECT * FROM waste_cat";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            public function get_category_admin_id($id){
                $sql = "SELECT * FROM waste_cat WHERE cat_id =?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }


            public function get_waste_name(){
                $sql = "SELECT cat_name FROM waste_cat";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }


            public function update_waste_cat($catname,$points,$price,$id){
                $sql = "UPDATE  waste_cat SET cat_name=?,points_per_kg=?,price_per_point=? WHERE cat_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$catname,$points,$price,$id]);
                return true;
            }

            //to select all records from the users table and reports table

            public function reports_made_by_users(){
                $sql = "SELECT * FROM reports_waste  JOIN users on reports_waste.user_id=users.user_id ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;
            }

            public function reports_made_by_id($id){
                $sql = "SELECT * FROM reports_waste JOIN users on reports_waste.user_id=users.user_id WHERE report_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }



            //to get the state name based on values passed.

            public function get_state($id){
                $sql = "SELECT state_name FROM state where state_id=? ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }


            public function updatereportstatus($status,$time,$reportid){
                $sql = "UPDATE  reports_waste SET reports_status=?,approved_time=? WHERE report_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$status,$time,$reportid]);
                return true;
            }



            public function userscount(){
                $sql = "SELECT count(user_id) as userscount FROM users";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }

            public function collcount(){
                $sql = "SELECT count(agent_id) as collcount FROM agent";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;  

            }

            //for user view

            public function getdetailsuser(){

                $sql = "SELECT * FROM users ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }

            public function getdetailscoll(){

                $sql = "SELECT * FROM agent ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }

            

            public function getdetailsuserbyid($id){

                $sql = "SELECT * FROM users where user_id=? ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }

            public function getdetaileduserrecords(){

                $sql = "SELECT * FROM users JOIN reports_waste on users.user_id=reports_waste.user_id";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }

            //reportscount by user

            public function getreportscountperuser($id){

                $sql = "SELECT count(report_id) as count FROM reports_waste where user_id=? ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }


            //user restrict and activate
            public function updateuserstatus($status,$userid){
                $sql = "UPDATE  users SET active_status=? WHERE user_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$status,$userid]);
                return true;
            }

            //get the payment record for each report if it was successful

            public function getsuccessfulpaymentrecords(){

                $sql = "SELECT * FROM payment JOIN reports_waste on payment.pay_report_id=reports_waste.report_id JOIN users on reports_waste.user_id=users.user_id where pay_status='success'";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }

            //get coll name

            public function collname($id){

                $sql = "SELECT * FROM agent where agent_id=? limit 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }

            public function username($id){

                $sql = "SELECT * FROM users where user_id=? limit 1";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }

            //delete waste cat

            public function removewastecat($id){
                $sql = "DELETE  FROM waste_cat where cat_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }

            public function getdetailscollbyid($id){
                $sql = "SELECT * FROM agent where agent_id=? ";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;


            }

            public function updatecollstatus($status,$id){
                $sql = "UPDATE  agent SET active_status=? WHERE agent_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$status,$id]);
                return true;
            }

            //Platform reports

            public function adminplatformreports(){

                $sql = "SELECT count(report_id) as count FROM reports_waste";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }


            public function sucesspaymentscount(){

                $sql = "SELECT sum(pay_amount) as sum FROM payment where pay_status=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute(['success']);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;

            }

            public function getreportsmessage(){
                $sql = "SELECT * FROM reports_message JOIN reports_waste on reports_message.report_id=reports_waste.report_id";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute();
                $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $res;

            }

            public  function getfeedbackcountperuser($id){
                $sql = "SELECT count(id) as count FROM reports_message  where user_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$id]);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }

            //count of  approved reports

            
            public  function getapprovedreports(){
                $sql = "SELECT count(report_id) as count FROM reports_waste  where reports_status=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute(['approved']);
                $res = $stmt->fetch(PDO::FETCH_ASSOC);
                return $res;
            }

}


// $recs = $ad ->getreportscountperuser(15);
// // $recs = $ad-> update_waste_cat("Plastics",4,2,1);

// // $recs = $ad-> get_category_admin();
// // echo "<pre>";
// // print_r($recs);
// echo "</pre>";
// print_r($recs);
// echo "<pre>";
// // 
// echo "</pre>";

// $res =$ad->insert_waste_category("Cans",10,20);
// echo $res;



// $ad = new Admin;
// $recs = $ad->getsuccessfulpaymentrecords();
// echo "<pre>";
// print_r($recs);
// echo "</pre>";



// $ad = new Admin;
// // $recs = $ad->sucesspaymentscount();
// echo "<pre>";
// print_r($recs);
// echo "</pre>";


// $ad = new Admin;
// $recs = $ad->get_category_admin_id('1')['points_per_kg'];
// echo "<pre>";
// print_r($recs);
// echo "</pre>";







?>