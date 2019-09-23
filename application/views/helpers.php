<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registered Helpers</h1>
        <a href="#" data-toggle="modal" data-target="#newHelperModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Helper</a>
    </div>

    <?php 
        // check flash session for notification
        $session = $this->session->flashdata('result');
        // if not empty add values from session
        if(!empty($session)) {
           $display = "show";
           $class = $session["class"];
           $hessage = $session["message"];
        } else {
           $display = $class = $hessage = "";
        }
    ?>

    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $hessage; ?>
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
                <?php if(empty($hembers)): // if empty units don't render tables ?>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone #</th>
                            <th>Mobile #</th>
                            <th>Address</th>
                            <th>Work</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        <th></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone #</th>
                            <th>Mobile #</th>
                            <th>Address</th>
                            <th>Work</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($helpers as $h): ?>
                        <tr>
                            <td>
                                <img style="width:50px;height:auto;display:inline;" src="<?php echo base_url($h->image) ?>" alt="member_pic"></td>
                            <td>
                                <span><?php echo $h->f_name . " " . $h->l_name ?></span>
                            </td>
                            <td><?php echo $h->email ?></td>
                            <td><?php echo $h->phone ?></td>
                            <td><?php echo $h->mobile ?></td>
                            <td><?php echo $h->address ?></td>
                            <td></td>
                            <td><?php echo $h->status ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#memberModal<?php echo $h->helper_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- delete -->
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#dropMemberModal<?php echo $h->helper_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-trash"></i>
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

<!-- Helpers Modal -->
<div class="modal fade" id="newHelperModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/new_helper/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unitModalLabel">New Helper Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <img style="width:200px; height:auto" src="<?php echo base_url('src/img/no-profile-image.png') ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="user_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" name="l_name" class="form-control" id="l_name" placeholder="Ex. Dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" class="form-control" id="f_name" placeholder="Ex. Juan" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Ex. juandelacruz@email.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone #</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Ex. 021234567">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile #</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Ex. 091234567890">
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" name="address" id="" cols="30" rows="5" placeholder="Ex. Cerritos Heights, Cavite "></textarea>
                </div>
                <div  class="form-group">
                    <label for="work">Work can do</label>
                    <select name="work_id" class="selectpicker form-control" title="Ex. Babysitting, Gardener" multiple>
                        <?php foreach($works as $w): ?>
                        <option value="<?php echo $w->work_id ?>"><?php echo $w->work_title ?></option>
                        <?php endforeach ?>
                    </select>
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