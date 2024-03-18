<?php

    $SubmitUrl= base_url('LinksController/store');   
    

      $title=(isset($CurrentRecord))?$CurrentRecord["title"]:"";
      
      $link=(isset($CurrentRecord))?$CurrentRecord["link"]:"";
      
      $description=(isset($CurrentRecord))?$CurrentRecord["description"]:"";
      
      $image=(isset($CurrentRecord))?$CurrentRecord["image"]:"";
      
      $status=(isset($CurrentRecord))?$CurrentRecord["status"]:"";
      

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
                                <strong class="card-name">Admin Links </strong>
                            </div>
                            <div class="card-body">
                                <!-- Credit Card -->
                                <div id="pay-invoice">
                                    <div class="card-body">
                                        <div class="card-name">
                                            <h3 class="text-center">Add / Edit Links </h3>
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
            <label for="link" class="control-label mb-1">Link </label>
            <input id="link" name="link" type="text" class="form-control" value="<?=old('link',$link)?>" required>
          </div>
          
          <div class="form-group col-md-6 mb-3">
            <label for="description" class="control-label mb-1">Description </label>
            <input id="description" name="description" type="text" class="form-control" value="<?=old('description',$description)?>" required>
          </div>
          
          <div class="form-group col-md-6 mb-3">
            <label for="image" class="control-label mb-1">Image </label>
            
        <?php if(isset($CurrentRecord)){ ?>
        <input id="image" name="image" type="file" class="form-control" value="<?=base_url('uploads/linkss/'.$image)?>" >
        <img src="<?=base_url('uploads/linkss/'.$image)?>" class="w-100" />
        <?php } else {?>
        <input id="image" name="image" type="file" class="form-control" value="<?=base_url('uploads/linkss/'.$image)?>" required>
        <?php } ?>
          </div>
          
          <div class="form-group col-md-6 mb-3">
            <label for="status" class="control-label mb-1">Status </label>
            <select id="status" name="status" type="text" class="form-control"  required ><option value="">Please Select STATUS</option>
        <?php $statuss =[ '0'=>'No' ,  '1'=>'Yes' , ];  foreach($statuss as $key=>$val){?>
        <option value="<?=$key?>" <?=($key==$status)?'selected':""?> ><?=$val?></option>
        <?php }?></select>
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
                                <strong class="card-title">Data Table For : Links</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            
      <th>Title</th>
      <th>Link</th>
      <th>Description</th>
      <th>Image</th>
      <th>Status</th>
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=1; foreach ($records as $record){?>
                                        <tr>
                                            <td><?=$i++;?></td>
                                            
      <td><?=$record["title"]?></td>
      <td><?=$record["link"]?></td>
      <td><?=$record["description"]?></td>
      <td><img style="height:150px;" src="<?=base_url('uploads/linkss/')?>\<?=$record["image"]?>"</td>
      <td><?=$statuss[$record["status"]]?></td>
                                            
                                            <td><a href="<?=base_url('LinksController/index/'.$record['id'])?>">Edit</a> &nbsp; <a class="deletelink" href="<?=base_url('LinksController/delete/'.$record['id'])?>"  onclick="return confirm('Are you sure you want to delete this item?')">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
</div>
<?= $this->endSection() ?>