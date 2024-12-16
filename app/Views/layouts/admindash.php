<?php

use App\Controllers\ToolsController;

$tools = new ToolsController();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title><?= session()->get('name') ?></title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="<?= base_url('public/assets/backend/mdb5') ?>/css/mdb.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="<?= base_url('public/assets/backend/mdb5') ?>/css/admin.css" />

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css"
    href="<?= base_url('public/assets/backend/mdb5') ?>/vendors/styles/icon-font.min.css">
  <link rel="stylesheet" type="text/css"
    href="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/css/responsive.bootstrap4.min.css">

  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Favicon -->
  <link href="<?= base_url('uploads/profile') ?>/<?= session()->get('profile_pic') ?>" rel="icon">
  <style>
    .dt-buttons .btn {
      padding: 0px 5px;
    }

    .select2-selection__rendered,
    .select2-results__option {
      font-family: FontAwesome, sans-serif;
      /*font-size: 12px;*/
    }

    ::-webkit-scrollbar {
      width: 4px;
    }

    ::-webkit-scrollbar-track {
      box-shadow: inset 0 0 3px grey;
      border-radius: 2px;
    }

    ::-webkit-scrollbar-thumb {
      background: black;
      border-radius: 2px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: rgb(54, 56, 58);
    }
  </style>
</head>

