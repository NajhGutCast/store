const onload = async () => {
  try {
    new Switchery(_switch, { color: "#039cfd", size: "small" });
    onPermissionsLoaded();

    $("#roles_table").DataTable({
      order: [[0, "asc"]],
      searching: false,
      autoWidth: false,
      responsive: true,
      processing: true,
      serverSide: true,
      serverMethod: "post",
      language: {
        url: "./assets/libs/datatables.net/Spanish.json",
      },
      ajax: {
        url: "api/roles/paginate",
        contentType: "application/json",
        headers: {
          "SoDe-Auth-Required": "Yes",
        },
        dataSrc: "data",
        data: (d) => {
          d.columns = undefined;
          d.all = _switch.checked;
          d.order = {
            column: [
              "id",
              "role",
              "priority",
              "permissions",
              "description",
              "status",
            ][d.order[0].column],
            dir: d.order[0].dir,
          };
          d.search.column = column.value;
          d.search.value = search.value;
          d.search.regex = true;
          return JSON.stringify(d);
        },
        error: (jqXHR, textStatus, errorThrown) => {
          $("#roles_table").DataTable().clear().draw();
        },
        complete: (data) => { },
      },
      columns: [
        { data: "id" },
        { data: "role" },
        { data: "priority" },
        {
          data: null,
          render: (role) => {
            if (role.permissions.isRoot) {
              return 'Todos los permisos del sistema';
            }
            if (role.permissions.isAdmin) {
              return 'Todos los permisos de Activity';
            }
            return g.Dom('div').multipleAppend([
              `Tiene Permisos en ${Object.keys(role.permissions).length} ventanas`,
              ' ',
              g.Button('Gestionar', {
                class: 'btn btn-xs btn-dark rounded-pill',
                onclick: 'onPermissionsClicked(this)'
              }).data('permissions', role.permissions)
              .data('role', role)
            ]).toHTML();
          }
        },
        { data: "description" },
        {
          data: null,
          render: (view) => {
            let status;
            let className;
            if (view.status == 1) {
              status = "Activo";
              className = "badge bg-success rounded-pill";
            } else if (view.status == 0) {
              status = "Inactivo";
              className = "badge bg-danger rounded-pill";
            } else {
              status = "Eliminado";
              className = "badge bg-dark rounded-pill";
            }
            return g.Badge(status, { class: className }).toHTML();
          },
        },
        {
          data: null,
          render: (role) => {
            let btn_update;
            let btn_delete;
            let btn_restore;
            let btn_activate;
            let btn_deactivate;
            if (role.status != null) {
              btn_update = g
                .Button(g.Icon("fas fa-pen"), {
                  class: "btn btn-sm btn-primary waves-effect waves-light",
                  onclick: "onUpdateClicked(this)",
                })
                .data("role", role);
              btn_delete = g
                .Button(g.Icon("fas fa-trash"), {
                  class: "btn btn-sm btn-danger waves-effect waves-light",
                  onclick: "onDeleteClicked(this)",
                })
                .data("role", role);
              if (role.status == 1) {
                btn_deactivate = g
                  .Button(g.Icon("fas fa-toggle-on text-success"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onDeactivateClicked(this)",
                  })
                  .data("role", role);
              } else {
                btn_activate = g
                  .Button(g.Icon("fas fa-toggle-off text-danger"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onActivateClicked(this)",
                  })
                  .data("role", role);
              }
            } else {
              btn_restore = g
                .Button(g.Icon("fas fa-trash-restore"), {
                  class: "btn btn-sm btn-dark waves-effect waves-light",
                  onclick: "onRestoreClicked(this)",
                })
                .data("role", role);
            }
            let buttons = [
              hasPermission("roles", "update") ? btn_update : null,
              hasPermission("roles", "change_status") ? btn_activate : null,
              hasPermission("roles", "change_status") ? btn_deactivate : null,
              hasPermission("roles", "delete_restore") ? btn_delete : null,
              hasPermission("roles", "delete_restore") ? btn_restore : null,
            ];
            buttons = buttons.filter(Boolean);
            if (buttons.length >= 1) {
              return g
                .Dom("div", { class: "btn-group" })
                .multipleAppend(buttons)
                .toHTML();
            }
            return g
              .Dom("span", {
                class: "text-muted",
              })
              .oneAppend("Sin acción")
              .toHTML();
          },
        },
      ],
    });
  } catch (e) {
    gNotify.add({
      title: "Error",
      body: e.message,
      type: "danger",
    });
  }
};

window.onload = onload;

const datatable_reload = () => {
  $("#roles_table").DataTable().ajax.reload();
};

column.onchange = function () {
  if (search.value) {
    datatable_reload();
  }
};
search.onkeyup = datatable_reload;


btn_clear_filter.onclick = () => {
  column.value = "*";
  search.value = null;
  if (_switch.checked) {
    _switch.click();
  } else {
    datatable_reload();
  }
};

_switch.onchange = function () {
  datatable_reload();
};

btn_create.onclick = onCreateClicked;

roles_form.onsubmit = onSubmitClicked;

permissions_form.onsubmit = onPermissionsSubmitClicked;