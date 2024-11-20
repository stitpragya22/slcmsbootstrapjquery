<?php

    $SubmitUrl= base_url('TestingController/store');   
    

      $title=(isset($CurrentRecord))?$CurrentRecord["title"]:"";
      

?>

<?= $this->extend("layouts/admindash") ?>

<?= $this->section("body") ?>
<div class="row">
    
    <?php if(session()->get('message')!=""){?>
    <div class="sufee-alert alert with-close alert-success alert-dismissible fade show col-md-12">
        <span class="badge badge-pill badge-<?=session()->get('mtype')?>"><?=session()->get('mtype')?></span>
        <?=session()->get('message')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php } ?>
    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">सभासद यादी </strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table data-table-export table-striped table-bordered ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Registration no</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th>Profile_pic</th>
                                            <th>Phone No</th>
                                            <th>Adhar Card No</th>
                                            <th>Address</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($records as $record){?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            <td><?=$record["registration_no"]?></td>
                                            <td><?=$record["first_name"]?></td>
                                            <td><?=$record["last_name"]?></td>
                                            <td><?=$record["email"]?></td>
                                            <td><?=$record["profile_pic"]?></td>
                                            <td><?=$record["phone_no"]?></td>
                                            <td><?=$record["adhar_card_no"]?></td>
                                            <td><?=$record["address"]?></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
<?= $this->endSection() ?>