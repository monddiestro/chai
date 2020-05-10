<!-- Begin Page Content --> 
<div class="container-fluid">
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
        <!-- fist col -->
        <div class="col-sm-9 mb-3">
            <div class="row mb-3">
                <div class="col-md-10">
                    <div class="search">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                            </div>
                            <input type="text" id="visitor_name" value="<?php echo (empty($visitor_name)) ? '' : $visitor_name ?>" class="form-control" name="member_name" placeholder="Search Visitor Name" aria-label="Unit Number" aria-describedby="basic-addon1">
                            <input type="hidden" id="visitor_id" value="<?php echo (empty($visitor_id)) ? '' : $visitor_id ?>"/>     
                        </div>
                        <div id="list" class="autocomplete shadow"></div>
                    </div>
                </div>
                <div class="col-md-2 ">
                    <a href="#" data-toggle="modal" data-target="#newVisitorModal" class="btn btn-primary btn-sm btn-block shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Visitor</a>
                </div>
            </div>

            <div class="table-responsive shadow">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Visited Unit</th>
                            <th>Vehicle</th>
                            <th>Date and Time of Enter</th>
                            <th>Date and Time of Exit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($visitors)): ?>
                        <?php foreach($visitors as $v): ?>
                            <tr>
                                <td><?php echo $v->first_name . " " . $v->last_name ?></td>
                                <td><?php echo $v->number ?></td>
                                <td><?php echo $v->vehicle ?></td>
                                <td><?php echo date('F d, Y h:i a',strtotime($v->date_in)) ?></td>
                                <td><?php echo empty($v->date_out) ? '<a href="#" data-toggle="modal" data-target="#outModal'.$v->visitor_id.'" class="btn btn-sm btn-primary shadow-sm"> Exit Now</a>' : date('F d, Y h:i a',strtotime($v->date_out)) ?></td>
                            </tr>
                        <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(empty($visitors)): ?>
                <div style="text-align:center" class="mb-5">
                    <i class="fas fa-inbox fa-7x"></i>
                    <h4>No data to show</h4>
                </div>
                <?php endif ?>
            </div>
            
            <div class="search mt-3">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" id="search_member" value="<?php echo (empty($q_name)) ? '' : $q_name ?>" class="form-control" name="member_name" placeholder="Search Member Name" aria-label="Username" aria-describedby="basic-addon1">
                    <input type="hidden" id="q_member" value="<?php echo (empty($q_member)) ? '' : $q_member ?>"/>      
                </div>
                <div id="list" class="autocomplete shadow"></div>
            </div>
            <div class="table-responsive shadow">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Unit No</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($members)): ?>
                        <?php foreach($members as $m): ?>
                            <tr>
                                <td><?php echo $m->f_name . " " . $m->l_name ?></td>
                                <td><?php echo $m->number ?></td>
                                <td class="text-right"><a href="<?php echo base_url('user/details/'.$m->member_id) ?>" class="btn btn-sm btn-primary">View  </a></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif ?>
                    </tbody>
                </table>
                <?php if(empty($members)): ?>
                <div style="text-align:center" class="mb-5">
                    <i class="fas fa-inbox fa-7x"></i>
                    <h4>No data to show</h4>
                </div>
                <?php endif ?>
            </div>
        </div>
        <!-- second col -->
        <!-- 2nd division  -->
        <div class="col-sm-3">
            <div class="card shadow">
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
</div>