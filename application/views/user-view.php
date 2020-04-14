<!-- Begin Page Content --> 
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <!-- fist col -->
        <div class="col-sm-9 mb-3">
            <div class="search">
                <div class="input-group mb-3">
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
                                <td><a href="<?php echo base_url('user/details/'.$m->member_id) ?>" class="btn btn-primary">View Details</a></td>
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
                            <span><?php echo $a->act_desc    ?></span>
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