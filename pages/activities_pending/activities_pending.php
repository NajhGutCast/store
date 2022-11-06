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
    <div class="content">

<!-- Start Content-->
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-4">
      <a href="#" class="btn btn-purple rounded-pill w-md waves-effect waves-light mb-3"><i
          class="mdi mdi-plus"></i> Crear Actividad</a>
    </div>
    <div class="col-sm-8">
      <div class="float-end">
        <form class="row g-2 align-items-center mb-2 mb-sm-0">
          <div class="col-auto">
            <div class="d-flex">
              <label class="d-flex align-items-center">Estado
                <select class="form-select form-select-sm d-inline-block ms-2">
                  <option>Todas las actividades</option>
                  <option>Completas</option>
                  <option>Por Realizar</option>
                  <option>En Marcha</option>
                </select>
              </label>
            </div>
          </div>
          <div class="col-auto">
            <div class="d-flex">
              <label class="d-flex align-items-center">Filtrar
                <select class="form-select form-select-sm d-inline-block ms-2">
                  <option>Fecha</option>
                  <option>Nombre</option>
                  <option>Fecha inicio</option>
                  <option>Fecha fin</option>
                </select>
              </label>
            </div>
          </div>
        </form>
      </div>
    </div><!-- end col-->
  </div>
  <!-- end row -->


  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body project-box">
        <button type="button" class="btn btn-primary rounded-pill waves-effect waves-light float-end">ver mas</button>
        <button class=" btn badge bg-primary float-end btn-light rounded-pill waves-effect">Completo</button>
          <h4 class="mt-0"><a href="" class="text-dark">Realizar validacion de caracteres</a></h4>
          <p class="text-success text-uppercase font-13">LOGIN</p>
          <p class="text-muted font-13">Los caracteres deben de ser una mescla entre numeros letras y simbolos, para obtener una mejor seguridad de su cuenta
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">15</h4>
              <p class="text-muted">Horas</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">5</h4>
              <p class="text-muted">Evidencias</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Programador (es) encargado (s): </h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

            </div>
          </div>

          <h5>Progreso<span class="text-success float-end">80%</span></h5>
          <div class="progress progress-bar-alt-success progress-sm">
            <div class="progress-bar bg-success progress-animated wow animated animated" role="progressbar"
              aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
              style="width: 80%; visibility: visible; animation-name: animationProgress;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>

    </div><!-- end col-->

    <div class="col-xl-4">
      <div class="card">
        <div class="card-body project-box">
          <div class="badge bg-primary float-end">Completed</div>
          <h4 class="mt-0"><a href="" class="text-dark">App Design and Develop</a></h4>
          <p class="text-primary text-uppercase font-13">Android</p>
          <p class="text-muted font-13">New common language will be more simple and regular
            than the existing European languages...<a href="#" class="text-primary">View
              more</a>
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">77</h4>
              <p class="text-muted">Questions</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">875</h4>
              <p class="text-muted">Comments</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Team :</h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-5.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Michael Zenaty">
                <img src="assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="James Anderson">
                <img src="assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

            </div>
          </div>

          <h5>Progress <span class="text-primary float-end">45%</span></h5>
          <div class="progress progress-bar-alt-primary progress-sm">
            <div class="progress-bar bg-primary progress-animated wow animated animated" role="progressbar"
              aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>
    </div><!-- end col-->

    <div class="col-xl-4">
      <div class="card">
        <div class="card-body project-box">
          <div class="badge bg-pink float-end">Completed</div>
          <h4 class="mt-0"><a href="" class="text-dark">Landing page Design</a></h4>
          <p class="text-pink text-uppercase font-13">Web Design</p>
          <p class="text-muted font-13">It will be as simple as occidental in fact it will be
            to an english person it will seem like simplified English...<a href="#" class="text-primary">view
              more</a>
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">87</h4>
              <p class="text-muted">Questions</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">125</h4>
              <p class="text-muted">Comments</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Team :</h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Michael Zenaty">
                <img src="assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="James Anderson">
                <img src="assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Joel Heffner">
                <img src="assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>
            </div>
          </div>


          <h5>Progress <span class="text-pink float-end">68%</span></h5>
          <div class="progress progress-bar-alt-pink progress-sm">
            <div class="progress-bar bg-pink progress-animated wow animated animated" role="progressbar"
              aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>
    </div><!-- end col-->
  </div>
  <!-- end row -->


  <div class="row">

    <div class="col-xl-4">
      <div class="card">
        <div class="card-body project-box">
          <div class="badge bg-purple float-end">Completed</div>
          <h4 class="mt-0"><a href="" class="text-dark">App Design and Develop</a></h4>
          <p class="text-purple text-uppercase font-13">Android</p>
          <p class="text-muted font-13">Everyone realizes why a new common language would be
            desirable one could refuse to pay expensive translators...<a href="#" class="text-primary">view
              more</a>
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">77</h4>
              <p class="text-muted">Questions</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">875</h4>
              <p class="text-muted">Comments</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Team :</h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Michael Zenaty">
                <img src="assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="James Anderson">
                <img src="assets/images/users/user-10.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Joel Heffner">
                <img src="assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>
            </div>
          </div>

          <h5>Progress <span class="text-purple float-end">45%</span></h5>
          <div class="progress progress-bar-alt-purple progress-sm">
            <div class="progress-bar bg-purple progress-animated wow animated animated" role="progressbar"
              aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>

    </div><!-- end col-->

    <div class="col-xl-4">
      <div class="card">
        <div class="card-body project-box">
          <div class="badge bg-danger float-end">Completed</div>
          <h4 class="mt-0"><a href="" class="text-dark">Landing page Design</a></h4>
          <p class="text-danger text-uppercase font-13">Web Design</p>
          <p class="text-muted font-13">At vero eos et accusamus et iusto odio dignissimos
            ducimus qui blanditiis praesentium deleniti...<a href="#" class="text-primary">view more</a>
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">87</h4>
              <p class="text-muted">Questions</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">125</h4>
              <p class="text-muted">Comments</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Team :</h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-6.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Michael Zenaty">
                <img src="assets/images/users/user-7.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="James Anderson">
                <img src="assets/images/users/user-8.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-9.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

            </div>
          </div>

          <h5>Progress <span class="text-danger float-end">68%</span></h5>
          <div class="progress progress-bar-alt-danger progress-sm">
            <div class="progress-bar bg-danger progress-animated wow animated animated" role="progressbar"
              aria-valuenow="68" aria-valuemin="0" aria-valuemax="100" style="width: 68%;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>

    </div><!-- end col-->

    <div class="col-xl-4">
      <div class="card">

        <div class="card-body project-box">
          <div class="badge bg-warning float-end">Completed</div>
          <h4 class="mt-0"><a href="" class="text-dark">New Admin Design</a></h4>
          <p class="text-warning text-uppercase font-13">Web Design</p>
          <p class="text-muted font-13">Their separate existence is a myth. For science,
            music, sport, etc, Europe uses the same vocabulary....<a href="#" class="text-primary">view more</a>
          </p>

          <ul class="list-inline">
            <li class="list-inline-item me-4">
              <h4 class="mb-0">56</h4>
              <p class="text-muted">Questions</p>
            </li>
            <li class="list-inline-item">
              <h4 class="mb-0">452</h4>
              <p class="text-muted">Comments</p>
            </li>
          </ul>

          <div class="project-members mb-2">
            <h5 class="float-start me-3">Team :</h5>
            <div class="avatar-group">
              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Mat Helme">
                <img src="assets/images/users/user-1.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="Michael Zenaty">
                <img src="assets/images/users/user-2.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

              <a href="#" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-placement="top"
                title="James Anderson">
                <img src="assets/images/users/user-3.jpg" class="rounded-circle avatar-sm" alt="friend" />
              </a>

            </div>
          </div>

          <h5>Progress <span class="text-warning float-end">80%</span></h5>
          <div class="progress progress-bar-alt-warning progress-sm">
            <div class="progress-bar bg-warning progress-animated wow animated animated" role="progressbar"
              aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
            </div><!-- /.progress-bar .progress-bar-danger -->
          </div><!-- /.progress .no-rounded -->

        </div>
      </div>
    </div><!-- end col-->
  </div>
  <!-- end row -->

</div> <!-- container-fluid -->

</div> <!-- content -->

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
                      <a id="download_image" class="dropdown-item" href="javascript:void(0);" onclick="">
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
                    <input type="text" id="entry_username" class="form-control" placeholder="Nombre de usuario" required>
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