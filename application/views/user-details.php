<!-- begin page content -->
<div class="container-fluid">
   <div class="row mt-5">
        <div class="col-sm-12 text-center"> 
            <img class="img-profile rounded-circle shadow" style="width:150px" src="http://localhost/chai/src/img/no-profile-image.png" alt="">
            <h2 class="mt-2">Reymond Diestro</h2>
            <h6><i class="fas fa-home fa-fw"></i> 1001 <i class="fas fa-mobile-alt fa-fw"></i>09167367735 <i class="fas fa-envelope fa-fw"></i> reymonddiestro@gmail.com</h6>
        </div>
   </div>
   <div class="card mt-3 shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-3"><span class="font-weight-bold">Unit Number:</span> 1001</div>
                <div class="col-sm-9"><span class="font-weight-bold">Address:</span> 9 Iris St. West Fairview Quezon City</div>
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