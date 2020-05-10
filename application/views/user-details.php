<!-- begin page content -->
<div class="container-fluid">
   <div class="row mt-3">
        <div class="">
            <a href="<?php echo $referer ?>" class="btn btn-sm btn-light mb-2 font-weight-bold">
                <i class="fas fa-chevron-left"></i>  Go Back
            </a>
        </div>
        <div class="col-sm-12 text-center">
            <?php foreach($member_details as $mb): ?>
            <img class="img-profile rounded-circle shadow" style="width:150px" src="<?php echo empty($mb->image) ? base_url('src/img/no-profile-image.png') : base_url($mb->image) ?>" alt="">
            <h2 class="mt-2"><?php echo $mb->f_name . " " . $mb->l_name ?></h2>
            <h6><i class="fas fa-home fa-fw"></i> <?php echo $mb->number ?> <i class="fas fa-mobile-alt fa-fw"></i><?php echo $mb->phone ?> / <?php echo $mb->mobile ?> <i class="fas fa-envelope fa-fw"></i> <?php echo $mb->email ?></h6>
            <?php endforeach ?>
        </div>
   </div>
   <div class="card mt-3 shadow">
        <div class="card-body">
            <div class="row">
                <?php foreach($member_details as $mb): ?>
                <div class="col-sm-3"><span class="font-weight-bold">Unit Number:</span> <?php echo $mb->number ?></div>
                <div class="col-sm-9"><span class="font-weight-bold">Address:</span> <?php  echo $mb->address ?></div>
                <?php endforeach ?>
            </div>
            <hr>
            <h6 class="font-weight-bold">House Members</h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Contact Number</th>
                                    <th>Email Address</th>
                                    <th>Member Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($members as $m): ?>
                                    <tr>
                                        <td style="vertical-align:middle">
                                            <img class="img-profile rounded-circle" style="width:50px;" src="<?php echo empty($m->image) ? base_url('src/img/no-profile-image.png') : base_url($m->image) ?>" alt="">
                                            <?php echo $m->f_name . " " .$m->l_name?>
                                        </td>
                                        <td style="vertical-align:middle"><?php echo $m->mobile ?> / <?php echo $m->phone ?></td>
                                        <td style="vertical-align:middle"><?php echo $m->email ?></td>
                                        <td style="vertical-align:middle"><?php echo ($m->type == "1") ? "Owner" : "Member" ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
            <h6 class="font-weight-bold">Cars Registered</h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Model</th>
                                    <th>Color</th>
                                    <th>Plate Number</th>
                                    <th>Owner</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($cars as $c): ?>
                                <tr>
                                    <td style="vertical-align:middle"><img style="width:100px;" src="<?php echo empty($c->image) ? base_url('src/img/no-image.png') : base_url($c->image); ?>" alt=""></td>
                                    <td style="vertical-align:middle"><?php echo $c->make . " " . $c->model ?></td>
                                    <td style="vertical-align:middle"><?php echo $c->color ?></td>
                                    <td style="vertical-align:middle"><?php echo $c->plate_number ?></td>
                                    <td style="vertical-align:middle">
                                    <img class="img-profile rounded-circle" style="width:50px;" src="<?php echo empty($c->member_image) ? base_url('src/img/no-profile-image.png') : base_url($c->member_image) ?>" alt="">
                                        <?php echo $c->f_name . " " . $c->l_name ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- end page content -->