<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">Dashboard</h1>
        </div>
    </div>

    <?php 
        // check flash session for notification
        $session = $this->session->flashdata('result');
        // if not empty add values from session
        if(!empty($session)) {
           $display = "show";
           $class = $session["class"];
           $message = $session["message"];
        } else {
           $display = $class = $message = "";
        }
    ?>
    <?php if(!empty($display)): ?>
    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>
    
    <div class="row">
        <!-- 1st division -->
        <div class="col-sm-9 mb-3">
            <div class="row">
                <!-- Members -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Members</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo empty($member_cnt) ? '0' : $member_cnt ?></div>
                                </div>
                                <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Units-->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Units</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo empty($unit_cnt) ? '0' : $unit_cnt ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-home fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cars -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Cars</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo empty($car_cnt) ? '0' : $car_cnt ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-car-side fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Helpers -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Helpers</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo empty($helpers_cnt) ? '0' : $helpers_cnt ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-hands-helping fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- request -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center mb-3">
                                <div class="col mr-12">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PENDING REQUEST</div>
                                </div>
                            </div>
                            <hr>
                            <?php if(empty($pending)): ?>
                            <div class="text-center mt-5 mb-5">
                                <h4>No pending request</h4>
                                <i class="fas fa-folder-open fa-4x"></i>
                            </div>
                            <?php else: ?>
                            <?php foreach($pending as $p): ?>
                            <div class="row">
                                <div class="col-sm-9 border-left-warning mb-2"> 
                                    <h6 class="font-weight-bold"><?php echo $p->number ?> | <?php echo $p->work_title ?> | <?php echo date("F d, Y",strtotime($p->date_request)) ?></h6>
                                    <span><?php echo $p->work_desc ?></span><br/>
                                    <small><?php echo $p->request_desc ?></small>
                                </div>
                                <div class="col-sm-3 align-self-center">
                                    <button data-toggle="modal" data-target="#assign_<?php echo $p->request_id?>" class="btn btn-primary btn-block text-xs font-weight-bold">ASSIGN HELPER</button>
                                </div>
                            </div>
                            <hr/>
                            <?php endforeach ?>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2nd division  -->
        <div class="col-sm-3">
            <div class="card">
                <div class="card-header">
                    <h6 class="font-weight-bold">Activity Log</h6>
                </div>
                <div class="card-body">
                    <?php $count = 0 ?>
                    <?php foreach($log as $a): ?>
                    <?php if($count <= 5): ?>
                    <div class="row">
                        <div class="col-3 align-self-center">
                            <img style="width:50px;height:50px;" class="img-profile rounded-circle" src="<?php echo empty($a->image) ? base_url('src/img/no-image.png') : base_url($a->image) ?>" alt="">
                        </div>
                        <div class="col-9">
                            <span style='font-weight:600'><?php echo $a->f_name . " " . $a->l_name ?></span><span> <?php echo $a->act_desc ?></span>
                            <br/>
                            <?php
                                $activity_time = "";
                                $act_date = date("Y-m-d",strtotime($a->date_created));
                                if($act_date == date('Y-m-d')) {
                                    $hour = intdiv($a->date_diff,60);
                                    $minute = $a->date_diff % 60;
                                    $activity_time = ($hour > 1) ? $hour . " hour ago" : ($hour == 1) ? $hour . " hours ago" : ($minute > 1 ) ? $minute . " minutes ago" : "less than a minute" ;  
                                } else {
                                    $activity_time = date('F d, Y h:i A',strtotime($a->date_created));
                                }

                            ?>
                            <small><?php echo $activity_time ?></small>
                        </div>
                    </div>
                    <hr>
                    <?php $count+=1; ?>
                    <?php else: ?>
                    <?php break; ?>
                    <?php endif ?>
                    <?php endforeach ?>
                </div>
                <div class="card-footer text-center">
                    <a href="<?php echo base_url('logs/') ?>"><span class="text-primary font-weight-bold">View More</span></a>
                </div>
            </div>
        </div>
    </div>
    
<!-- page content close tag -->
</div>
<!-- /.container-fluid -->
<?php foreach($pending as $r): ?>
<div class="modal fade" id="assign_<?php echo $r->request_id?>" tabindex="-1" role="dialog" aria-labelledby="assignLabel_<?php echo $r->request_id?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php echo form_open(base_url('request/change_status/')) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">Assign Helper</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="status" value="in-progress"/>
                <input type="hidden" name="request_id" value="<?php echo $r->request_id ?>">
                <div class="form-group">
                    <label for="type">Helper Name</label>
                    <select name="helper_id" id="helper_id" class="selectpicker form-control" title="Select Helper">
                        <?php foreach($helpers as $h): ?>
                            <?php if($h->work_id == $r->work_id): ?>
                            <option value="<?php echo $h->helper_id ?>"><?php echo $h->f_name . " " . $h->l_name ?></option>
                            <?php endif ?>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Yes</button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<?php endforeach ?>