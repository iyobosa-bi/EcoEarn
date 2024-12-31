<?php

require_once "Db.php";

class Payment extends Db{

            private $dbconn;

            function __construct(){
                $this->dbconn =  $this->connect();
            }

            public function getpricingfromwastecategory($catname){

                $sql ="SELECT * FROM waste_cat where cat_id=? ";
                $stmt=$this->dbconn->prepare($sql);
                $stmt -> execute([$catname]);
                $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $records;
            }

            public function record_payment($ref,$userid,$amt,$reportid,$agentid){
                $sql = "INSERT INTO payment SET ref_no=?,pay_user_id=?,pay_amount=?,pay_report_id=?,pay_agent_id=?";
                $stmt = $this->dbconn->prepare($sql);
                $stmt->execute([$ref,$userid,$amt,$reportid,$agentid]);
                return true;
        }

        public function get_payment_by_ref($ref){
            $sql =  "SELECT * FROM payment JOIN agent ON payment.pay_agent_id=agent.agent_id WHERE ref_no=?";
            $stmt =$this->dbconn->prepare($sql);
            $stmt->execute([$ref]);
            $record=$stmt->fetch(PDO::FETCH_ASSOC);
            return $record;
        }

       public function paystack_initialize_step_one($amt,$email,$reference){

                //step1:generate the data to be sent as an array;
                $postRequest = array("amount" =>$amt*100,"email"=>$email,"reference"=>$reference, "callback_url"=>"http://localhost/pages/paystackredirect.php");

                //step2:set the header array

                $headers = ["Authorization:Bearer sk_test_b0f52a81905d44962e8423996060cde0399271d8","content-Type:application/json"];
                $url ="https://api.paystack.co/transaction/initialize";
                //step3:Initialize call.

                    $curlobj = curl_init($url);
                    curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
                    curl_setopt($curlobj,CURLOPT_HTTPHEADER,$headers);
                    curl_setopt($curlobj,CURLOPT_SSL_VERIFYPEER,false);
                    curl_setopt($curlobj,CURLOPT_CUSTOMREQUEST,'POST');
                    curl_setopt($curlobj,CURLOPT_POSTFIELDS,json_encode($postRequest));

                    $apirsp = curl_exec($curlobj);
                    if($apirsp){
                            curl_close($curlobj);
                            return json_decode($apirsp);
                    }
                    else{
                        $r = curl_error($curlobj);
                        return $r;

                    }

        }

        public function paystack_verify_step_two($reference){
            $headers = ["Authorization:Bearer sk_test_b0f52a81905d44962e8423996060cde0399271d8","content-Type:application/json"];
            $url ="https://api.paystack.co/transaction/verify/$reference";
            //step3:Initialize call.
    

                $curlobj = curl_init($url);
                curl_setopt($curlobj,CURLOPT_RETURNTRANSFER,true);
                curl_setopt($curlobj,CURLOPT_HTTPHEADER,$headers);
                curl_setopt($curlobj,CURLOPT_SSL_VERIFYPEER,false);
                $apirsp = curl_exec($curlobj);
                if($apirsp){
    
                    curl_close($curlobj);
                    return json_decode($apirsp);
                }
                else{
                    return false;
                }
    
           }
    
           public function update_payment($status,$ref,$reportid,$agentid){
    
            if($status){
                $payment_status ="success";
                $verified="verified";
            }
            else{
                $payment_status="failed";
                $verified="unverified";
            }
    
            $sql="UPDATE payment SET pay_status=? WHERE ref_no=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$payment_status,$ref]);

            $sql="UPDATE reports_waste JOIN payment on reports_waste.report_id = payment.pay_report_id SET verified_status=? WHERE ref_no=? AND pay_status='success' AND reports_waste.report_id=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$verified,$ref,$reportid]);


            $sql="INSERT INTO collected_waste set report_id=?,agent_id=? ";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$reportid,$agentid]);
            $res=$this->dbconn->lastInsertId();
            return $res;
           }

           public function updatepaymenttableu($status,$amt,$refno,$id){

            $sql="UPDATE payment SET user_paid=?,user_paid_amount=?,userpaid_refno=? WHERE pay_report_id=? AND pay_status=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$status,$amt,$refno,$id,'success']);
            return true;
           }


           public function selectuserpaid($id){

            $sql="SELECT user_paid from payment where pay_report_id=? and pay_status=?";
            $stmt=$this->dbconn->prepare($sql);
            $stmt->execute([$id,'success']);
            $record=$stmt->fetch(PDO::FETCH_ASSOC);
            return $record;

        }



    }


// $p= new Payment;
// $recs=$p->get_payment_by_ref('17344901751496151277');
// echo "<pre>";
// print_r($recs);
// echo "</pre>";


//  $p= new Payment;
// $recs=$p->updatepaymenttableu('yes',"1000","22345647","4",'success');
// echo "<pre>";
// print_r($recs);
// echo "</pre>";

//  $p= new Payment;
// $recs=$p->selectuserpaid("4");
// echo "<pre>";
// print_r($recs);
// echo "</pre>";


?>