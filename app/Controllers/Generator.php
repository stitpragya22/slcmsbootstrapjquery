<?php

namespace App\Controllers;
use App\Controllers\FontAwaysome;
class Generator extends BaseController
{
    public $name="";
    public $icon="";
    public $Path="";
    public $fixedSelects;
    public $dbSelects;
    public $fields;
    public function index()
    {
        $faicons=FontAwaysome::getAllIcons();
        $html='<html><head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" integrity="sha512-WVPV4X/HI/9wClnD+CxFC0qSDE7blZgqZQLjrnEXQUhkm0nkDcoux3ysgIb3oG74MEHobuvEQg7W3XvZK9ZC/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js" integrity="sha512-E/kDI3wGWMS9Ea/EsDJMduyGSSx/VfdNXAMr/URDQwOAGkGn3uYaZa4Y7bim3ad/6mMA82l+9FxNWl64BR9pkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        </head>
        <body>
        <form method="post" action="'.base_url('Generator/controllergenerate').'">
        <b>Name Of Module without Space</b> :
        <input name="modulename" type="text" >
        <p>
<input type="button" value="Add" onclick="addRow(\'tblClone\');">
<input type="button" value="Remove Last" onclick="delRow(\'tblClone\');">
<select id="moduleicon" class="text-primary fa-select select2 form-control fill" name="moduleicon" style="font-family: \'FontAwesome\', \'sans-serif\';" required>';
                         foreach ($faicons as $key2=>$val2){
                        
                            $html.='<option value="'.$key2.'" > '.$val2.'  '.$key2.' </option>';
                        }
                   $html.='</select>
</p>
<p>Don\'t Put Id we already take it </p>
        <table id="tblClone" border="1">
          <tr>
            <th>The Name Of Column</th>
            <th>SQL type</th>
            <th>html type</th>
            <th>html Required ?</th>
          </tr>
          <tr id="first">
            <th><input type="text" name="col[]" required ></th>
            <th>
            <select name="sqlType[]" required>
            <option value="varchar(255)">Varchar(255)</option>
            <option value="text">Text</option>
            <option value="bigint">BigINt</option>
            <option value="int(255)">Int</option>
            </select>
            </th>
            <th>
            <select name="htmlType[]" onchange="getHtml(this);" required >
            <option value="text">Text</option>
            <option value="textarea">TextArea</option>
            <option value="number">Number</option>
            <option value="image">Image</option>
            <option value="file">File</option>
            <option value="fixedselect">Fixed select</option>
            <option value="dbselect">Model select</option>
            </select>
            </th>
            <th>
            <select name="htmlRequired[]" required>
            <option value="required">Yes</option>
            <option value="">No</option>
            </select>
            </th>
          </tr>
          
        </table>
        <input type="submit" value="Save">
        </form>
        <script>
        document.getElementById("moduleicon").select2();
        function addRow(id)
    { var x=document.getElementById(id).tBodies[0];  //get the table
      var node=x.rows[1].cloneNode(true);    //clone the previous node or row
      x.appendChild(node);   //add the node or row to the table
    }  

    function delRow(id)
    { var x=document.getElementById(id).tBodies[0]; //get the table
      var len=x.rows.length;
      if(len>2)
      x.deleteRow(len-1); //delete the last row
    }

    function getHtml(sel){
        var parent=sel.parentElement;
        if(sel.value=="fixedselect"){
        const node = document.createElement("textarea");
        node.name = "fixedselect"+sel.name;
        parent.appendChild(node);
        }
        else if(sel.value=="dbselect"){
        const node = document.createElement("input");
        node.type="text";
        node.name = "dbselect"+sel.name;
        parent.appendChild(node);
        }
        else{
             var count = parent.childElementCount;
            //  alert(count);
             if(count>1)
             {
                 parent.removeChild(parent.lastChild);
             }
        }
    }
        </script>
        </body>
        </html>
        ';
        return $html;
        
    }
    
