<?php
include_once '../../components/session.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <?php include_once '../../components/styles.php'; ?>
  <link href="assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />
  <title>Módulos | Activity</title>
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

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="row justify-content-between">
                  <div class="col-md-3" g-cond="hasPermission('modules', 'create')"
                    g-if-attr="class: col-md-3" g-else-attr="class: visually-hidden">
                    <button id="btn_create" type="button" class="btn btn-sm btn-success waves-effect waves-light my-1 my-md-0" data-bs-toggle="modal" data-bs-target="#modules_modal"><i class="mdi mdi-plus-circle me-1"></i> Agregar </button>

                  </div><!-- end col-->
                  <div class="col-md-8">
                    <div class="d-flex flex-wrap align-items-center justify-content-sm-end">
                      <label for="column" class="me-2">Buscar por</label>
                      <div class="me-2">
                        <select class="form-select form-select-sm my-1 my-md-0" id="column">
                          <option value="*" selected>Todo</option>
                          <option value="module">Módulo</option>
                          <option value="correlative">Servicio</option>
                          <option value="description">Descripción</option>
                          <option value="repository">Repositorio</option>
                        </select>
                      </div>
                      <label for="search" class="visually-hidden">Buscar</label>
                      <div class="me-2">
                        <input type="text" class="form-control form-control-sm my-1 my-md-0" id="search" placeholder="Buscar..." autocomplete="off">
                      </div>
                      <button id="btn_clear_filter" class="btn btn-sm btn-dark my-1 my-md-0">
                        <i class="fas fa-broom"></i>
                      </button>
                    </div>
                  </div>
                </div> <!-- end row -->
              </div>
            </div> <!-- end card -->
          </div><!-- end col-->
        </div>
        <!-- end row -->

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="header-title float-start">Lista de módulos</h4>
                <div class="float-end" g-cond="hasPermission('models', 'see_trash')" 
                    g-if-attr="class: float-end" g-else-attr="class: visually-hidden">
                  <label for="_switch" class="user-select-none">Mostrar eliminados</label>
                  <input id="_switch" type="checkbox" />
                </div>
              </div>
              <div class="card-body table-responsive">

                <table id="modules_table" class="table table-bordered table-bordered dt-responsive wrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Módulo</th>
                      <th>Servicio</th>
                      <th>Descripción</th>
                      <th>Estado</th>
                      <th>Acción</th>
                    </tr>
                  </thead>
                  <tbody></tbody>
                </table>
              </div>
            </div>

          </div>
        </div>

      </div> <!-- container -->

      <!-- Footer Start -->
      <?php include_once '../../components/footer.php'; ?>
      <!-- end Footer -->

    </div>
  </div>

  <div class="modal fade" id="modules_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h4 class="modal-title" id="myCenterModalLabel">Agregar módulo</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div class="modal-body">
          <form id="modules_form" class="row">
            <input type="hidden" id="entry_id" value="">
            <div class="col-md-6 col-xs-12 mb-2">
              <label for="entry_module" class="form-label mb-0">Nombre del módulo</label>
              <input type="text" id="entry_module" class="form-control" placeholder="Ej. Cotizaciones" required>
            </div>
            <div class="col-md-6 col-xs-12 mb-2">
              <label for="entry_correlative" class="form-label mb-0">Nombre del servicio</label>
              <input type="text" id="entry_correlative" class="form-control" placeholder="Ej. cotizador-general-service" required>
            </div>
            <div class="col-12 mb-2">
              <label for="entry_description" class="form-label">Descripción de la vista</label>
              <textarea class="form-control" id="entry_description" rows="3" placeholder="Ingrese una descripción"></textarea>
            </div>
            <div class="col-12 mb-3">
              <label for="entry_repository" class="form-label mb-0">URI del repositorio</label>
              <input type="text" id="entry_repository" class="form-control" placeholder="https://...">
            </div>
            <input type="hidden" id="entry_status" value="1">

            <div class="col-12 text-center">
              <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
              <button type="button" class="btn btn-danger rounded-pill waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php include_once '../../components/scripts.php'; ?>
  <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
  <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
  <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
  <script src="./assets/libs/mohithg-switchery/switchery.min.js"></script>
  <script src="./crud/modules/<?php echo uniqid(); ?>"></script>
  <script src="./script/modules/<?php echo uniqid(); ?>"></script>


</body>

</html>