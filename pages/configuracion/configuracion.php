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
  <title>Configuración | Activity</title>
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

        <div class="row align-items-center justify-content-center">
          <div class="col-sm-12 col-md-6 col-xxl-4">
            <div class="card">
              <div class="card-body">
                <h4 class="header-title mb-2">Configuración de cuenta</h4>

                <ul class="nav nav-tabs nav-bordered nav-justified">
                  <li class="nav-item">
                    <a href="#account_form" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                      Usuario
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#password_form" data-bs-toggle="tab" aria-expanded="flase" class="nav-link">
                      Contraseña
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#personal_form" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                      Personal
                    </a>
                  </li>
                </ul>
                <div class="tab-content">
                  <form class="tab-pane active" id="account_form" autocomplete="off">
                    <div class="row">
                      <div class="col-md-6 col-sm-12 text-center text-middle p-2 pt-0 d-md-grid d-sm-unset justify-content-center align-items-center">
                        <div>
                          <input type="file" id="entry_image" accept=".jpg, .jpeg, .png, .svg" class="visually-hidden" changed="false">
                          <img id="preview_image" class="avatar-xxl rounded-circle m-2" g-attr="src: ./api/perfil/__id_relativo__/mini; alt: Perfil de __name__;" src="./images/user_not_found.svg" style="background-color: #38414a;object-fit: cover; object-position: center center; cursor: pointer;" onclick="entry_image.click()">
                          <div class="btn-group btn-block m-auto my-2 d-md-block d-sm-unset">
                            <button type="button" class="btn btn-dark rounded-pill dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> Opciones <i class="mdi mdi-chevron-down"></i> </button>
                            <div class="dropdown-menu">
                              <a id="watch_image" class="dropdown-item" href="./images/user_not_found.svg" 
                              g-attr="href: ./api/perfil/__id_relativo__/full"
                              target="_blank">
                                Ver imagen
                              </a>
                              <a class="dropdown-item" href="javascript:void(0);" onclick="entry_image.click()">
                                Subir imagen
                              </a>
                              <a id="download_image" class="dropdown-item" href="./images/user_not_found.svg"
                              g-attr="href: ./api/perfil/__id_relativo__/full; download: __username__.png"
                              target="_blank">
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
                        <div class="row align-items-center justify-content-center">
                          <div class="col-12 mb-3">
                            <label for="entry_username" class="form-label mb-1">
                              Nombre de usuario
                              <code>*</code>
                            </label>
                            <input type="text" id="entry_username" class="form-control" placeholder="Nombre de usuario" minlength="4" g-attr="value: __username__" required>
                          </div>
                          <div class="col-12 mb-3">
                            <label for="entry_password" class="form-label mb-1">
                              Confirmación
                              <code>*</code>
                            </label>
                            <div class="input-group input-group-merge">
                              <input type="password" id="entry_password" class="form-control" placeholder="Contraseña" required>
                              <div class="input-group-text hide-password" data-password="false">
                                <span class="password-eye"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
                          </div>
                        </div>
                      </div>

                    </div>
                  </form>
                  <form class="tab-pane" id="password_form" autocomplete="off">
                    <div class="row align-items-center justify-content-center">
                      <div class="col-12 p-2 pt-0">
                        <div class="row">
                          <div class="col-12 mb-3">
                            <label for="entry_password_new" class="form-label mb-1">
                              Contraseña nueva
                              <code>*</code>
                            </label>
                            <div class="input-group input-group-merge">
                              <input type="password" id="entry_password_new" class="form-control" placeholder="Contraseña" required>
                              <div class="input-group-text hide-password" data-password="false">
                                <span class="password-eye"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 mb-3">
                            <label for="entry_password_confirm" class="form-label mb-1">
                              Repita contraseña nueva
                              <code>*</code>
                            </label>
                            <div class="input-group input-group-merge">
                              <input type="password" id="entry_password_confirm" class="form-control" placeholder="Contraseña" required>
                              <div class="input-group-text hide-password" data-password="false">
                                <span class="password-eye"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 mb-3">
                            <label for="entry_password" class="form-label mb-1">
                              Confirmación
                              <code>*</code>
                            </label>
                            <div class="input-group input-group-merge">
                              <input type="password" id="entry_password" class="form-control" placeholder="Contraseña" required>
                              <div class="input-group-text hide-password" data-password="false">
                                <span class="password-eye"></span>
                              </div>
                            </div>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form class="tab-pane" id="personal_form" autocomplete="off">
                    <div class="row align-items-center justify-content-center">
                      <div class="mb-3 col-md-6">
                        <label for="entry_dni" class="form-label mb-1">
                          DNI
                          <code>*</code>
                        </label>
                        <input type="text" id="entry_dni" class="form-control" placeholder="Número de documento" required g-attr="value: __persona.numerodocumento__" disabled>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="entry_lastname" class="form-label mb-1">
                          Apellidos
                          <code>*</code>
                        </label>
                        <input type="text" id="entry_lastname" class="form-control" placeholder="Apellidos" required g-attr="value: __persona.apellidos__">
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="entry_name" class="form-label mb-1">
                          Nombres
                          <code>*</code>
                        </label>
                        <input type="text" id="entry_name" class="form-control" placeholder="Nombres" required g-attr="value: __persona.nombres__">
                      </div>
                      <div class="mb-3 col-md-6">
                        <label for="entry_phone_number" class="form-label mb-1">Nro de WhatsApp</label>
                        <div class="input-group">
                          <select class="input-group-addon btn btn-dark" id="entry_phone_prefix" g-attr="value: __phone_prefix__">
                            <option>51</option>
                          </select>
                          <input type="text" class="form-control" placeholder="Nro de WhatsApp" id="entry_phone_number" g-attr="value: __phone_number__">
                        </div>
                      </div>
                      <div class="mb-3 col-12">
                        <label for="entry_email" class="form-label mb-1">Correo electrónico</label>
                        <input type="email" id="entry_email" class="form-control" placeholder="Correo electrónico" g-attr="value: __email__">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="entry_password" class="form-label mb-1">
                          Confirmación
                          <code>*</code>
                        </label>
                        <div class="input-group input-group-merge">
                          <input type="password" id="entry_password" class="form-control" placeholder="Contraseña" required>
                          <div class="input-group-text hide-password" data-password="false">
                            <span class="password-eye"></span>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
                      </div>
                    </div>
                  </form>
                </div>
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

  <?php include_once '../../components/scripts.php'; ?>

  <script src="./crud/configuracion/<?php echo uniqid(); ?>"></script>
  <script src="./script/configuracion/<?php echo uniqid(); ?>"></script>


</body>

</html>