<body>
  <!--Main Navigation-->
  <header>
    <!-- Sidebar Starts-->
    <nav id="sidebarMenu" class="collapse d-lg-block sidebar overflow-auto collapse bg-white">
      <div class="position-sticky ">
        <div class="list-group list-group-flush mx-3 mt-4">
          <?php
          echo '<li class="sidebar-header font-weight-bold">
						Section Manager
					</li>';
          // echo "<p class='text-center text-white border-top border-white'>CRUD Management</p>";
          
          $menu = [];

          $menu[''] = [
            'label' => 'Dashboard',
            'icon' => 'align-left',
            'submenu' => false,
          ];


          // {Menu Array}
          
          ksort($menu);
          foreach ($menu as $mk => $mv) {
            // code...
            if ($mv['submenu'] == false) {
              // var_dump($mv);
              ?>
              <a href="<?= base_url('admin/' . $mk) ?>" class="list-group-item list-group-item-action py-2 ripple"
                aria-current="true">
                <i class="fas fa-<?= $mv['icon'] ?> fa-fw me-3"></i><span><?= $mv['label'] ?></span>
              </a>

            <?php } else {
              ?>
              <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                  <span class="micon dw house-1"></span><span class="mtext"><?= $mv['label'] ?></span>
                </a>
                <ul class="submenu">
                  <li><a href="#">Dashboard style 1</a></li>
                  <li><a href="#">Dashboard style 2</a></li>
                </ul>
              </li>
            <?php }
          }
          // Add the Plugins section
          echo '<li class="sidebar-header font-weight-bold">Plugins</li>';
          // Dynamically generate links for each plugin
          $pluginsPath = FCPATH . 'Plugins/';
          $plugins = array_filter(scandir($pluginsPath), function ($item) use ($pluginsPath) {
            return is_dir($pluginsPath . $item) && !in_array($item, ['.', '..']);
          });
          foreach ($plugins as $plugin) {
            echo '<a href="' . base_url('addons/' . $plugin) . '" class="list-group-item list-group-item-action py-2 ripple plugin-link"><i class="fas fa-plugin"></i>' . $plugin . '</a>';
          }
          echo '<li class="sidebar-header font-weight-bold">
						Other Settings
					</li>';
          $settings_menu = [];

          // {Settings Menu Array}
          

          ksort($settings_menu);

          foreach ($settings_menu as $mk => $mv) {
            // code...
            if ($mv['submenu'] == false) { ?>

              <a href="<?= base_url('admin/settings/' . $mk) ?>" class="list-group-item list-group-item-action py-2 ripple"
                aria-current="true">
                <i class="fas fa-<?= $mv['icon'] ?> fa-fw me-3"></i><span><?= $mv['label'] ?></span>
              </a>

            <?php } else {
              ?>
              <li class="dropdown">
                <a href="javascript:;" class="dropdown-toggle">
                  <span class="micon dw house-1"></span><span class="mtext"><?= $mv['label'] ?></span>
                </a>
                <ul class="submenu">
                  <li><a href="index.html">Dashboard style 1</a></li>
                  <li><a href="index2.html">Dashboard style 2</a></li>
                </ul>
              </li>
            <?php }
          }
          ?>
        </div>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Sidebar Ends-->
    <!-- Navbar -->
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white fixed-top">
      <!-- Container wrapper -->
      <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#sidebarMenu"
          aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <i class="fas fa-bars"></i>
        </button>

        <!-- Brand -->
        <a class="navbar-brand" href="<?= base_url() ?>" target="_blank">
          Visit Website
        </a>

        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex flex-row">

          <!-- Avatar -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
              id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
              <img src="<?= base_url('uploads/profile') ?>/<?= session()->get('profile_pic') ?>" class="rounded-circle"
                height="40" alt="" loading="lazy" />
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="<?= base_url('admin/profile') ?>">My profile</a></li>
              <!--<li><a class="dropdown-item" href="#">Settings</a></li>-->
              <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
      <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main style="margin-top: 100px; margin-bottom:105px; overflow-x:hidden;">
    <?= $this->renderSection('body') ?>
  </main>
  <!--Main layout-->


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Media Library</h5>
          <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php if (isset($allmedia)) { ?>
            <h3>Media List For Audio</h3>
            <input type="hidden" id="myLinkId">
            <?php $needle = ".mp3";
            $needle2 = ".ogg";
            foreach ($allmedia as $media1) {

              if ($tools->endsWith($media1['filename'], $needle) || $tools->endsWith($media1['filename'], $needle2)) {
                ?>
                <?= $media1['title'] ?>
                <audio style="width:150px;height:25px;" controls>
                  <source src="<?= base_url('uploads/medias/' . $media1['filename']) ?>" type="audio/mpeg">
                  Your browser does not support the audio element.
                </audio>
                <span id="setlink" onclick="setlink('<?= base_url('uploads/medias/' . $media1['filename']) ?>')">Click To
                  Insert</span>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <!--MOdal-->

  <!-- MDB -->
  <script type="text/javascript" src="<?= base_url('public/assets/backend/mdb5') ?>/js/mdb.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
  <!-- buttons for Export datatable -->
  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
  <script
    src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/buttons.print.min.js"></script>
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/buttons.flash.min.js"></script>
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/pdfmake.min.js"></script>
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/plugins/datatables/js/vfs_fonts.js"></script>

  <!-- Datatable Setting js -->
  <script src="<?= base_url('public/assets/backend/mdb5') ?>/src/js/datatable-setting.js"></script>


  <!-- Custom scripts -->
  <script type="text/javascript" src="<?= base_url('public/assets/backend/mdb5') ?>/js/admin.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $('.texteditor').summernote({
      placeholder: 'Hello stand alone ui',
      tabsize: 2,
      height: 400,
      toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ]
    });
  </script>
  <script>
    $('.select2').select2();

    var title = document.getElementById('title');
    if (typeof (title) != 'undefined' && title != null) {
      console.log('title found');
      var slug = document.getElementById('slug');
      if (typeof (slug) != 'undefined' && slug != null) {
        title.addEventListener("keyup", function (e) {
          // title.keyup(function(){

          // var title=$('#title').val();
          // console.log(title)
          finalslug = title.value.replace(/ /g, '-');
          finalslug = finalslug.replace(/\?/g, '-');
          finalslug = finalslug.replace(/\&/g, '-');
          console.log(finalslug);
          slug.value = finalslug.toLowerCase();
        });
      }
    }

    function getslug(title) {
      // alert(title.value);
      slug = title.value.replace(/ /g, '-');
      slug = slug.replace(/\?/g, '-');
      slug = slug.replace(/\&/g, '-');
      console.log(slug);
      document.getElementById('slug').value = slug.toLowerCase();

    }
  </script>
  <script>
    setTimeout(function () {
      $('.alert').fadeOut('slow');
    }, 10000);



    $('.close').on('click', function (event) {
      $('.alert').fadeOut('slow');
    });

    function copylink(id) {
      /* Get the text field */
      var copyText = document.getElementById(id);

      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /* For mobile devices */

      /* Copy the text inside the text field */
      navigator.clipboard.writeText(copyText.value);

      /* Alert the copied text */
      alert("Copied the text: " + copyText.value);
    }

    function setlink(source) {
      Input_Id = $('#myLinkId').val();
      $('#' + Input_Id).val(source);
      $('#exampleModal').modal('toggle');
    }

    $('#exampleModal').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) // Button that triggered the modal
      //   var getID = button.data('id')
      //   var getAdd = button.data('adress')
      //   var getCity = button.data('city')
      var getTarget = button.data('link-id')
      var modal = $(this)
      modal.find('#myLinkId').val(getTarget);
      //   modal.find('#Address').text('Address = ' + getAdd + ' , ' + getCity + ' , ' + getPostCode)
    })
  </script>

</body>

</html>