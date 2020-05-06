    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex mb-4">
            <div class="mr-auto p-1">
                <h1 class="h4 mb-0 text-gray-800 text-center">Activity Logs</h1>
            </div>
            <!-- <div class="p-1">
                <div class="search">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
                        </div>
                        <input type="text" id="search_member" value="<?php echo (empty($member_name)) ? '' : $member_name ?>" class="form-control" name="member_name" placeholder="Search Name" aria-label="Unit Number" aria-describedby="basic-addon1">
                        <input type="hidden" id="q_member" value="<?php echo (empty($member_id)) ? '' : $member_id ?>"/>      
                    </div>
                    <div id="list" class="autocomplete"></div>
                </div>
            </div> -->
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
            <?php if(!empty($activity)): ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Activity</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($activity as $a): ?>
                            <tr>
                                <td><?php echo $a->f_name . " " . $a->l_name ?></td>
                                <td><?php echo $a->act_desc ?></td>
                                <td><?php echo date('F d, Y h:i a',strtotime($a->date_created)) ?></td>
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
                            <th>Activity</th>
                            <th>Date</th>
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

<!-- page content close tag -->
</div>
<!-- /.container-fluid -->