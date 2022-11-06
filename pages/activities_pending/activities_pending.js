window.onload = async () => {
    if (!hasPermission("users", "read")) {
      location.href = "./home";
    }
    try {
      new Switchery(_switch, { color: "#039cfd", size: "small" });
      $(column).select2();
      gClipboard.paste(
        drop_image,
        (files) => {
          if (files) onProfileUploaded(files[0]);
        },
        {
          style: "transition: 0.125s; opacity: 0.5;",
        }
      );
  
      let start = 0;
      let quantity = 10;
  
      $("#users_table").DataTable({
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
          url: "api/users/paginate",
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
                "id",
                "role.role",
                "username",
                "lastname",
                "name",
                "email",
                "phone_number",
                "status",
                "id",
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
            console.log(`${quantity} registros: ${end - start}ms`);
          },
        },
        columns: [
          { data: "relative_id" },
          { data: "role.role" },
          { data: "username" },
          { data: "lastname" },
          { data: "name" },
          {
            data: null,
            render: (user) => {
              if (user.email) {
                [email, email_name, server, domain] = /^([^]+)@(\w+).(\w+)$/.exec(
                  user.email
                );
                return g
                  .Dropdown({
                    text: email_name,
                    element: "a",
                    items: [
                      {
                        text: `Abrir ${server}`,
                        href: `mailto:${email}`,
                        target: "_blank",
                      },
                      {
                        text: "Copiar correo",
                        href: "#",
                        onclick: "gClipboard.copy(this)",
                        "g-copy": `${email}`,
                      },
                    ],
                  })
                  .toHTML();
              }
              return g
                .Dom("span", {
                  class: "text-muted",
                })
                .oneAppend("Sin correo")
                .toHTML();
            },
          },
          {
            data: null,
            render: (user) => {
              if (user.phone_number) {
                return g
                  .Dropdown({
                    text: user.phone_number,
                    element: "a",
                    items: [
                      {
                        text: "Llamar contacto",
                        href: `tel:${user.phone_number}`,
                        target: "_blank",
                      },
                      {
                        text: "Abrir WhatsApp",
                        href: `https://wa.me/${user.phone_prefix}${user.phone_number}`,
                        target: "_blank",
                      },
                      {
                        text: "Copiar número",
                        href: "#",
                        onclick: "gClipboard.copy(this)",
                        "g-copy": `${user.phone_prefix}${user.phone_number}`,
                      },
                    ],
                  })
                  .toHTML();
              }
              return g
                .Dom("span", {
                  class: "text-muted",
                })
                .oneAppend("Sin teléfono")
                .toHTML();
            },
          },
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
            render: (user) => {
              let btn_update;
              let btn_delete;
              let btn_restore;
              let btn_activate;
              let btn_deactivate;
              if (user.status != null) {
                btn_update = g
                  .Button(g.Icon("fas fa-pen"), {
                    class: "btn btn-sm btn-primary waves-effect waves-light",
                    onclick: "onUpdateClicked(this)",
                  })
                  .data("user", user);
                btn_delete = g
                  .Button(g.Icon("fas fa-trash"), {
                    class: "btn btn-sm btn-danger waves-effect waves-light",
                    onclick: "onDeleteClicked(this)",
                  })
                  .data("user", user);
                if (user.status == 1) {
                  btn_deactivate = g
                    .Button(g.Icon("fas fa-toggle-on text-success"), {
                      class: "btn btn-sm btn-light waves-effect waves-light",
                      onclick: "onDeactivateClicked(this)",
                    })
                    .data("user", user);
                } else {
                  btn_activate = g
                    .Button(g.Icon("fas fa-toggle-off text-danger"), {
                      class: "btn btn-sm btn-light waves-effect waves-light",
                      onclick: "onActivateClicked(this)",
                    })
                    .data("user", user);
                }
              } else {
                btn_restore = g
                  .Button(g.Icon("fas fa-trash-restore"), {
                    class: "btn btn-sm btn-dark waves-effect waves-light",
                    onclick: "onRestoreClicked(this)",
                  })
                  .data("user", user);
              }
              let buttons = [
                hasPermission("users", "update") ? btn_update : null,
                hasPermission("users", "change_status") ? btn_activate : null,
                hasPermission("users", "change_status") ? btn_deactivate : null,
                hasPermission("users", "delete_restore") ? btn_delete : null,
                hasPermission("users", "delete_restore") ? btn_restore : null,
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
    $("#users_table").DataTable().ajax.reload();
  };
  
  column.onchange = function () {
    if (search.value) {
      datatable_reload();
    }
  };
  search.onkeyup = datatable_reload;
  
  btn_clear_filter.onclick = () => {
    column.value = "*";
    $(column).select2();
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
  
  users_form.onsubmit = onSubmitClicked;
  
  entry_image.onchange = () => {
    let files = entry_image.files;
    if (files.length) {
      onProfileUploaded(files[0]);
    } else {
      sessionStorage.removeItem("image_type");
      sessionStorage.removeItem("image_content");
    }
  };
  
  async function getRoles(role = null) {
    let URL = `api/roles`;
    let headers = {
      "SoDe-Auth-Required": "Yes",
    };
    let res = await fetch(URL, {
      headers: headers,
      method: "GET",
    });
    if (res.ok) {
      let data = await res.json();
      let roles = data.data;
      let exist = roles.find((v) => v.id == role?.id);
      if (!exist) {
        roles.push(role);
      }
      roles = roles.filter(Boolean);
      g.Select(entry__role)
        .setOptions(roles, {
          text: "role",
          value: "id",
          title: "description",
          enabled: "status",
        })
        .setValue(role?.id)
        .callback(() => {
          $(entry__role).select2({
            dropdownParent: users_modal,
          });
        });
    } else {
      console.log(await res.json());
      gNotify.add({
        title: "Error el la operación",
        body: "Error: no se pudo obtener roles",
        type: "danger",
      });
    }
  }
  