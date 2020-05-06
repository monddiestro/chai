</div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>&copy; Cerritos Height Homeowners Association Inc. All Rights Reserved. 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a href="<?php echo base_url('account/signout/') ?>" class="btn btn-primary">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Unit Modal -->
  <div class="modal fade" id="unitModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
    <?php echo form_open(base_url('admin/new_unit/')) ?>
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="unitModalLabel">New Unit</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="number">No. #</label>
                <input type="text" name="number" class="form-control" id="number" aria-describedby="numberHelp" placeholder="Enter unit number" required>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" name="type" class="form-control" aria-describedby="typeHelp" placeholder="Enter unit type">
            </div>
            <div class="form-group">
                <label for="address">Type</label>
                <input type="text" name="address" class="form-control" id="address" aria-describedby="addressHelp" placeholder="Enter unit address" required>
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

  <!-- Members Modal -->
  <div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
        <?php echo form_open_multipart(base_url('admin/new_member/')) ?>
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New Member Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="unit_id" value="" name="unit_id">
                <div class="form-group">
                    <img style="width:200px; height:auto" class="imagePreview" src="<?php echo base_url('src/img/no-profile-image.png') ?>" name="image" alt="profile picture" class="img-thumbnail">
                    <br/>
                    <br/>
                    <label class="btn btn-light">
                        <input type="file" name="user_image" accept="image/*" style="display:none;" data-error-msg="Please place your image here.">
                        Browse ...
                    </label>
                </div>
                <div class="form-group">
                    <label for="type">Member Type</label>
                    <select name="type" class="selectpicker form-control" title="Ex. Owner">
                        <option value="1">Owner</option>
                        <option value="2">Member</option>
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
                    <label for="phone">Phone #</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Ex. 021234567">
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile #</label>
                    <input type="number" name="mobile" class="form-control" id="mobile" placeholder="Ex. 091234567890">
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

  <!-- Work Modal -->
  <div class="modal fade" id="newWorkModal" tabindex="-1" role="dialog" aria-labelledby="unitModalLabel" aria-hidden="true">
        <?php echo form_open(base_url('admin/new_work/')) ?>
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="unitModalLabel">New Work Information</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                  <label for="type">Work Title</label>
                  <input type="text" class="form-control" placeholder="Ex. Cabin Cleaner" name="title" required/>
                </div>
                <div class="form-group">
                  <label for="type">Work Description</label>
                  <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Ex. Carry linens, towels, toilet items, and cleaning supplies, using wheeled carts."></textarea>
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


  