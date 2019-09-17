<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registered Cars</h1>
        <a href="#" data-toggle="modal" data-target="#newCarModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Car</a>
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
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Information</h6>
            </div>
            <div class="card-body">
                <?php if(empty($cars)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Model</th>
                            <th>Plate Number</th>
                            <th>Color</th>
                            <th>Owner</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Model</th>
                            <th>Plate Number</th>
                            <th>Color</th>
                            <th>Owner</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($cars as $c): ?>
                        <tr>
                            <td>
                                <img style="width:100px;height:auto" src="<?php echo base_url($c->image) ?>" alt="">
                            </td>
                            <td>
                                <?php echo $c->model ?>
                            </td>
                            <td>
                                <?php echo $c->plate_number ?>
                            </td>
                            <td>
                                <?php echo $c->color ?>
                            </td>
                            <td>
                                <?php echo $c->f_name . " " . $c->l_name ?>
                            </td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#editCarModal<?php echo $c->id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-sm fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- add -->
                                <a href="#" data-toggle="modal" data-target="#delCarModal<?php echo $c->id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-sm fa-trash"></i>
                                    </span>
                                    <span class="text">Remove</span>
                                </a>
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

<!-- New Car Modal -->
<div class="modal fade" id="newCarModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/add_car/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New Car Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img style="width:100%; height:auto" src="<?php echo base_url('src/img/no-image.png') ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="car_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label>Unit Number</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <option value="" hidden>Select Unit Number</option>
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>"><?php echo $u->number ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>     
                <div class="form-group">
                    <label>Car Owner</label>
                    <select class="form-control" name="member_id" id="member_id">
                        <option value="" hidden>Select Car Owner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Make</label>
                    <input type="text" name="make" class="form-control" placeholder="Ex. Toyota">
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="model" class="form-control" placeholder="Ex. Vios">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" placeholder="Ex. Black">
                </div>
                <div class="form-group">
                    <label>Plate Number</label>
                    <input type="text" name="plate_no" class="form-control" placeholder="Ex. CAR 1234">
                </div>        
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<!-- Modals -->
<?php foreach($cars as $c): ?>
<div class="modal fade" id="editCarModal<?php echo $c->id ?>" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/modify_car/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New Car Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="<?php echo $c->id ?>" name="car_id"/>
                <div class="form-group">
                    <img style="width:100%; height:auto" src="<?php echo base_url($c->image) ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="car_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label>Unit Number</label>
                    <select name="unit_id" id="unit_id" class="form-control">
                        <option value="" hidden>Select Unit Number</option>
                        <?php foreach($units as $u): ?>
                        <option value="<?php echo $u->unit_id ?>" <?php echo $c->unit_id == $u->unit_id ?  'selected' : '' ?>><?php echo $u->number ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>     
                <div class="form-group">
                    <label>Car Owner</label>
                    <select class="form-control" name="member_id" id="member_id">
                        <option value="" hidden>Select Car Owner</option>
                        <?php foreach($members as $m): ?>
                            <option value="<?php echo $m->member_id ?>" <?php echo ($m->member_id == $c->member_id) ? 'selected' : '' ?>><?php echo $m->f_name . " " . $m->l_name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Make</label>
                    <input type="text" name="make" class="form-control" placeholder="Ex. Toyota" value="<?php echo $c->make ?>">
                </div>
                <div class="form-group">
                    <label>Model</label>
                    <input type="text" name="model" class="form-control" placeholder="Ex. Vios" value="<?php echo $c->model ?>">
                </div>
                <div class="form-group">
                    <label>Color</label>
                    <input type="text" name="color" class="form-control" placeholder="Ex. Black" value="<?php echo $c->color ?>">
                </div>
                <div class="form-group">
                    <label>Plate Number</label>
                    <input type="text" name="plate_no" class="form-control" placeholder="Ex. CAR 1234" value="<?php echo $c->plate_number ?>">
                </div>        
            </div>
            <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>

<?php endforeach; ?>