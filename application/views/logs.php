    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Activity Logs</h1>
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
                <div class="card-body">
                    <?php if(empty($activity)): // if empty archive don't render tables ?>
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
                                    <th>Activity</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Activity</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
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
                <?php endif ?>
            </div>
          </div>

<!-- page content close tag -->
</div>
<!-- /.container-fluid -->