    public function Settings()
    {
        $faicons=FontAwaysome::getAllIcons();
        $html='
        <html><head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.css" integrity="sha512-WVPV4X/HI/9wClnD+CxFC0qSDE7blZgqZQLjrnEXQUhkm0nkDcoux3ysgIb3oG74MEHobuvEQg7W3XvZK9ZC/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.0/select2.min.js" integrity="sha512-E/kDI3wGWMS9Ea/EsDJMduyGSSx/VfdNXAMr/URDQwOAGkGn3uYaZa4Y7bim3ad/6mMA82l+9FxNWl64BR9pkw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        </head>
        <body>
        <form method="post" action="'.base_url('Generator/Settingsgenerate').'">
        <b>Name Of Settings Module without Space</b> :
        <input name="modulename" type="text" >
<p>Don\'t Put Id we already take it </p>
        <p>
<select id="moduleicon" class="text-primary fa-select select2 form-control fill" name="moduleicon" style="font-family: \'FontAwesome\', \'sans-serif\';" required>';
                         foreach ($faicons as $key2=>$val2){
                        
                            $html.='<option value="'.$key2.'" > '.$val2.'  '.$key2.' </option>';
                        }
                   $html.='</select>
</p>
        
        <input type="submit" value="Save">
        </form>
       </body>
       </html>
        ';
        return $html;
        
    }
     public function controllergenerate()
     {
         $formFieldsR=[];
         if(isset($_REQUEST))
         {
             var_dump($_POST);
            //  die();
          $name=ucfirst($_POST['modulename']);
          $this->name=ucfirst($_POST['modulename']);
          $this->icon=str_replace("fa-","",$_POST['moduleicon']);
          
          $this->Path=base_url('uploads/'.strtolower($name));
          $cnt1=count($_POST['col']);
          $cols=$_POST['col'];
          $sqlTypes=$_POST['sqlType'];
          $htmlTypes=$_POST['htmlType'];
          if(isset($_POST['fixedselecthtmlType']))
          $fixedSelecthtmlTypes=$_POST['fixedselecthtmlType'];
          
          if(isset($_POST['dbselecthtmlType']))
          $dbSelecthtmlTypes=$_POST['dbselecthtmlType'];
          
          $htmlRequireds=$_POST['htmlRequired'];
          var_dump($cnt1);
          $sj=0;
          $dbj=0;
          for ($k=0; $k<$cnt1;$k++)
          {
              if($htmlTypes[$k]=="dbselect"){
                  $options=explode(',',$dbSelecthtmlTypes[$dbj]);
              $formFieldsR[$cols[$k]]=[$sqlTypes[$k],'NOT NULL',$htmlTypes[$k], $htmlRequireds[$k], $options];
              $dbj++;
              }
              elseif($htmlTypes[$k]=="fixedselect"){
                  $options=explode(',',$fixedSelecthtmlTypes[$sj]);
              $formFieldsR[$cols[$k]]=[$sqlTypes[$k],'NOT NULL',$htmlTypes[$k], $htmlRequireds[$k], $options];
              $sj++;
              }
              else{
                 
              $formFieldsR[$cols[$k]]=[$sqlTypes[$k],'NOT NULL',$htmlTypes[$k], $htmlRequireds[$k]];    
              }
          }
          
          echo"<pre>";
          var_dump($formFieldsR);
        //   die("</pre>");
         }
         $db = \Config\Database::connect();

         $name="Exam";
         
         $fields=[
             'name'=>['varchar(255)','NOT NULL','text','required'],
             'phone'=>['bigint','NOT NULL','number','required'],
             'school'=>['text','NOT NULL','textarea','required'],
             'std'=>['int','NOT NULL','fixedselect','required',[7=>'7th',8=>'8th']],
            //  'job'=>['int','NOT NULL','dbselect','required',['model'=>'JobPost','key'=>'id','label'=>'title']],
             'profile_pic'=>['varchar(255)','NOT NULL','image','required'],
             ];
        if(isset($_REQUEST)){
         $fields=$formFieldsR;
         $name=ucfirst($_POST['modulename']);
        }
        $this->name=$name;
        $this->Path=base_url('uploads/'.strtolower($name));
        $this->fields=$fields;
        $q1="CREATE TABLE `".strtolower($name)."` (
  `id` int(255) NOT NULL AUTO_INCREMENT,";
  $modelKeys="  'id' , ";
  $storeFileds='';
  $fieldVariables='';
  $imageFields=[];
  $uploadFields=[];
  $SelectDBModels='';
  $SelectDBModelsData='';
//   $fixedSelects=[];
  $formFields='';
  $tableFields='';
  $tableHeads='';
  foreach ($fields as $key=>$field)
  {
      $modelKeys.=" '".$key."' , ";
      if($field[2]!='image'&& $field[2]!='file')
      $storeFileds.=' "'.$key.'" => $this->request->getVar("'.$key.'") , 
      ';
      
      if($field[2]=='image')
      $imageFields[]=$key;
      
      if($field[2]=='file')
      $uploadFields[]=$key;
      
      if($field[2]=='fixedselect')
      {
          echo "Fixedfields dumped";
          var_dump($field);
        //   die();
          $this->fixedSelects[$key]=$field[4];
          $tableFields.='
      <td><?=$'.$key.'s[$record["'.$key.'"]]?></td>';
      }
      if($field[2]=='dbselect')
     { 
         echo "DBfields dumped";
          var_dump($field);
        //   die();
         
        $this->dbSelects[$key]=$field[4];
        $model=$field[4][0];
        $label=$field[4][2];
        $key1=$field[4][1];
        $SelectDBModels.="use App\Models".'\\'.$model."
        ;";
        $SelectDBModelsData.='
        $model=new '.$model.'();
        $'.strtolower($model).'s=$model->findAll();
        $'.strtolower($model).'2=[];
        foreach ($'.strtolower($model).'s as $'.strtolower($model).')
        $'.strtolower($model).'2[$'.strtolower($model).'[\''.$key1.'\']]=$'.strtolower($model).'[\''.$label.'\'];
        
        $data[\''.strtolower($model).'s\']=$'.strtolower($model).'2;
        
        ';
        $tableFields.='
      <td><?=$'.strtolower($model).'s[$record["'.$key.'"]]?></td>';
     }
      var_dump($this->fixedSelects);
      $tableHeads.='
      <th>'.ucfirst($key).'</th>';
      
      if($field[2]!='dbselect' && $field[2]!='fixedselect' &&
      $field[2]!='image' && $field[2]!='file'
      )
     { $tableFields.='
      <td><?=$record["'.$key.'"]?></td>';
     }
      
      $formFields.=$this->getField($key,$field[2],$field[3]);
      
      $fieldVariables.='
      $'.$key.'=(isset($CurrentRecord))?$CurrentRecord["'.$key.'"]:"";
      ';
      
      if($field[2]=="image"||$field[2]=="file")
      {
        
        $path = "uploads/".strtolower($name).'s/';
      
        if($field[2]=="image")
        $tableFields.='
      <td><img style="height:150px;" src="<?=base_url(\''.$path.'\')?>\<?=$record["'.$key.'"]?>"</td>';
      
        if($field[2]=="file")
        $tableFields.='
      <td><a href="<?=base_url(\''.$path.'\')?>\<?=$record["'.$key.'"]?>" > Download File </a></td>';
      
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
      }
      
      $q1.="`".$key."` $field[0]  $field[1] , ";
  }
  $uploadFieldshtml='';
  if(count($imageFields)>0)
  {
    //   $target_dir="uploads/".strtolower($name)."s";
      foreach ($imageFields as $ik=>$iv)
      {
          $uploadFieldshtml.='
          
          $target_dir="uploads/'.strtolower($name)."s".'";
            $size=500000*100;
            $file=$_FILES[\''.$iv.'\'];
            $uploadResult=$this->checkAndUploadImage($file, $target_dir, $size);
            $uploadOk=$uploadResult[\'uploadOk\'];
            if($uploadOk==1){
                $data[\''.$iv.'\']=$uploadResult[\'filename\'];
            }
            else{
                if($id==0)
                {
                    session()->setFlashdata("message", "The '.$iv.' is Must For New '.$name.' ");
                     return redirect()->back()->withInput();
                }
                else{
                    if(($_FILES[\''.$iv.'\'][\'tmp_name\'])!="")
                    {
                        
                    session()->setFlashdata("message", "The '.$iv.' is Invalid");
                     return redirect()->back()->withInput();
                    }
                }
            }
          ';
      }
      
      
  }
  if(count($uploadFields)>0){
      foreach ($uploadFields as $ik=>$iv)
      {
          $uploadFieldshtml.='
          
          $target_dir="uploads/'.strtolower($name)."s".'";
            $size=500000*100;
            $file=$_FILES[\''.$iv.'\'];
            $uploadResult=$this->checkAndUploadFile($file, $target_dir, $size);
            $uploadOk=$uploadResult[\'uploadOk\'];
            if($uploadOk==1){
                $data[\''.$iv.'\']=$uploadResult[\'filename\'];
            }
            else{
                if($id==0)
                {
                    session()->setFlashdata("message", "The '.$iv.' is Must For New '.$name.' ");
                     return redirect()->back()->withInput();
                }
                else{
                    if(($_FILES[\''.$iv.'\'][\'tmp_name\'])!="")
                    {
                        
                    session()->setFlashdata("message", "The '.$iv.' is Invalid");
                     return redirect()->back()->withInput();
                    }
                }
            }
          ';
      }
  }
  
  $q1.=" PRIMARY KEY (id) )ENGINE=InnoDB DEFAULT CHARSET=utf8;";
  var_dump($modelKeys);
  var_dump($q1); 
  $query   = $db->query($q1);
// $results = $query->error();
//   var_dump($results);
//   die();
        

         echo "Testing Controller Generation";
         $url = 'public/templates/controller/Controller.html';
         $html = file_get_contents($url);
         $html2= str_replace("{ClassName}",$name.'Controller',$html);
         $controller= str_replace("{ModelClassName}",$name.'Model',$html2);
         $controller= str_replace("{StoreFields}",$storeFileds,$controller);
         $controller= str_replace("{UploadFields}",$uploadFieldshtml,$controller);
         $controller= str_replace("{Name}",$name,$controller);
         $controller= str_replace("{folder}",strtolower($name),$controller);
         $controller= str_replace("{SelectDBModels}",$SelectDBModels,$controller);
         $controller= str_replace("{SelectDBModelsData}",$SelectDBModelsData,$controller);
         
         $url = 'public/templates/model/Model.html';
         $html = file_get_contents($url);
         $model= str_replace("{ClassName}",$name.'Model',$html);
         $model= str_replace("{Fields}",$modelKeys,$model);
         $model= str_replace("{TableName}",strtolower($name),$model);
         
         
         $url = 'public/templates/view/View.html';
         $html = file_get_contents($url);
         $view= str_replace("{FormFields}",$formFields,$html);
         $view= str_replace("{Name}",$name,$view);
         $view= str_replace("{fieldVariables}",$fieldVariables,$view);
         $view= str_replace("{TableHeads}",$tableHeads,$view);
         $view= str_replace("{TableFields}",$tableFields,$view);
         
         
        
        
        file_put_contents('app/Controllers/'.$name.'Controller.php', $controller);
        
        file_put_contents('app/Models/'.$name.'Model.php', $model);
        
        
        
        
        
        $menu='$menu[\''.$this->name.'\'] =[
				        \'label\'=>\''.$this->name.'\',
				        \'icon\'=>\''.$this->icon.'\',
				        \'submenu\'=>false,
				            ];
                    // {Menu Array}
                    ';
        $url = 'app/Views/layouts/admindash.php';
        $html = file_get_contents($url);
        $menu1= str_replace("// {Menu Array}",$menu,$html);
        file_put_contents('app/Views/layouts/admindash.php', $menu1);
        
        
        
        $route='
        $routes->get("'.$this->name.'", "'.$this->name.'Controller::index");
        $routes->post("'.$this->name.'", "'.$this->name.'Controller::Store");
        //
        // {New Admin Routes}';
        
        $url = 'app/Config/Routes.php';
        $html = file_get_contents($url);
        $route1= str_replace("// {New Admin Routes}",$route,$html);
        file_put_contents('app/Config/Routes.php', $route1);
        
        
        $path = "app/Views/admin/".strtolower($name);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        
        file_put_contents($path.'/add_edit.php', $view);
        
        return redirect()->to(base_url('admin/'.$this->name));
         
     }
     
     public function Settingsgenerate()
     {
        //  die('ok');
        
        
        
        $db = \Config\Database::connect();
         $name=$this->request->getVar('modulename');
         $this->icon=str_replace("fa-","",$_POST['moduleicon']);
         var_dump($name);
         
         
         $path = "uploads/settings/".strtolower($name);
        
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
         
         $classname=$name.'SettingsController';
         $modelname=$name.'SettingsModel';
         $pathname=strtolower($name);
         $tablename=$pathname.'settings';
         $q1="CREATE TABLE `".$tablename."` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `type` enum('text','textarea','image','number','flaticons','dbmodel','fixedSelect') NOT NULL,
  `hint` text NOT NULL,
  `jsondata` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$query   = $db->query($q1);
    $q1="ALTER TABLE `".$tablename."`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);";
  $query   = $db->query($q1);
  $q1="ALTER TABLE `".$tablename."`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;";
  $query   = $db->query($q1);
    echo "Generating Controller";
    $url = 'templates/controller/SettingsController.html';
    $html = file_get_contents($url);
    $html2= str_replace("{ClassName}",$classname,$html);
    $controller= str_replace("{ModelClassName}",$modelname,$html2);
    $controller= str_replace("{PathName}",$pathname,$controller);
    file_put_contents('../app/Controllers/'.$classname.'.php', $controller);
    
    echo "<br>Generating Model";
    $url = 'templates/model/SettingsModel.html';
    $html = file_get_contents($url);
    $html2= str_replace("{TableName}",$tablename,$html);
    $model= str_replace("{ModelClassName}",$modelname,$html2);
    file_put_contents('../app/Models/'.$modelname.'.php', $model);
    
    
    $path = "../app/Views/admin/settings";
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        
    echo "<br>Generating View";
    $url = 'templates/view/SettingsView.html';
    $html = file_get_contents($url);
    $view= str_replace("{PathName}",$pathname,$html);
    // $model= str_replace("{ModelClassName}",$modelname,$html2);
    file_put_contents('../app/Views/admin/settings/'.$pathname.'.php', $view);
    
    echo "<br>Generating Routes";
    $route='$routes->get("settings/'.$pathname.'", "'.$classname.'::index");
    $routes->post("settings/'.$pathname.'", "'.$classname.'::store");
    //
    // {New Admin Settings Routes}';
        
        $url = '../app/Config/Routes.php';
        $html = file_get_contents($url);
        $route1= str_replace("// {New Admin Settings Routes}",$route,$html);
        file_put_contents('../app/Config/Routes.php', $route1);
        
    
    echo "<br>Generating MENU";
        
        
    $menu='$settings_menu[\''.$pathname.'\']=[
				        \'label\'=>\''.$name.' Settings\',
				        \'icon\'=>\''.$this->icon.'\',
				        \'submenu\'=>false,
				            ];
                    // {Settings Menu Array}
                    ';
        $url = '../app/Views/layouts/admindash.php';
        $html = file_get_contents($url);
        $menu1= str_replace("// {Settings Menu Array}",$menu,$html);
        file_put_contents('../app/Views/layouts/admindash.php', $menu1);
        
        return redirect()->to(base_url('admin/settings/'.$pathname)); 
     }
     
     public function getFixedSelectOptions($key,$v1=-1)
     {
        //  var_dump($key);
        //  var_dump($this->fixedselects[$key]);
         $html='<option value="">Please Select '.strtoupper($key).'</option>';
         
         $html.='
        <?php $'.$key.'s ='.$this->serializeforSelect($this->fixedSelects[$key]).';  foreach($'.$key.'s as $key=>$val){?>
        <option value="<?=$key?>" <?=($key==$'.$key.')?\'selected\':""?> ><?=$val?></option>
        <?php }?>';
         
         return $html;
     }
     
     public function getDbSelectOptions($key,$v1=-1)
     {
         var_dump($key);
          $model=$this->fields[$key][4][0];
         var_dump($model);
        
         $selctOptions='$'.strtolower($model).'s';
         
         
        //  var_dump($key);
        //  var_dump($this->fixedselects[$key]);
         $html='<option value="">Please Select '.strtoupper($key).'</option>';
         
         $html.='
        <?php  foreach($'.strtolower($model).'s as $key=>$val){?>
        <option value="<?=$key?>" <?=($key==$'.$key.')?\'selected\':""?> ><?=$val?></option>
        <?php }?>';
         
         return $html;
     }
     public function serializeforSelect($selects)
     {
         $options='[';
         foreach ($selects as $sk=>$sv){
         $options.=" '".$sk."'=>";
         $options.="'".$sv."' , ";
         }
         $options.=']';
         return $options;
     }
     
     public function getField($key,$type,$required)
     {
         var_dump($type);
         $html='';
         switch ($type) {
             case 'text':
             case 'number':
             case 'email':
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            <input id="'.$key.'" name="'.$key.'" type="'.$type.'" class="form-control" value="<?=old(\''.$key.'\',$'.$key.')?>" '.$required.'>
          </div>
          ';
                 break;
                 
             case 'textarea':
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            <textarea id="'.$key.'" name="'.$key.'" type="text" class="form-control"  '.$required.' ><?=old("'.$key.'",$'.$key.')?></textarea>
          </div>
          ';
                 break;
            
            case 'fixedselect':
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            <select id="'.$key.'" name="'.$key.'" type="text" class="form-control"  '.$required.' >'.
            $this->getFixedSelectOptions($key,'$'.$key)
            .'</select>
          </div>
          ';
                 break;
             case 'dbselect':
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            <select id="'.$key.'" name="'.$key.'" type="text" class="form-control"  '.$required.' >'.
            $this->getDbSelectOptions($key,'$'.$key)
            .'</select>
          </div>
          ';
                 break;
             case 'image':
                 
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            
        <? if(isset($CurrentRecord)){ ?>
        <input id="'.$key.'" name="'.$key.'" type="file" class="form-control" value="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>" >
        <img src="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>" class="w-100" />
        <? } else {?>
        <input id="'.$key.'" name="'.$key.'" type="file" class="form-control" value="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>" '.$required.'>
        <?php } ?>
          </div>
          ';
                 break;
            
            case 'file':
                 
                 // code...
                 $html.='
          <div class="form-group col-md-6 mb-3">
            <label for="'.$key.'" class="control-label mb-1">'.ucfirst($key).' </label>
            
        <? if(isset($CurrentRecord)){ ?>
        <input id="'.$key.'" name="'.$key.'" type="file" class="form-control" value="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>" >
        <p><a href="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>"> Download </a></p>
        <? } else {?>
        <input id="'.$key.'" name="'.$key.'" type="file" class="form-control" value="<?=base_url(\'uploads/'.strtolower($this->name).'s/\'.$'.$key.')?>" '.$required.'>
        <?php } ?>
          </div>
          ';
                 break;
            
             
             default:
                 // code...
                 break;
         }
        
         var_dump($html);
         return $html;
         
     }
}