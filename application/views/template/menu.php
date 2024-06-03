<body>
  <div class="container-scroller d-flex">
    <!-- partial:./partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        <li class="nav-item sidebar-category">
          <p>Course</p>
          <span></span>
        </li>
        <li class="nav-item">
          <a class="nav-link"   data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
            <i class="mdi mdi-view-headline menu-icon"></i>
            <span class="menu-title">Classements</span>
            <i class="menu-arrow"></i>
          </a>
          <div class="collapse" id="ui-basic">
            <ul class="nav flex-column sub-menu">
              <li class="nav-item"> <a class="nav-link"  href="<?php echo site_url('CTE_Classement')?>">Coureur</a></li>
              <li class="nav-item"> <a class="nav-link"  href="<?php echo site_url('CTE_Classement/equipe')?>">Equipe</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link"<?php if (isset($_SESSION['admin'])) { ?>
                      href="<?php echo site_url('CTA_Etape')?>"
                    <?php } else if(!isset($_SESSION['admin'])) { ?>
                      href="<?php echo site_url('CTE_Etape')?>"
                    <?php }?>      >
            <i class="mdi mdi-file-document-box-outline menu-icon"></i>
            <span class="menu-title">Etapes</span>
          </a>
        </li>
      <?php if (isset($_SESSION['admin'])) { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url('CTA_Coureur')?>">
            <i class="mdi mdi-view-quilt menu-icon"></i>
            <span class="menu-title">Participants</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
            <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title">Importation</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('CTA_Import/index1')?>"> Etape & Résultat </a></li>
                <li class="nav-item"> <a class="nav-link" href="<?php echo site_url('CTA_Import/index2')?>"> Points </a></li>            </ul>
            </div>
        </li>
      <?php } ?>
      </ul>
    </nav>
    <!-- partial -->