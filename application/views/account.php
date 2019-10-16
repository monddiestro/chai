<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Registered Account</h1>
        <a href="#" data-toggle="modal" data-target="#newUserModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New Acocunt</a>
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
                <?php if(empty($users)): // if empty units don't render tables ?>
                <center>
                    <h3>No records found.</h3>
                    <i class="fas fa-folder-open fa-10x"></i>
                </center>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="units" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Date Created</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($users as $u): ?>
                        <tr>
                            <td>
                                <img style="width:50px;height:auto;display:inline;" src="<?php echo empty($u->image) ? base_url('src/img/no-profile-image.png') : base_url($u->image) ?>" alt="member_pic">
                                <?php echo $u->f_name . " " . $u->l_name; ?>
                            </td>
                            <td><?php echo $u->username ?></td>
                            <td><?php echo date('F d,Y',strtotime($u->date_created)) ?></td>
                            <td><?php echo $u->uac ?></td>
                            <td>
                                <!-- edit -->
                                <a href="#" data-toggle="modal" data-target="#editUserModal<?php echo $u->user_id ?>" class="btn btn-sm btn-info btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                                <!-- delete -->
                                <a href="#" data-toggle="modal" data-target="#dropUserModal<?php echo $u->user_id ?>" class="btn btn-sm btn-danger btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-trash"></i>
                                    </span>
                                    <span class="text">Remove</span>
                                </a>
                                <!-- password reset -->
                                <a href="#"  data-toggle="modal" data-target="#restPasswordModal<?php echo $u->user_id ?>" class="btn btn-sm btn-success btn-icon-split mb-2">
                                    <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-sync"></i>
                                    </span>
                                    <span class="text">Reset Password</span>
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

<!-- New User Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/new_user/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New User Information</h5>
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
                    <label for="type">Role</label>
                    <select name="uac" id="uac" class="selectpicker form-control" title="Ex. Owner">
                        <option value="administrator">Administrator</option>
                        <option value="editor">Editor</option>
                        <option value="user">User</option>
                    </select>
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
                    <label for="phone">Contact #</label>
                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Ex. 091234567890">
                </div>
                <div class="form-group">
                    <label for="phone">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Type user password here">
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

<!-- modals -->
<?php foreach($users as $u): ?>
<div class="modal fade" id="editUserModal<?php echo $u->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(base_url('admin/update_user/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">Update User Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="user_id" value="<?php echo $u->user_id ?>" >
                <div class="form-group">
                    <img style="width:200px; height:auto" src="<?php echo empty($u->image) ? base_url('src/img/no-profile-image.png') : base_url($u->image) ?>" id="imagePreview" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="user_image" id="btnSelectImage" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Role</label>
                    <select name="uac" id="uac" class="selectpicker form-control" title="Ex. Owner">
                        <option value="administrator" <?php echo $u->uac == 'administrator' ? 'selected' : '' ?>>Administrator</option>
                        <option value="editor" <?php echo $u->uac == 'editor' ? 'selected' : '' ?>>Editor</option>
                        <option value="user" <?php echo $u->uac == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" name="l_name" class="form-control" id="l_name" placeholder="Ex. Dela Cruz" value="<?php echo $u->l_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" class="form-control" id="f_name" placeholder="Ex. Juan" value="<?php echo $u->f_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Ex. juandelacruz@email.com" value="<?php echo $u->email ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Contact #</label>
                    <input type="number" name="contact" class="form-control" id="contact" placeholder="Ex. 091234567890" value="<?php echo $u->contact ?>" required>
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

<div class="modal fade" id="dropUserModal<?php echo $u->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="dropUserModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/drop_user/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <strong class="modal-title text-danger" id="unitModalLabel"><i class="fas fa-fw fa-exclamation-circle"></i> Warning</strong>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="user_id" value="<?php echo $u->user_id ?>" name="user_id">
                <input type="hidden" value="<?php echo $u->f_name . " " . $u->l_name ?>" name="user_name">
                Are you sure you want to remove <strong><?php echo $u->f_name . " " . $u->l_name ?></strong> from user list?
                <hr>
                <small>This will remove all data of the user</small>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-danger" type="submit">Yes</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach ?>