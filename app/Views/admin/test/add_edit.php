<?php

    $SubmitUrl= base_url('TestController/store');   
    

      $title=(isset($CurrentRecord))?$CurrentRecord["title"]:"";
      
      $slug=(isset($CurrentRecord))?$CurrentRecord["slug"]:"";
      

?>

<?= $this->extend("layouts/admindash") ?>

<?= $this->section("body") ?>
<div class="row">
    
    <?php if(session()->get('message')!=""){?>
    <div class="sufee-alert alert with-close alert-<?=session()->get('mtype')?> alert-dismissible fade show col-md-12">
        <span class="badge badge-pill badge-<?=session()->get('mtype')?>"><?=session()->get('mtype')?></span>
        <?=session()->get('message')?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <?php } ?>
    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-name">Admin Test </strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-name">
                                            <h3 class="text-center">Add / Edit Test </h3>
                                        </div>
                                        <hr>
                                        <form action="<?=$SubmitUrl?>" method="post" class="row" enctype="multipart/form-data">
                                        <?php
                                        if(isset($CurrentRecord)){ ?>
                                        <input type="hidden" name="id" value="<?=$CurrentRecord['id']?>" >
                                        <?php }
                                        ?>
                                            
          <div class="form-group col-md-6 mb-3">
            <label for="title" class="control-label mb-1">Title </label>
            <input id="title" name="title" type="text" class="form-control" value="<?=old('title',$title)?>" required>
          </div>
          
          <div class="form-group col-md-6 mb-3">
            <label for="slug" class="control-label mb-1">Slug </label>
            <input id="slug" name="slug" type="text" class="form-control" value="<?=old('slug',$slug)?>" required>
          </div>
          
                                            
                                            
                                            <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">&nbsp;
                                                    <span id="payment-button-amount"><?=(isset($CurrentRecord))?'UPDATE':'ADD'?></span>
                                                </button>
                                            
                                            <div>
                                                
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div> <!-- .card -->

                    </div>
    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Table For : Test</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            
      <th>Title</th>
      <th>Slug</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($records as $record){?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            
      <td><?=$record["title"]?></td>
      <td><?=$record["slug"]?></td>
                                            
                                            <td><a href="<?=base_url('TestController/index/'.$record['id'])?>">Edit</a> &nbsp; <a class="deletelink" href="<?=base_url('TestController/delete/'.$record['id'])?>"  onclick="return confirm('Are you sure you want to delete this item?')">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
<?= $this->endSection() ?>