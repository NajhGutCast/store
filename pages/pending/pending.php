<?php
include_once '../../components/session.php';
$prepath = '.';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php include_once '../../components/styles.php'; ?>
  <title>Configuración | Activity</title>
  <script>
    let prepath = '.';
  </script>
</head>

<body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "dark", "size": "default", "showuser": true}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>

  <!-- Begin page -->
  <div id="wrapper">


    <!-- Topbar Start -->
    <?php include_once '../../components/header.php'; ?>
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    <?php include_once '../../components/menu.php'; ?>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
      <div class="container-fluid">

      </div> <!-- container -->

      <!-- Footer Start -->
      <?php include_once '../../components/footer.php'; ?>
      <!-- end Footer -->

    </div>
  </div>

  <?php include_once '../../components/scripts.php'; ?>

  <script src="../crud/pending/<?php echo uniqid(); ?>"></script>
  <script src="../script/pending/<?php echo uniqid(); ?>"></script>


</body>

</html>