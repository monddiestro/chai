<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">Archives</h1>
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

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="table-responsive">
            <?php if(!empty($requests)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Unit No.</th>
                            <th>Type & Description</th>
                            <th>Date of Request</th>
                            <th>Date Accomplished</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($requests as $r): ?>
                        <tr>
                            <td><?php echo $r->number ?></td>
                            <td><?php echo $r->work_title . " : " . $r->request_desc ?></td>
                            <td><?php echo date('F d, Y',strtotime($r->date_request)) ?></td>
                            <td><?php echo date('F d, Y',strtotime($r->date_done)) ?></td>
                            <td>
                                <button data-toggle="modal" data-target="#info_<?php echo $r->request_id?>" class="btn btn-primary btn-sm font-weight-bold">
                                    <i class="fas fa-sm fa-info-circle" data-toggle="tooltip" data-placement="right" title="Assign Helper"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
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