<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">System Users</h1>
        </div>
        <div class="p-1">
        <a href="#" data-toggle="modal" data-target="#newUserModal" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> New User</a>
        </div>
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
    <?php if(!empty($display)): ?>
    <div class="alert alert-<?php echo $class ?> alert-dismissible fade <?php echo $display ?>" role="alert">
        <?php echo $hessage; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Date Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u): ?>
                    <tr>
                        <td>
                            <img style="width:50px;height:auto;display:inline;" src="<?php echo empty($u->image) ? base_url('src/img/no-profile-image.png') : base_url($u->image) ?>" alt="member_pic">
                            <?php echo $u->f_name . " " . $u->l_name; ?>
                        </td>
                        <td style="text-transform:capitalize"><?php echo $u->uac ?></td>
                        <td><?php echo date('F d,Y',strtotime($u->date_created)) ?></td>
                        <td>
                            <!-- edit -->
                            <a href="#" data-toggle="modal" data-target="#editUserModal<?php echo $u->user_id ?>" class="btn btn-sm btn-info mb-2">
                                <i class="fas fa-fw fa-pencil-alt"></i>
                            </a>
                            <!-- delete -->
                            <a href="#" data-toggle="modal" data-target="#dropUserModal<?php echo $u->user_id ?>" class="btn btn-sm btn-danger mb-2">
                                <i class="fas fa-fw fa-trash"></i>
                            </a>
                            <!-- password reset -->
                            <a href="#"  data-toggle="modal" data-target="#resetPasswordModal<?php echo $u->user_id ?>" class="btn btn-sm btn-success mb-2">
                                <i class="fas fa-fw fa-sync"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
                        <input type="file" name="user_image" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
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
                    <input type="text" name="l_name" class="form-control" placeholder="Ex. Dela Cruz" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" class="form-control" placeholder="Ex. Juan" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Ex. juandelacruz@email.com" required>
                </div>
                <div class="form-group">
                    <label for="phone">Contact #</label>
                    <input type="number" name="contact" class="form-control" placeholder="Ex. 091234567890">
                </div>
                <div class="form-group">
                    <label for="phone">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Type user password here">
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
            <h5 class="modal-title">Update User Information</h5>
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
                        <input type="file" name="user_image" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Role</label>
                    <select name="uac" class="selectpicker form-control" title="Ex. Owner">
                        <option value="administrator" <?php echo $u->uac == 'administrator' ? 'selected' : '' ?>>Administrator</option>
                        <option value="editor" <?php echo $u->uac == 'editor' ? 'selected' : '' ?>>Editor</option>
                        <option value="user" <?php echo $u->uac == 'user' ? 'selected' : '' ?>>User</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="l_name">Last Name</label>
                    <input type="text" name="l_name" class="form-control" placeholder="Ex. Dela Cruz" value="<?php echo $u->l_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="f_name">First Name</label>
                    <input type="text" name="f_name" class="form-control" placeholder="Ex. Juan" value="<?php echo $u->f_name ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="Ex. juandelacruz@email.com" value="<?php echo $u->email ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone">Contact #</label>
                    <input type="number" name="contact" class="form-control" placeholder="Ex. 091234567890" value="<?php echo $u->contact ?>" required>
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
                <input type="hidden" value="<?php echo $u->user_id ?>" name="user_id">
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

<div class="modal fade" id="resetPasswordModal<?php echo $u->user_id ?>" tabindex="-1" role="dialog" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/update_password/')) ?>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <strong class="modal-title" id="unitModalLabel">Passsworrd Reset</strong>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="<?php echo $u->user_id ?>" name="user_id">
                <input type="hidden" name="name" value="<?php echo $u->f_name . " " . $u->l_name ?>">
                <div class="form-group">
                    <label for="current">Current Password</label>
                    <input type="password" value="" class="form-control" name="current" placeholder="Current Password">
                </div>
                <div class="form-group">
                    <label for="new">New Password</label>
                    <input type="password" value="" class="form-control" name="new" placeholder="New Password" disabled>
                </div>
                <div class="form-group">
                    <label for="new">Confirm Password</label>
                    <input type="password" value="" class="form-control" name="confirm" placeholder="Confirm Password" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" disabled>Save</button>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>
</div>
<?php endforeach ?>