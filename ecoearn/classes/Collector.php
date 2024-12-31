<?php

require_once "Db.php";

class Collector extends Db{

            private $dbconn;

            function __construct(){
                $this->dbconn =  $this->connect();
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
        public function fetchAllStatesById($id){
            $sql = "SELECT * FROM state where state_id=? LIMIT 1";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id]);
            $states =  $stmt->fetch(PDO::FETCH_ASSOC);
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


                if($records){
                $nothashed = $records['password'];
                $check = password_verify($password,$hashed);
    
                    if($password == $nothashed){
                        //password is correct
                        return $records['user_id'];
                    }
                    else{
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
            $check = password_verify($password,$hashed);

                if($password == $nothashed){
                    //password is correct
                    return $records['agent_id'];
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


        public function report_waste($id,$add,$wastetype,$wasteimg,$wasteamt,$statid,$lgaid,$catid){


            $report_ref= $wastetype.time().rand();
            $sql="INSERT INTO reports_waste SET user_id=?,pickup_address=?,waste_type=?,waste_image=?,waste_amount=?,state_id=?,lga_id=?,cat_id=?,report_ref=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$id,$add,$wastetype,$wasteimg,$wasteamt,$statid,$lgaid,$catid,$report_ref]);
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


        public function collectorall($id){


            $sql ="SELECT * FROM agent WHERE agent_id=? LIMIT 1";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$id]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }

        //to  execute a search  query based on the waste cateory selected

        public function search_by_waste_cat($wastecat){
            $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and waste_type  LIKE ?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute(["%".$wastecat."%"]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        }

        public function search_by_state($stateid){
            $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and reports_waste.report_state_id=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$stateid]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }

        public function search_by_weight($kg){
            $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and reports_waste.waste_amount>=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$kg]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }

        public function searchbystateandcategory($stateid,$wastecat){
            $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and reports_waste.report_state_id=? and waste_type=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$stateid,$wastecat]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;
        }

       public function searchbycategoryandweight($wastecat,$kg){
        $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and waste_amount>=? and waste_type=?";
        $stmt=$this->dbconn->prepare($sql);
        $stmt -> execute([$kg,$wastecat]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
       }

       public function searchbystateandweight($state,$kg){
        $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and reports_waste.report_state_id=? and waste_amount>=? ";
        $stmt=$this->dbconn->prepare($sql);
        $stmt -> execute([$state,$kg]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
       }

       public function searchbyallmetrics($wastecat,$kg,$stateid){
        $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where reports_status='approved' and waste_type=? and waste_amount>=? and reports_waste.report_state_id=? ";
        $stmt=$this->dbconn->prepare($sql);
        $stmt->execute([$wastecat,$kg,$stateid]);
        $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $records;
       }


       //end  of search query

        public function reportswastebyreportid($reportid){
            $sql ="SELECT * FROM reports_waste JOIN users ON reports_waste.user_id = users.user_id where report_id=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt -> execute([$reportid]);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        }

        public function complaintsbycollector($reportid,$reason,$message,$agentid,$userid){
            $sql="INSERT INTO reports_message SET report_id=?,reason=?,message=?,agent_id=?,user_id=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$reportid,$reason,$message,$agentid,$userid]);
            $res=$this->dbconn->lastInsertId();
            return $res;
        }

        public function update_collprofile($fullname,$collemail,$collphone,$collpass,$id){
            $sql = "UPDATE agent SET first_name=?,email_address=?,phone=?,password=? WHERE agent_id=?";
            $stmt = $this->dbconn->prepare($sql);
            $stmt->execute([$fullname,$collemail,$collphone,$collpass,$id]);
            return true;
        
        }

       public function check_email($email){

        $sql =  "SELECT * FROM agent WHERE email_address=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $numofmail = $stmt->rowCount();

        if($numofmail >0){
            return true;
        }else{
            return false;
        }

       }

       
       public function getcollemail($id){
        $sql =  "SELECT email_address FROM agent WHERE agent_id=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$id]);
        $records = $stmt->fetch(PDO::FETCH_ASSOC);
        return $records;
        
    }


        public function getcollhist($id){
            $sql =  "SELECT * FROM agent JOIN payment ON agent.agent_id=payment.pay_agent_id JOIN reports_waste ON payment.pay_report_id=reports_waste.report_id where payment.pay_agent_id =? and pay_status=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$id,'success']);
            $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $records;

        }


        public function getcollstatusdate($reportid){
            $sql =  "SELECT * FROM collected_waste  where report_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$reportid]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;

        }


        public function getpresentcolstatus($repid){
            $sql =  "SELECT status FROM collected_waste  where report_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$repid]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;

        }

        public function updatecollectionstatus($collstatus,$time,$repid){

            $sql =  "UPDATE collected_waste SET status=?,collection_date=? where report_id=?";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$collstatus,$time,$repid]);
            $records = $stmt->fetch(PDO::FETCH_ASSOC);
            return $records;
        }


        public function getcollectedwastecount($agentid){

                $sql="SELECT count(collected_id) as count FROM collected_waste where agent_id=? and status=?";
                $stmt=$this->connect()->prepare($sql);
                $stmt->execute([$agentid,'yes']);
                $count=$stmt->fetch(PDO::FETCH_ASSOC);
                return $count;

        }

        }


        


// $u=new User;
// $recs=$u->collectorlogin("collectorp@g.co","cp1234");
// print_r($recs);



// $c=new Collector;
// $recs=$c->getcollemail(1);
// echo "<pre>";
// print_r($recs);
// echo "</pre>";


//  $c=new Collector;
//  $recs=$c->searchbycategoryandweight("Plastics","");
//  echo "<pre>";
//  print_r($recs);
// echo "</pre>";

//  $c=new Collector;
//  $recs=$c->getcollectedwastecount('4','yes');
//  echo "<pre>";
//  print_r($recs);
// echo "</pre>";


?>
