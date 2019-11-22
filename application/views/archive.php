<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Archive</h1>
        <a href="#" data-toggle="modal" data-target="#newMemberModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Member</a>
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

    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $message; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
            <div class="card-body">
                <?php if(empty($requests)): // if empty archive don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                    <div class="d-none d-md-block">
                        <div class="row">
                            <div class="col-sm-2">
                                <span class="font-weight-bold">Unit No.</span>
                            </div>
                            <div class="col-sm-6">
                                <span class="font-weight-bold">Request Type & Description</span>
                            </div>
                            <div class="col-sm-4">
                                <span class="font-weight-bold">Request Date</span>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php foreach($requests as $r): ?>
                    <div class="row border-left-primary mb-3">
                        <div class="col-sm-2">
                            <?php echo $r->number ?>
                        </div>
                        <div class="col-sm-6">
                            <?php echo $r->work_title . " : " . $r->request_desc ?>
                        </div>
                        <div class="col-sm-3 mb-3">
                            <?php echo date('F d, Y',strtotime($r->date_request)) ?>
                        </div>
                        <div class="col-sm-1 text-right">
                            <button data-toggle="modal" data-target="#info_<?php echo $r->request_id?>" class="btn btn-primary btn-sm font-weight-bold">
                                <i class="fas fa-fw fa-info-circle" data-toggle="tooltip" data-placement="right" title="Assign Helper"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach ?>
                <?php endif ?>
            </div>
          </div>

<!-- page content close tag -->
</div>
<!-- /.container-fluid -->
<?php foreach($requests as $r): ?>
    <div class="modal fade" id="info_<?php echo $r->request_id?>" tabindex="-1" role="dialog" aria-labelledby="markDoneLabel_<?php echo $r->request_id?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unitModalLabel">Request Details</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <h6 class="font-weight-bold">Date Request</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h6 class="font-weight-bold"><?php echo date('F d, Y',strtotime($r->date_done)) ?></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $r->work_title ?></h6>
                                    <small class="text-muted"><?php echo $r->work_desc ?></small>
                                </div>
                                <span class="text-muted"><?php echo $r->number ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0"><?php echo $r->f_name . " " . $r->l_name ?></h6>
                                    <small class="text-muted">Helper Name</small>
                                </div>
                                <span class="text-muted">
                                    <img style="width:50px;height:auto" src="<?php echo base_url($r->image) ?>" alt=""/>
                                </span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div>
                                    <h6 class="my-0">Note: <?php echo $r->request_desc ?></h6>
                                </div>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Date Done</span>
                                <strong><?php echo date('F d, Y',strtotime($r->date_done)) ?></strong>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>