<?php

require_once "Db.php";

class User extends Db{

            private $dbconn;

            function __construct(){
                $this->dbconn =  $this->connect();
            }

            public function userregister($firstname,$lastname,$email,$pass,$phone,$stateid,$lgaid){

                $hash = password_hash($pass,PASSWORD_DEFAULT);
                $fullname = $firstname." ".$lastname;
                $sql = "INSERT INTO users SET user_name=?,email=?,password=?,phone_number=?,state_id=?,lga_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$fullname,$email,$hash,$phone,$stateid,$lgaid]);
                $id = $this->dbconn->lastInsertId();
                return $id;
            }

            public function colregister($firstname,$lastname,$email,$pass,$phone){

                $hash = password_hash($pass,PASSWORD_DEFAULT);
                $fullname = $firstname." ".$lastname;
                $sql = "INSERT INTO agent SET first_name=?,email_address=?,phone=?,password=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$fullname,$email,$phone,$hash]);
                $id = $this->dbconn->lastInsertId();
                return $id;
            }

            public function fetchAllStates(){
                $sql = "SELECT * FROM state";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute();
                $states =  $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $states;
    
        }
        public  function fetch_lg($state_id){
                $sql = "SELECT*FROM lga WHERE state_id = ?";
                $stmt = $this->connect()->prepare($sql);
                $stmt->execute([$state_id]);
                $lgs =  $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $lgs;
        }

        //for normal user login
        public function login($email,$password){

                $sql ="SELECT * FROM users WHERE email=? LIMIT 1";
                $stmt=$this->dbconn->prepare($sql);
                $stmt -> execute([$email]);
                $records = $stmt->fetch(PDO::FETCH_ASSOC);
                // return  $records;
                // exit();


                if($records){
                $nothashed = $records['password'];
                $check = password_verify($password,$nothashed);
               
    
                    if($check || $password==$nothashed){
                        echo "password match";
                        
                        
                        //password is correct
                        $uprecords=[];
                        array_push($uprecords, $records['user_id'], $records['active_status']);
                        return $uprecords;
                    }
                    else{
                     echo "password  do not match";
                        return false;
                    }}
                else{
                    return false;
                }
        }


        public function collectorlogin($email,$password){
            $sql ="SELECT * FROM agent WHERE email_address=? LIMIT 1";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$email]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            // return $records;
            // print_r($records);

            if($records){
            $nothashed = $records['password'];
            $check = password_verify($password,$nothashed);

                if($check){
                    $colluprecords=[];
                    array_push($colluprecords, $records['agent_id'], $records['active_status']);
                    return $colluprecords;
                }
                else{
                    return false;
                }}
            else{
                return false;
            }
    }

    //fetch all records user table based  on session id

            public function userall($id){
                $sql ="SELECT * FROM users WHERE user_id=? LIMIT 1";
                $stmt=$this->dbconn->prepare($sql);
                $stmt -> execute([$id]);
                $records = $stmt->fetch(PDO::FETCH_ASSOC);
                return $records;

            }

    //logout   from  a session

    public function logout(){

        session_destroy();
    }


        public function report_waste($id,$add,$wastetype,$wasteimg,$wasteamt,$statid,$lgaid,$catid,$reportref,$pointsearned,$pointsperkg){


            // $report_ref= $wastetype.time().rand();
            $sql="INSERT INTO reports_waste SET user_id=?,pickup_address=?,waste_type=?,waste_image=?,waste_amount=?,report_state_id=?,report_lga_id=?,cat_id=?,report_ref=?,points_earned=?,pointsperkg_earned=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$id,$add,$wastetype,$wasteimg,$wasteamt,$statid,$lgaid,$catid,$reportref,$pointsearned,$pointsperkg]);
            $res=$this->dbconn->lastInsertId();
            return $res;

        }


        public function  get_user_reports_count($id){

            $sql ="SELECT count(distinct report_id) as wastecount FROM reports_waste WHERE user_id=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$id]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;

        }

        public function get_user_reports($id){
            $sql ="SELECT * FROM reports_waste WHERE user_id=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$id]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }
        

        public function get_email_exists(){
            $sql ="SELECT email FROM users";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        }

        public function check_email($email){

            $sql =  "SELECT * FROM users WHERE email=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$email]);
            $numofmail = $stmt->rowCount();

            if($numofmail >0){
                return true;
            }else{
                return false;
            }
        }

        public function update_userprofile($fullname,$useremail,$userphone,$userpass,$bankname,$accountno,$nearest,$bc,$id){
            $sql = "UPDATE users SET user_name=?,email=?,phone_number=?,password=?,Bank_Name=?,account_no2=?,nearest_pickup=?,Bank_code=? WHERE user_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$fullname,$useremail,$userphone,$userpass,$bankname,$accountno,$nearest,$bc,$id]);
            return true;
        }

        //count of approved reports.

        public function approvedreports($id){
            $sql ="SELECT count(report_id) as count FROM reports_waste where user_id=? and reports_status=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$id,'approved']);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }

        public function useramountpayment($id){
            $sql ="SELECT sum(user_paid_amount) as sum FROM payment where pay_user_id=? and user_paid=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$id,'yes']);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }



        public function  getpointsearnedaftercollectorspayment($userid){
            $sql ="SELECT sum(pointsperkg_earned) as sum FROM reports_waste join payment on reports_waste.report_id=payment.pay_report_id where pay_status=? and user_id=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute(['success',$userid]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }


       public function getuserpaymenthist($userid){

        $sql ="SELECT * FROM reports_waste join payment on reports_waste.report_id=payment.pay_report_id where pay_status=? and user_id=? ";
        $stmt=$this->dbconn->prepare($sql);
        $stmt -> execute(['success',$userid]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;


       }
}




// $u=new User;
// $recs=$u->useramountpayment(16);
// echo"<pre>";
// print_r($recs);
// echo"</pre>";




// $u=new User;
// $recs=$u->getpointsearnedaftercollectorspayment('16');
// echo"<pre>";
// print_r($recs);
// echo"</pre>";














?>