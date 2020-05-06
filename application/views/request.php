<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">Requests</h1>
        </div>
        <div class="p-1">
            <a href="#" data-toggle="modal" data-target="#newRequestModal" class="btn btn-sm btn-primary btn-block shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Request</a>
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
        <?php if(empty($requests)): ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Unit No.</th>
                        <th>Type & Description</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
            <div class="text-center mt-5 mb-5">
                <h4>No records found.</h4>
                <i class="fas fa-folder-open fa-4x"></i>
            </div>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Unit No.</th>
                        <th>Type & Description</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($requests as $r): ?>
                    <tr>
                        <td><?php echo $r->number ?></td>
                        <td><?php echo $r->work_title . " : " . $r->request_desc ?></td>
                        <td><?php echo date('F d, Y',strtotime($r->date_request)) ?></td>
                        <td>
                            <?php if($r->status == 'in-progress'): ?>
                            <button data-toggle="modal" data-target="#markDone_<?php echo $r->request_id?>" class="btn btn-primary btn-sm font-weight-bold">
                                <i class="fas fa-fw fa-check" data-toggle="tooltip" data-placement="right" title="Mark as Done"></i>
                            </button>
                            <?php else: ?>
                            <button data-toggle="modal" data-target="#assign_<?php echo $r->request_id?>" class="btn btn-primary btn-sm font-weight-bold">
                                <i class="fas fa-fw fa-user-tag" data-toggle="tooltip" data-placement="right" title="Assign Helper"></i>
                            </button>
                            <?php endif ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <?php endif ?>        
    </div>

<!-- page content close tag -->
</div>
<!-- /.container-fluid --> 


<!-- request modal -->
<div class="modal fade" id="newRequestModal" tabindex="-1" role="dialog" aria-labelledby="newRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <?php echo form_open(base_url('request/new/')) ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRequestModalLabel">Create New Request</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="work_id">Request Type</label>
                    <select name="work_id" id="work_id" class="selectpicker form-control" title="Select Type Of Work" required>
                        <?php foreach($works as $w): ?>
                        <option value="<?php echo $w->work_id ?>"><?php echo $w->work_title ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="helper_id">Helper</label>
                    <select name="helper_id" id="helper_id" class="selectpicker form-control" title="Select Helper"></select>
                </div>
                <div class="form-group">
                    <label for="unit_id">Unit No.</label>
                    <select name="unit_id" id="unit_id" class="selectpicker form-control" title="Select Unit Number" required>
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>"><?php echo $u->number ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="request_desc">Description</label>
                    <textarea class="form-control" name="request_desc" id="request_desc" cols="10" rows="5" placeholder="Add your request description here ..."></textarea>
                </div>
                <div class="form-group">
                    <label for="date_request">Request Date</label>
                    <input type="date" class="form-control" name="date_request">
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
        <?php echo form_close() ?>
    </div>
</div>
<!-- mark as done -->
<?php foreach($requests as $r): ?>
    <?php if($r->status == 'in-progress'): ?>
    <div class="modal fade" id="markDone_<?php echo $r->request_id?>" tabindex="-1" role="dialog" aria-labelledby="markDoneLabel_<?php echo $r->request_id?>" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <?php echo form_open(base_url('request/change_status/')) ?>
            <div class="modal-content">
                <div class="modal-body">
                    <input type="hidden" name="status" value="done"/>
                    <input type="hidden" name="request_id" value="<?php echo $r->request_id ?>">
                    <input type="hidden" name="helper_id" value="<?php echo $r->helper_id ?>">
                    Are you sure you want to change the status of this request to done?
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                    <button class="btn btn-primary" type="submit">Yes</button>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
    <?php endif ?>
    <?php if($r->status == 'pending'): ?>
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
    <?php endif ?>
    

    

<?php endforeach; ?>