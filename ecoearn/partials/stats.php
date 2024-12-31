<div class="row px-3 mt-3">
                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong><?php echo $countuser['userscount']?></strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Platform Users</p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-user text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong><?php echo $countcoll['collcount']?></strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Registered Collectors</p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-box-archive text-white"> <span style="font-size:13px;">[<?php echo $approvedcount['count'] ?> Approved]</i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong><?php echo $rcount['count']?></strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Platform Reports</span></p>
                                        </div>
                            
                                    </div>
                            </div>

                            <div class="col-md-3 ">
                                    <div class=" card acardstats shadow-sm p-3 bg-dark">
                                        <div class="card-header-custom">
                                        <i class="fa-solid fa-wallet text-white"></i>
                                        </div>
                                        <div class="card-body-custom mt-2">
                                            <div class="card-stat text-white"><strong>&#8358;<?php echo number_format($spaycount['sum'],2)?></strong></div>
                                            <p class="mt-2 mb-0 text-white">Total Payments</p>
                                        </div>
                            
                                    </div>
                            </div>

                    
                    </div>