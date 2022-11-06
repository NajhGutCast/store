window.onload = async () => {
  if (!permissions['isRoot']) {
    location.href = './home';
  }
  try {
    new Switchery(_switch, { color: "#039cfd", size: "small" });
    $(column).select2();

    let start = 0;
    let quantity = 10;

    $("#permission_table").DataTable({
      order: [[0, "asc"]],
      searching: false,
      autoWidth: false,
      responsive: false,
      processing: true,
      serverSide: true,
      serverMethod: "post",
      language: {
        url: "./assets/libs/datatables.net/Spanish.json",
      },
      ajax: {
        url: "api/permissions/paginate",
        contentType: "application/json",
        headers: {
          "SoDe-Auth-Required": "Yes",
        },
        dataSrc: "data",
        data: (d) => {
          start = new Date().getTime();
          d.columns = undefined;
          d.all = _switch.checked;
          d.order = {
            column: [
              "id", "permission", 'correlative',
              "view", "description", "status", 'id'
            ][d.order[0].column],
            dir: d.order[0].dir,
          };
          d.search.column = column.value;
          d.search.value = search.value;
          d.search.regex = true;
          quantity = d.length;
          return JSON.stringify(d);
        },
        error: (jqXHR, textStatus, errorThrown) => {
          $("#permission_table").DataTable().clear().draw();
        },
        complete: (data) => {
          let end = new Date().getTime();
          console.log(`${quantity} registros: ${end - start}ms`)
        },
      },
      columns: [
        { data: "id" },
        { data: "permission" },
        { data: "correlative" },
        { data: "view.view" },
        { data: "description" },
        {
          data: null,
          render: (permission) => {
            let status;
            let className;
            if (permission.status == 1) {
              status = "Activo";
              className = "badge bg-success rounded-pill";
            } else if (permission.status == 0) {
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
          render: (permission) => {
            let btn_update;
            let btn_delete;
            let btn_restore;
            let btn_activate;
            let btn_deactivate;
            if (permission.status != null) {
              btn_update = g
                .Button(g.Icon("fas fa-pen"), {
                  class: "btn btn-sm btn-primary waves-effect waves-light",
                  onclick: "onUpdateClicked(this)",
                })
                .data("permission", permission);
              btn_delete = g
                .Button(g.Icon("fas fa-trash"), {
                  class: "btn btn-sm btn-danger waves-effect waves-light",
                  onclick: "onDeleteClicked(this)",
                })
                .data("permission", permission);
              if (permission.status == 1) {
                btn_deactivate = g
                  .Button(g.Icon("fas fa-toggle-on text-success"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onDeactivateClicked(this)",
                  })
                  .data("permission", permission);
              } else {
                btn_activate = g
                  .Button(g.Icon("fas fa-toggle-off text-danger"), {
                    class: "btn btn-sm btn-light waves-effect waves-light",
                    onclick: "onActivateClicked(this)",
                  })
                  .data("permission", permission);
              }
            } else {
              btn_restore = g
                .Button(g.Icon("fas fa-trash-restore"), {
                  class: "btn btn-sm btn-dark waves-effect waves-light",
                  onclick: "onRestoreClicked(this)",
                })
                .data("permission", permission);
            }
            return g
              .Dom("div", { class: "btn-group" })
              .multipleAppend([
                btn_update,
                btn_activate,
                btn_deactivate,
                btn_delete,
                btn_restore,
              ])
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
  $("#permission_table").DataTable().ajax.reload();
};

column.onchange = function () {
  if (search.value) {
    datatable_reload();
  }
};
search.onkeyup = datatable_reload;
 

btn_clear_filter.onclick = () => {
  column.value = '*';
  $(column).select2();
  search.value = null;
  if (_switch.checked) {
    _switch.click();
  } else {
    datatable_reload();
  }
}

_switch.onchange = function () {
  datatable_reload();
};

btn_create.onclick = onCreateClicked;

permissions_form.onsubmit = onSubmitClicked;

async function getViews(view = null) {
  let URL = `api/views`;
  let headers = {
    "SoDe-Auth-Required": "Yes",
  };
  let res = await fetch(URL, {
    headers: headers,
    method: "GET",
  });
  if (res.ok) {
    let data = await res.json();
    let views = data.data;
    let exist = views.find(v => v.id == view?.id);
    if (!exist) {
      views.push(view);
    }
    views = views.filter(Boolean);
    g.Select(entry__view)
      .setOptions(
        views,
        {
          text: 'view',
          value: 'id',
          title: 'description',
          enabled: 'status'
        }
      )
      .setValue(view?.id)
      .callback(() => {
        $(entry__view).select2({
          dropdownParent: permission_modal
        });
      });
  } else {
    console.log(await res.json())
    gNotify.add({
      title: "Error el la operación",
      body: "Error: no se pudo obtener vistas",
      type: "error",
    });
  }
}