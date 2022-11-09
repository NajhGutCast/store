<div class="left-side-menu">

  <div class="h-100" data-simplebar>
    <div class="user-box text-center">
      <img g-attr="src: <?php echo isset($prepath) ? $prepath : null; ?>./api/perfil/__id_relativo__/mini; alt: Perfil de __persona.nombres__;" src="<?php echo isset($prepath) ? $prepath : null; ?>./images/user_not_found.svg" alt="user-img" title="Mat Helme" class="rounded-circle img-thumbnail avatar-md" style="background: transparent; object-fit: cover; object-position: center center;">
      <div class="dropdown">
        <a g-text="__persona.nombres__" href="#" class="user-name dropdown-toggle h5 mt-2 mb-1 d-block" data-bs-toggle="dropdown" aria-expanded="false"></a>
        <div class="dropdown-menu user-pro-dropdown">

          <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-user me-1"></i>
            <span>Mi cuenta</span>
          </a>

          <a href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-settings me-1"></i>
            <span>Configuración</span>
          </a>

          <a id="btn_lock" href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-lock me-1"></i>
            <span>Bloquear pantalla</span>
          </a>

          <a id="btn_logout" href="javascript:void(0);" class="dropdown-item notify-item">
            <i class="fe-log-out me-1"></i>
            <span>Cerrar sesión</span>
          </a>

        </div>
      </div>

      <p g-attr="title: __rol.descripcion__" g-text="__rol.rol__" class="text-muted left-user-info"></p>

      <ul class="list-inline">
        <li class="list-inline-item" title="Configuración">
          <a href="<?php echo isset($prepath) ? $prepath : null; ?>./profile" class="text-muted left-user-info">
            <i class="mdi mdi-cog"></i>
          </a>
        </li>

        <li class="list-inline-item" title="Cerrar sesión">
          <a id="btn_logout" href="javascript:void(0);">
            <i class="mdi mdi-power"></i>
          </a>
        </li>
      </ul>
    </div>

    <!--- Sidemenu -->
    <div id="sidebar-menu">

      <ul id="side-menu">

        <li class="menu-title">Navegación</li>

        <li>
          <a href="<?php echo isset($prepath) ? $prepath : null; ?>./home">
            <i class="mdi mdi-view-dashboard"></i>
            <span> Dashboard </span>
          </a>
        </li>

        <li class="menu-title mt-2">Principal</li>

        <!-- <li g-cond="
          tienePermiso('activities/pending', 'read') ||
          tienePermiso('activities/done', 'read') ||
          tienePermiso('activities/toreview', 'read') ||
          tienePermiso('activities/revised', 'read') ||
          tienePermiso('activities/rejected', 'read') ||
          tienePermiso('activities/billed', 'read')
        " g-else-attr="class: visually-hidden">
          <a href="#menu_activities" data-bs-toggle="collapse">
            <i class="mdi mdi-clipboard"></i>
            <span> Actividades </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="menu_activities">
            <ul class="nav-second-level">
              <li g-cond="tienePermiso('activities/pending', 'read')" g-else-attr="class: visually-hidden">
                <a href="./activityespending">Pendientes</a>
              </li>
              <li g-cond="tienePermiso('activities/done', 'read')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./activities/done">Realizadas</a>
              </li>
              <li g-cond="tienePermiso('activities/toreview', 'read')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./activities/toreview">Para revisar</a>
              </li>
              <li g-cond="tienePermiso('activities/revised', 'read')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./activities/revised">Revisadas</a>
              </li>
              <li g-cond="tienePermiso('activities/rejected', 'read')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./activities/rejected">Rechazadas</a>
              </li>
              <li g-cond="tienePermiso('activities/billed', 'read')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./activities/billed">Facturadas</a>
              </li>
            </ul>
          </div>
        </li> -->

        <!-- <li g-cond="tienePermiso('modules', 'read')" g-else-attr="class: visually-hidden">
          <a href="<?php echo isset($prepath) ? $prepath : null; ?>./modules">
            <i class="mdi mdi-page-next"></i>
            <span> Módulos </span>
          </a>
        </li>

        <li g-cond="tienePermiso('environments', 'read')" g-else-attr="class: visually-hidden">
          <a href="<?php echo isset($prepath) ? $prepath : null; ?>./environments">
            <i class="mdi mdi-code-braces"></i>
            <span> Ambientes </span>
          </a>
        </li>

        <li>
          <a href="<?php echo isset($prepath) ? $prepath : null; ?>./notifications">
            <i class="mdi mdi-bell"></i>
            <span> Notificaciones </span>
          </a>
        </li> -->

        <li g-cond="tienePermiso('usuarios', 'listar') || tienePermiso('roles', 'listar')" g-else-attr="class: visually-hidden">
          <a href="#menu_admin" data-bs-toggle="collapse">
            <i class="mdi mdi-account"></i>
            <span> Usuarios y accesos </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="menu_admin">
            <ul class="nav-second-level">
              <li g-cond="tienePermiso('usuarios', 'listar')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./usuarios">Usuarios</a>
              </li>
              <li g-cond="tienePermiso('roles', 'listar')" g-else-attr="class: visually-hidden">
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./roles">Roles y permisos</a>
              </li>
            </ul>
          </div>
        </li>

        <li class="menu-title mt-2">Configuración</li>

        <li>
          <a href="#menu_account" data-bs-toggle="collapse">
            <i class="mdi mdi-cog"></i>
            <span> Mi cuenta </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="menu_account">
            <ul class="nav-second-level">
              <li>
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./configuracion">Configuración</a>
              </li>
              <li>
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./perfil">Mi perfil</a>
              </li>
            </ul>
          </div>
        </li>

        <li g-cond="!permisos.esRoot" g-if-attr="class: visually-hidden">
          <a href="#menu_system" data-bs-toggle="collapse">
            <i class="mdi mdi-application-cog"></i>
            <span> Sistema </span>
            <span class="menu-arrow"></span>
          </a>
          <div class="collapse" id="menu_system">
            <ul class="nav-second-level">
              <li>
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./vistas">Vistas</a>
              </li>
              <li>
                <a href="<?php echo isset($prepath) ? $prepath : null; ?>./permisos">Permisos</a>
              </li>
            </ul>
          </div>
        </li>

        <li>
          <a id="btn_logout" href="javascript:void(0);">
            <i class="mdi mdi-logout"></i>
            <span> Cerrar sesión </span>
          </a>
        </li>
      </ul>
    </div>
    <div class="clearfix"></div>
  </div>
</div>