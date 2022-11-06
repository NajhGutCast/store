<?php
include_once '../../components/session.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <link href="./assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
  <link href="./assets/libs/mohithg-switchery/switchery.min.css" rel="stylesheet" type="text/css" />

  <?php include_once '../../components/styles.php'; ?>

  <title>Usuarios | Activity</title>
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
                  <div class="col-md-3">
                    <button g-cond="hasPermission('users', 'create')" g-else-attr="class: visually-hidden" id="btn_create" type="button" class="btn btn-success waves-effect waves-light my-1 my-md-0">
                      <i class="mdi mdi-plus-circle me-1"></i>
                      Agregar
                    </button>

                  </div><!-- end col-->
                  <div class="col-md-9">
                    <div class="d-flex flex-wrap align-items-center justify-content-sm-end">
                      <label for="column" class="me-2">Buscar por</label>
                      <div class="me-sm-2">
                        <select class="form-select my-1 my-md-0" id="column">
                          <option value="*" selected>Todo</option>
                          <option value="_role">Rol</option>
                          <option value="username">Usuario</option>
                          <option value="lastname">Apellidos</option>
                          <option value="name">Nombres</option>
                          <option value="email">Correo</option>
                          <option value="phone_number">Whatsapp</option>
                        </select>
                      </div>
                      <label for="search" class="visually-hidden">Buscar</label>
                      <div class="me-2">
                        <input type="text" class="form-control my-1 my-md-0" id="search" placeholder="Buscar..." autocomplete="off">
                      </div>
                      <button id="btn_clear_filter" class="btn btn-dark my-1 my-md-0">
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
                <h4 class="header-title float-start">Lista de usuarios</h4>
                <div class="float-end" g-cond="hasPermission('users', 'see_trash')" g-if-attr="class: float-end" g-else-attr="class: visually-hidden">
                  <label for="_switch" class="user-select-none">Mostrar eliminados</label>
                  <input id="_switch" type="checkbox" />
                </div>
              </div>
              <div class="card-body table-responsive">

                <table id="users_table" class="table table-bordered table-bordered dt-responsive wrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Rol</th>
                      <th>Usuario</th>
                      <th>Apellidos</th>
                      <th>Nombres</th>
                      <th>Correo electrónico</th>
                      <th>Whatsapp</th>
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

  <div class="modal fade" id="users_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-header bg-light">
          <h4 class="modal-title" id="myCenterModalLabel">Agregar usuairo</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
        </div>
        <div id="drop_image" class="modal-body">
          <form id="users_form" autocomplete="off">
            <input type="hidden" id="entry_id" value="">
            <div class="row">
              <div class="col-md-6 col-sm-12 text-center text-middle p-2 pt-0 d-md-grid d-sm-unset justify-content-center align-items-center">
                <div>
                  <input type="file" id="entry_image" accept=".jpg, .jpeg, .png, .svg" class="visually-hidden" changed="false">
                  <img id="preview_image" class="avatar-xxl rounded-circle m-2" src="./images/user_not_found.svg" style="background-color: #38414a;object-fit: cover; object-position: center center; cursor: pointer;" onclick="entry_image.click()">
                  <div class="btn-group btn-block m-auto my-2 d-md-block d-sm-unset">
                    <button type="button" class="btn btn-dark rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Opciones <i class="mdi mdi-chevron-down"></i> </button>
                    <div class="dropdown-menu">
                      <a id="watch_image" class="dropdown-item" href="javascript:void(0);" target="_blank">
                        Ver imagen
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="entry_image.click()">
                        Subir imagen
                      </a>
                      <a id="download_image" class="dropdown-item" href="javascript:void(0);" target="_blank">
                        Descargar imagen
                      </a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="onDeleteProfileClicked()">
                        Quitar imagen
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 p-2 pt-0">
                <div class="row">
                  <div class="col-12 mb-2">
                    <label for="entry_username" class="form-label mb-1">Nombre de usuario</label>
                    <input type="text" id="entry_username" class="form-control" placeholder="Nombre de usuario" minlength="4" required>
                  </div>
                  <div class="col-12 mb-2">
                    <label for="entry_password" class="form-label mb-1">Contraseña</label>
                    <div class="input-group input-group-merge">
                      <input type="password" id="entry_password" class="form-control" placeholder="Contraseña" required>
                      <div class="input-group-text hide-password" data-password="false">
                        <span class="password-eye"></span>
                      </div>
                    </div>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="entry__role" class="form-label mb-1">
                      Rol de usuario
                      <a g-cond="hasPermission('roles', 'create')" g-else-attr="class: visually-hidden" href="./roles" target="_blank" title="Agregar rol">
                        <i class="mdi mdi-briefcase-plus"></i>
                        Agregar
                      </a>
                    </label>
                    <div class="input-group">
                      <select class="form-select" id="entry__role" data-width="100%" required></select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="mb-2 col-md-6">
                <label for="entry_dni" class="form-label mb-1">Número de documento</label>
                <input type="text" id="entry_dni" class="form-control" placeholder="Número de documento" required>
              </div>
              <div class="mb-2 col-md-6">
                <label for="entry_lastname" class="form-label mb-1">Apellidos</label>
                <input type="text" id="entry_lastname" class="form-control" placeholder="Apellidos" required>
              </div>
              <div class="mb-2 col-md-6">
                <label for="entry_name" class="form-label mb-1">Nombres</label>
                <input type="text" id="entry_name" class="form-control" placeholder="Nombres" required>
              </div>
              <div class="mb-2 col-md-6">
                <label for="entry_phone_number" class="form-label mb-1">Nro de WhatsApp</label>
                <div class="input-group">
                  <select class="input-group-addon btn btn-dark" id="entry_phone_prefix">
                    <option>51</option>
                  </select>
                  <input type="text" class="form-control" placeholder="Nro de WhatsApp" id="entry_phone_number">
                </div>
              </div>
              <div class="mb-3 col-12">
                <label for="entry_email" class="form-label mb-1">Correo electrónico</label>
                <input type="email" id="entry_email" class="form-control" placeholder="Correo electrónico">
              </div>
            </div>
            <input type="hidden" id="entry_status" value="1">
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
                <button type="button" class="btn btn-danger rounded-pill waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <?php include_once '../../components/scripts.php'; ?>
  <script src="./assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="./assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
  <script src="./assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
  <script src="./assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
  <script src="./assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
  <script src="./assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
  <script src="./assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
  <script src="./assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
  <script src="./assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
  <script src="./assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
  <script src="./assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

  <script src="./crud/users/<?php echo uniqid(); ?>"></script>
  <script src="./script/users/<?php echo uniqid(); ?>"></script>


</body>

</html>