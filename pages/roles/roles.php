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
    <title>Roles y permisos | Activity</title>
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
                                    <div class="col-md-4">
                                        <button id="btn_create" type="button" class="btn btn-success waves-effect waves-light my-1 my-md-0"><i class="mdi mdi-plus-circle me-1"></i> Agregar </button>

                                    </div><!-- end col-->
                                    <div class="col-md-8">
                                        <div class="d-flex flex-wrap align-items-center justify-content-sm-end">
                                            <label for="column" class="me-2">Buscar por</label>
                                            <div class="me-sm-2">
                                                <select class="form-select my-1 my-md-0" id="column">
                                                    <option value="*" selected>Todo</option>
                                                    <option value="permission">Permiso</option>
                                                    <option value="correlative">Correlativo</option>
                                                    <option value="_view">Vista</option>
                                                    <option value="description">Descripción</option>
                                                </select>
                                            </div>
                                            <label for="search" class="visually-hidden">Buscar</label>
                                            <div>
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
                                <h4 class="header-title float-start">Lista de vistas</h4>
                                <div class="float-end">
                                    <label for="_switch" class="user-select-none">Mostrar eliminados</label>
                                    <input id="_switch" type="checkbox" />
                                </div>
                            </div>
                            <div class="card-body table-responsive">

                                <table id="roles_table" class="table table-bordered table-bordered dt-responsive wrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Rol</th>
                                            <th>Prioridad</th>
                                            <th>Permisos</th>
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

    <div class="modal fade" id="roles_modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h4 class="modal-title" id="myCenterModalLabel">Agregar rol</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body">
                    <form id="roles_form" class="row">
                        <input type="hidden" id="entry_id" value="">
                        <div class="col-md-6 col-xs-12 mb-2">
                            <label for="entry_role" class="form-label mb-0">Nombre del rol</label>
                            <input type="text" id="entry_role" class="form-control" placeholder="Ej. Rol">
                        </div>
                        <div class="col-md-6 col-xs-12 mb-2">
                            <label for="entry_priority" class="form-label mb-0">Prioridad del rol</label>
                            <input type="number" id="entry_priority" class="form-control" placeholder="Ej. Prioridad" g-attr="min:__role.priority__">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="entry_description" class="form-label">Descripción del rol</label>
                            <textarea class="form-control" id="entry_description" rows="3" placeholder="Ingrese una descripción"></textarea>
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

    <div class="modal fade" id="permissions_modal" tabindex="5" role="dialog" aria-labelledby="scrollableModalTitle" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <form id="permissions_form" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scrollableModalTitle">Gestión de permisos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-0">
                    <input type="hidden" id="permission_rol_id" value="0">
                    <div id="permissions_container" class="row"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light">Guardar</button>
                    <button type="button" class="btn btn-danger rounded-pill waves-effect waves-light" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    <script src="./assets/libs/mohithg-switchery/switchery.min.js"></script>
    <script src="./assets/libs/tippy.js/tippy.all.min.js"></script>

    <script src="./extra/roles/<?php echo uniqid(); ?>"></script>
    <script src="./crud/roles/<?php echo uniqid(); ?>"></script>
    <script src="./script/roles/<?php echo uniqid(); ?>"></script>


</body>

</html>