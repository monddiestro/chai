<input type="hidden" value="<?php echo $this->session->userdata('user_id'); ?>" id="user_id">
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Account Profile</h1>
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
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold">Personal Information</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="<?php echo base_url('img/ashee.png') ?>" alt="" id="imagePreview" name="image" style="width:100%"/>
                            <br/>
                            <br/>
                            <label class="btn btn-secondary">
                                <input type="file" name="user_image" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                                Browse ...
                            </label>
                        </div>
                        <div class="col-md-6">
                            <div clas="form-group">
                                <label class="" for="">First Name</label>
                                <input type="text" class="form-control" name="f_name" value="" placeholder="ex. Juan"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Last Name</label>
                                <input type="text" class="form-control" name="l_name" value="" placeholder="ex. Dela Cruz"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Contact Number</label>
                                <input type="text" class="form-control" name="contact" value="" placeholder="ex. 091234567890 / 0212345678"/>
                            </div>
                            <div clas="form-group">
                                <label for="">Email</label>
                                <input type="text" class="form-control" name="email" value="" placeholder="ex. juan.delacruz@mail.com"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <!-- password -->
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold">Account Security</span>
                </div>
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
                                <input type="password" id="currentPwd" class="form-control" name="password" value="" placeholder="Type your current password" disabled/>
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