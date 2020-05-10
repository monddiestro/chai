<input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" id="user_id">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex mb-4">
        <div class="mr-auto p-1">
            <h1 class="h4 mb-0 text-gray-800 text-center">User Profile</h1>
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

    <div class="row">
        <div class="col-md-8 mb-2">
            <!-- personal information -->
            <div class="card shadow">
                <div class="card-body">
                    <?php foreach($account_info as $a): ?>
                    <?php echo form_open_multipart(base_url("admin/update_user/")); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="shadow imagePreview" src="<?php echo empty($a->image) ? base_url('src/img/no-profile-image.png') : base_url($a->image) ?>" alt="" id="imagePreview" name="image" style="width:100%"/>
                            <br/>
                            <br/>
                            <label class="btn btn-sm btn-secondary">
                                <input id="account_file" disabled type="file" name="user_image" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                                Browse ...
                            </label>
                        </div>
                        <div class="col-md-6">
                            <input type="hidden" name="user_id" value="<?php echo $this->session->userdata('user_id'); ?>">
                            <input type="hidden" name="uac" value="<?php echo $this->session->userdata('uac'); ?>">
                            <div clas="form-group">
                                <label class="" for="">First Name</label>
                                <input readonly id="account_fname" type="text" class="form-control" name="f_name" value="<?php echo $a->f_name ?>" placeholder="ex. Juan"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Last Name</label>
                                <input readonly id="account_lname" type="text" class="form-control" name="l_name" value="<?php echo $a->l_name ?>" placeholder="ex. Dela Cruz"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Contact Number</label>
                                <input readonly id="account_contact" type="text" class="form-control" name="contact" value="<?php echo $a->contact ?>" placeholder="ex. 091234567890 / 0212345678"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Email</label>
                                <input readonly id="account_email" type="text" class="form-control" name="email" value="<?php echo $a->email ?>" placeholder="ex. juan.delacruz@mail.com"/>
                            </div>
                            <div class="form-group mt-3 text-right">
                                <button id="btnUpdate" type="button" class="btn btn-sm btn-primary">Update</button>
                                <button id="btnSaveInfo" type="submit" style="display:none" type="button" class="btn btn-sm btn-primary">Save</button>
                                <a id="btnCancel" style="display:none" href="<?php echo base_url('account/profile') ?>" class="btn btn-sm btn-light">Cancel</a>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- password -->
            <div class="card shadow">
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible fade show" style="display:none"  role="alert" id="successPassword">
                        <strong>Success!</strong> Your new password was saved.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div clas="form-group" id="password">
                                <label class="" for="">Current Password</label>
                                <input type="password" id="currentPwd" class="form-control" name="password" value="12312312312312312312" placeholder="Type your current password" disabled/>
                                <small id="passwordFeedback" class=""></small>
                            </div>
                            <div id="newPassword" style="display:none;">
                                <div clas="form-group">
                                    <label class="" for="">New Password</label>
                                    <input type="password" id="new_password" class="form-control" name="new_password" value="" placeholder="Type your new password"/>
                                </div>
                                <div clas="form-group">
                                    <label class="" for="">Confirm Password</label>
                                    <input type="password" id="confirm_password" class="form-control" name="confirm_password" value="" placeholder="Type again your new password"/>
                                    <small id="confirmFeedback" class=""></small>
                                </div>
                            </div>
                            <div class="mt-3 text-right">
                                <div id="changePwd" style="display:none">
                                    <button class="btn btn-light" id="btnCancel">Cancel</button>
                                    <button class="btn btn-primary" id="btnSave" disabled>Save</button>
                                </div>
                                <button class="btn btn-primary" id="btnChangePwd">Change password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        
    </div>


<!-- page content close tag -->
</div>
<!-- /.container-fluid -->