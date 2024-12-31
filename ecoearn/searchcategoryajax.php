<?php

require_once  "classes/Collector.php";
require_once "classes/Admin.php";
$c=new Collector;

$wastecat= isset($_GET['wastecat'])?$_GET['wastecat']:'';
$stateid = isset($_GET['stateid'])?$_GET['stateid']:'';
$kg = isset($_GET['kg'])?$_GET['kg']:'';

// echo $wastecat;
// echo $stateid;
// echo $kg;
//  exit();

$approvewaste=$c->search_by_waste_cat($wastecat);
$aprrovedbystate=$c->search_by_state($stateid);
$approvedbyweight=$c->search_by_weight($kg);


//$getstate=$c->fetchAllStatesById();

//searchbywastecat


if(empty($approvewaste)){
    if(count($aprrovedbystate)>0){

        $num = count($aprrovedbystate);
        echo "<p class='alert alert-success col-md-9'><b>$num</b> search result(s) available/found</p>";
    
       echo '<div class="row d-flex align-items-center mt-3">';
        foreach($aprrovedbystate as $val){
        echo'
      
        <div class="col-md-4 mb-2">
                <div class="card shadow-sm">
                    <img src="uploads/' . ($val["waste_image"]) . '" class="img-fluid" alt="Waste Image">
                    <div class="card-body">
                        <span style="white-space: nowrap; font-size:11px;">
                            Report by @ ' .($val["user_name"]) . '
                        </span>
                        <h3 style="font-size:15px; font-weight:600;">
                            ' . ($val["waste_type"]) . ' (' . ($val["waste_amount"]) . 'kg)
                        </h3>
                        <span style="font-size:11px;">
                            Date: ' . date("M-d-Y", strtotime($val["report_date"])) . '
                        </span>
                        <br>
                        <span style="white-space: nowrap; font-size:11px;">
                            State: ' .($c->fetchAllStatesById($val["report_state_id"])['state_name']) . '
                        </span>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="btn-group">';
            if ($val['verified_status'] == 'unverified') {
                echo '<button type="button" class="btn btn-sm btn-secondary">Not Collected</button>';
            } else {
                echo '<button type="button" class="btn btn-sm btn-success">Collected</button>';
            }
    
            if ($val['verified_status'] == 'verified') {
                echo '
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" disabled>
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            } else {
                echo '
                    </div>
                    <div class="btn-group">
                        <a href="process/processcollverify.php?report_id='.$val["report_id"].'">
                            <button type="button" class="btn btn-sm btn-outline-warning text-dark">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            }
        }
        
        echo '</div>';
    }
    else{
        echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>No Search Results for your selected state</p></div>";
    }
}

