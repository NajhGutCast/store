window.onload = async () => {
  if (!hasPermission("modules", "read")) {
    location.href = "./home";
  }
  try {
    new Switchery(_switch, { color: "#039cfd", size: "small" });
    $("#modules_table").DataTable({
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
        url: "api/modules/paginate",
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
              "module",
              "correlative",
              "description",
              "repository",
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
          // $("#modules_table").DataTable().clear().draw();
        },
        complete: (data) => {
          console.log(data.responseJSON);
        },
      },
      columns: [
        { data: "id" },
        { data: "module" },
        {
          data: null,
          render: (module) => {
            return g
              .Dom("a", {
                href: module.service.repository,
                title: `Ir a ${module.service.correlative}`,
                target: "_blank",
              })
              .oneAppend(module.service.service)
              .toHTML();
          },
        },
        { data: "description" },
        {
          data: null,
          render: (module) => {
            let status;
            let className;
            if (module.status == 1) {
              status = "Activo";
              className = "badge bg-success rounded-pill";
            } else if (module.status == 0) {
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
          render: (module) => {
            let btn_update;
            let btn_delete;
            let btn_restore;
            let btn_activate;
            let btn_deactivate;
            if (module.status != null) {
              btn_update = g
                .Button(g.Icon("fas fa-pen"), {
                  class: "btn btn-sm btn-primary waves-effect waves-light",
                  onclick: "onUpdateClicked(this)",
                })
                .data("module", module);
              btn_delete = g
                .Button(g.Icon("fas fa-trash"), {
                  class: "btn btn-sm btn-danger waves-effect waves-light",
                  onclick: "onDeleteClicked(this)",
                })
                .data("module", module);
              if (module.status == 1) {
                btn_deactivate = g
                  .Button(g.Icon("fas fa-toggle-on text-success"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onDeactivateClicked(this)",
                  })
                  .data("module", module);
              } else {
                btn_activate = g
                  .Button(g.Icon("fas fa-toggle-off text-danger"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onActivateClicked(this)",
                  })
                  .data("module", module);
              }
            } else {
              btn_restore = g
                .Button(g.Icon("fas fa-trash-restore"), {
                  class: "btn btn-sm btn-dark waves-effect waves-light",
                  onclick: "onRestoreClicked(this)",
                })
                .data("module", module);
            }
            let buttons = [
              hasPermission("modules", "update") ? btn_update : null,
              hasPermission("modules", "change_status") ? btn_activate : null,
              hasPermission("modules", "change_status") ? btn_deactivate : null,
              hasPermission("modules", "delete_restore") ? btn_delete : null,
              hasPermission("modules", "delete_restore") ? btn_restore : null,
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

const datatable_reload = () => {
  $("#modules_table").DataTable().ajax.reload();
};

column.onchange = function () {
  if (search.value) {
    datatable_reload();
  }
};
search.onkeyup = datatable_reload;

_switch.onchange = function () {
  datatable_reload();
};

btn_clear_filter.onclick = () => {
  column.value = "*";
  search.value = null;
  if (_switch.checked) {
    _switch.click();
  } else {
    datatable_reload();
  }
};

btn_create.onclick = onCreateClicked;

modules_form.onsubmit = onSubmitClicked;
