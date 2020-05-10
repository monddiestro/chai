    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex mb-3">
            <div class="mr-auto p-1">
                <h1 class="h4 mb-0 text-gray-800 text-center">Visitor Logs</h1>
            </div>
            <div class="p-1">
                <div class="search">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="visitor_name" value="<?php echo (empty($visitor_name)) ? '' : $visitor_name ?>" class="form-control" name="member_name" placeholder="Search Name" aria-label="Unit Number" aria-describedby="basic-addon1">
                        <input type="hidden" id="visitor_id" value="<?php echo (empty($visitor_id)) ? '' : $visitor_id ?>"/>      
                    </div>
                    <div id="list" class="autocomplete"></div>
                </div>
            </div>
            <div class="p-1">
                <a href="#" data-toggle="modal" data-target="#newVisitorModal" class="btn btn-sm btn-primary btn-block shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Visitor</a>
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
            <?php if(!empty($visitors)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Visit Unit</th>
                            <th>Address</th>
                            <th>Vehicle</th>
                            <th>ID Presented</th>
                            <th>Date and Time of Enter</th>
                            <th>Date and Time of Exit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($visitors as $v): ?>
                            <tr>
                                <td><?php echo $v->first_name . " " . $v->last_name ?></td>
                                <td><?php echo $v->number ?></td>
                                <td><?php echo $v->address ?></td>
                                <td><?php echo $v->vehicle ?></td>
                                <td><?php echo $v->id_presented ?></td>
                                <td><?php echo date('F d, Y h:i a',strtotime($v->date_in)) ?></td>
                                <td><?php echo empty($v->date_out) ? '<a href="#" data-toggle="modal" data-target="#outModal'.$v->visitor_id.'" class="btn btn-sm btn-primary shadow-sm"> Exit Now</a>' : date('F d, Y h:i a',strtotime($v->date_out)) ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Visit Unit</th>
                            <th>Address</th>
                            <th>Vehicle</th>
                            <th>ID Presented</th>
                            <th>Date and Time of Enter</th>
                            <th>Date and Time of Exit</th>
                        </tr>
                    </thead>
                </table>
                <div class="text-center mt-5 mb-5">
                    <h4>No records found.</h4>
                    <i class="fas fa-folder-open fa-4x"></i>
                </div>
            </div>
            <?php endif ?>
        </div>

        <!-- pagination -->
        <div class="d-flex flex-row-reverse">
        <?php echo !empty($pagination) ? $pagination : '' ?>
        </div>

<!-- out modal -->
<?php foreach($visitors as $v): ?>
<div class="modal fade" id="outModal<?php echo $v->visitor_id ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
    <?php echo form_open(base_url('logs/visitor_out/')); ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h6 class="modal-title font-weight-bold">Warning</h6>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="visitor_id" value="<?php echo $v->visitor_id ?>">
                Are you sure this visitor will exit now?
            </div>
            <div class="modal-footer">
              <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">No</button>
              <button class="btn btn-sm btn-primary" type="submit">Yes</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach ?>
<!-- page content close tag -->
</div>
<!-- /.container-fluid -->