else{
if(!empty($wastecat)&&empty($stateid)&&empty($kg)){
if(count($approvewaste)>0){

    $num = count($approvewaste);
    echo "<p class='alert alert-success col-md-9'><b>$num</b> search result(s) available/found</p>";

   echo '<div class="row d-flex align-items-center mt-3">';
    foreach($approvewaste as $val){
    echo'

    <div class="col-md-4 mb-2">
            <div class="card shadow-sm">
                <img src="uploads/' . ($val["waste_image"]) . '" class="img-fluid" alt="Waste Image">
                <div class="card-body">
                    <span style="white-space: nowrap; font-size:11px;">
                        Report by @ ' .($val["user_name"]) . '
                    </span>
                    <h3 style="font-size:15px; font-weight:600;">
                        ' . ($val["waste_type"]) . ' (' . ($val["waste_amount"]) . 'kg)
                    </h3>
                    <span style="font-size:11px;">
                        Date: ' . date("M-d-Y", strtotime($val["report_date"])) . '
                    </span>
                    <br>
                    <span style="white-space: nowrap; font-size:11px;">
                        State: ' .($c->fetchAllStatesById($val["report_state_id"])['state_name']) . '
                    </span>
                    <div class="d-flex justify-content-between align-items-center mt-2">
                        <div class="btn-group">';
        if ($val['verified_status'] == 'unverified') {
            echo '<button type="button" class="btn btn-sm btn-secondary">Not Collected</button>';
        } else {
            echo '<button type="button" class="btn btn-sm btn-success">Collected</button>';
        }

        if ($val['verified_status'] == 'verified') {
            echo '
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-warning text-dark" disabled>
                        Proceed
                    </button>
                </div>
            </div>
        </div>
        </div>
        </div>';
        } else {
            echo '
                </div>
                <div class="btn-group">
                    <a href="process/processcollverify.php?report_id='.$val["report_id"].'">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark">
                            Proceed
                        </button>
                    </a>
                </div>
            </div>
        </div>
        </div>
        </div>';
        }
    }
    
    echo '</div>';
}
else{
    echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>No Search Results for your selected category</p></div>";
}}

//searchywastecatandstate
if(!empty($stateid)&& !empty($wastecat)&&empty($kg)){
    $approvedbysandc= $c->searchbystateandcategory($stateid,$wastecat);
    if(count($approvedbysandc)>0){
    
        $num = count($approvedbysandc);
        echo "<p class='alert alert-success col-md-9'><b>$num</b> search result(s) available/found</p>";
    
       echo '<div class="row d-flex align-items-center mt-3">';
        foreach($approvedbysandc as $val){
        echo'
      
        <div class="col-md-4 mb-2">
                <div class="card shadow-sm">
                    <img src="uploads/' . ($val["waste_image"]) . '" class="img-fluid" alt="Waste Image">
                    <div class="card-body">
                        <span style="white-space: nowrap; font-size:11px;">
                            Report by @ ' .($val["user_name"]) . '
                        </span>
                        <h3 style="font-size:15px; font-weight:600;">
                            ' . ($val["waste_type"]) . ' (' . ($val["waste_amount"]) . 'kg)
                        </h3>
                        <span style="font-size:11px;">
                            Date: ' . date("M-d-Y", strtotime($val["report_date"])) . '
                        </span>
                        <br>
                        <span style="white-space: nowrap; font-size:11px;">
                            State: ' .($c->fetchAllStatesById($val["report_state_id"])['state_name']) . '
                        </span>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="btn-group">';
            if ($val['verified_status'] == 'unverified') {
                echo '<button type="button" class="btn btn-sm btn-secondary">Not Collected</button>';
            } else {
                echo '<button type="button" class="btn btn-sm btn-success">Collected</button>';
            }
    
            if ($val['verified_status'] == 'verified') {
                echo '
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" disabled>
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            } else {
                echo '
                    </div>
                    <div class="btn-group">
                        <a href="process/processcollverify.php?report_id='.$val["report_id"].'">
                            <button type="button" class="btn btn-sm btn-outline-warning text-dark">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            }
        }
        
        echo '</div>';
    }
    else{
        echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>No Search Results</p></div>";
    }
    
    }

//searchywastecatandkg
if(!empty($kg)&& !empty($wastecat)&&empty($stateid)){
    $approvedbyweightandkg= $c->searchbycategoryandweight($wastecat,$kg);
    if(count($approvedbyweightandkg)>0){
    
        $num = count( $approvedbyweightandkg);
        echo "<p class='alert alert-success col-md-9'><b>$num</b> search result(s) available/found</p>";
    
       echo '<div class="row d-flex align-items-center mt-3">';
        foreach($approvedbyweightandkg as $val){
        echo'
      
        <div class="col-md-4 mb-2">
                <div class="card shadow-sm">
                    <img src="uploads/' . ($val["waste_image"]) . '" class="img-fluid" alt="Waste Image">
                    <div class="card-body">
                        <span style="white-space: nowrap; font-size:11px;">
                            Report by @ ' .($val["user_name"]) . '
                        </span>
                        <h3 style="font-size:15px; font-weight:600;">
                            ' . ($val["waste_type"]) . ' (' . ($val["waste_amount"]) . 'kg)
                        </h3>
                        <span style="font-size:11px;">
                            Date: ' . date("M-d-Y", strtotime($val["report_date"])) . '
                        </span>
                        <br>
                        <span style="white-space: nowrap; font-size:11px;">
                            State: ' .($c->fetchAllStatesById($val["report_state_id"])['state_name']) . '
                        </span>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="btn-group">';
            if ($val['verified_status'] == 'unverified') {
                echo '<button type="button" class="btn btn-sm btn-secondary">Not Collected</button>';
            } else {
                echo '<button type="button" class="btn btn-sm btn-success">Collected</button>';
            }
    
            if ($val['verified_status'] == 'verified') {
                echo '
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" disabled>
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            } else {
                echo '
                    </div>
                    <div class="btn-group">
                        <a href="process/processcollverify.php?report_id='.$val["report_id"].'">
                            <button type="button" class="btn btn-sm btn-outline-warning text-dark">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            }

        }
        
        echo '</div>';
    }
    else{
        echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>No Search Results</p></div>";
    }
    
    }

//threewaysearch
if(!empty($kg) && !empty($wastecat) && !empty($stateid)){
    $approvedbyallmetrics= $c->searchbyallmetrics($wastecat,$kg,$stateid);
    if(count($approvedbyallmetrics)>0){
    
        $num = count($approvedbyallmetrics);
        echo "<p class='alert alert-success col-md-9'><b>$num</b> search result(s) available/found</p>";
    
       echo '<div class="row d-flex align-items-center mt-3">';
        foreach($approvedbyallmetrics as $val){
        echo'
      
        <div class="col-md-4 mb-2">
                <div class="card shadow-sm">
                    <img src="uploads/' . ($val["waste_image"]) . '" class="img-fluid" alt="Waste Image">
                    <div class="card-body">
                        <span style="white-space: nowrap; font-size:11px;">
                            Report by @ ' .($val["user_name"]) . '
                        </span>
                        <h3 style="font-size:15px; font-weight:600;">
                            ' . ($val["waste_type"]) . ' (' . ($val["waste_amount"]) . 'kg)
                        </h3>
                        <span style="font-size:11px;">
                            Date: ' . date("M-d-Y", strtotime($val["report_date"])) . '
                        </span>
                        <br>
                        <span style="white-space: nowrap; font-size:11px;">
                            State: ' .($c->fetchAllStatesById($val["report_state_id"])['state_name']) . '
                        </span>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div class="btn-group">';
            if ($val['verified_status'] == 'unverified') {
                echo '<button type="button" class="btn btn-sm btn-secondary">Not Collected</button>';
            } else {
                echo '<button type="button" class="btn btn-sm btn-success">Collected</button>';
            }
    
            if ($val['verified_status'] == 'verified') {
                echo '
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-warning text-dark" disabled>
                            Proceed
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            } else {
                echo '
                    </div>
                    <div class="btn-group">
                        <a href="process/processcollverify.php?report_id='.$val["report_id"].'">
                            <button type="button" class="btn btn-sm btn-outline-warning text-dark">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            </div>';
            }
        }
        
        echo '</div>';
    }
    else{
        echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>No Search Results</p></div>";
    }
    
    }


    if(empty($kg) && empty($wastecat) && empty($stateid)){
    echo "<div class='alert alert-secondary col-md-9'><p style='font-weight:bold;'>No Search Results</p><p>Select one or more of the search options</p></div>";

    }


    


}
    
    


?>