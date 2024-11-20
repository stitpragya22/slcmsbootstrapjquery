<?= $this->extend("layouts/admindash") ?>

<?= $this->section("body") ?>
<div class="row mt-5">
    <?php if(session()->get('message')!=""){?>
    <div class="sufee-alert alert with-close alert-<?=session()->get('mtype')?> alert-dismissible fade show col-md-12">
        <span class="badge badge-pill badge-<?=session()->get('mtype')?>"><?=session()->get('mtype')?></span>
        <?=session()->get('message')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php } ?>
    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Admin Profile</strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Update Admin Profile</h3>
                                        </div>
                                        <hr>
                                        <form action="#" method="post"  autocomplete="off" enctype="multipart/form-data">
                                            
                                            <div class="form-group">
                                                <label for="email" class="control-label mb-1">Email Id</label>
                                                <input id="email" name="email" type="text" class="form-control" value="<?=$admin['email']?>"  required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="phone_no" class="control-label mb-1">Phone No</label>
                                                <input id="phone_no" name="phone_no" type="text" class="form-control" value="<?=$admin['phone_no']?>"  required>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="profile_pic" class="control-label mb-1">Profile Pic</label>
                                                        <input id="profile_pic" name="profile_pic" type="file" class="form-control" >
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <img src="<?=base_url('uploads/profile/'.$admin['profile_pic'])?>" class="w-100" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-6 mb-3">
                                                    <div class="form-group">
                                                        <label for="first_name" class="control-label mb-1">First Name</label>
                                                        <input id="first_name" name="first_name" type="text" class="form-control" value="<?=$admin['first_name']?>"  required>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-3">
                                                    <label for="last_name" class="control-label mb-1">Last Name</label>
                                                    <div class="input-group">
                                                        <input id="last_name" name="last_name" type="text" class="form-control cc-cvc" value="<?=$admin['last_name']?>"  required autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Update</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>
    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Admin Profile</strong>
                            </div>
                            <div class="card-body">
                                
                                <!-- Credit Card -->
                                <div id="pay">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3 class="text-center">Update Admin Password</h3>
                                        </div>
                                        <hr>
                                        <form action="<?=base_url('admin/updatepassword')?>" method="post" autocomplete="off">
                                            <div class="form-group has-success mb-3">
                                                <label for="password" class="control-label mb-1" autocomplete="off" >New Password</label>
                                                <input id="password" name="password" type="password" class="form-control" placeholder="" >
                                            </div>
                                            
                                            <div class="form-group has-success mb-3">
                                                <label for="cpassword" class="control-label mb-1">Confirm New Password</label>
                                                <input id="cpassword" name="cpassword" type="password" class="form-control" >
                                            </div>
                                            
                                            <div>
                                                <button type="submit" class="btn btn-lg btn-info btn-block">
                                                    <i class="fa fa-lock fa-lg"></i>&nbsp;
                                                    <span id="payment-button-amount">Update</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>                
</div>
<?= $this->endSection() ?>