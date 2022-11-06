window.onload = async () => {
  if (!hasPermission('views', 'read')) {
    location.href = './home';
  }
  try {
    new Switchery(_switch, { color: '#039cfd', size: 'small' });
    $(column).select2();

    let start = 0;
    let quantity = 10;

    $('#views_table').DataTable({
      'order': [[0, 'asc']],
      'searching': false,
      'autoWidth': false,
      'responsive': false,
      'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      'language': {
        'url': './assets/libs/datatables.net/Spanish.json'
      },
      'ajax': {
        'url': 'api/views/paginate',
        'contentType': 'application/json',
        'headers': {
          'SoDe-Auth-Required': 'Yes'
        },
        'dataSrc': 'data',
        'data': (d) => {
          start = new Date().getTime();
          d.columns = undefined;
          d.all = _switch.checked;
          d.order = {
            column: [
              'id', 'view', 'path', 'placement',
              'description', 'status', 'id'
            ][d.order[0].column],
            dir: d.order[0].dir
          }
          d.search.column = column.value;
          d.search.value = search.value;
          d.search.regex = true;
          quantity = d.length;
          return JSON.stringify(d);
        },
        'error': (jqXHR, textStatus, errorThrown) => {
          $('#views_table').DataTable().clear().draw();
        },
        'complete': (data) => {
          let end = new Date().getTime();
          console.log(`${quantity} registros: ${end - start}ms`)
        }
      },
      'columns': [
        { 'data': 'id' },
        { 'data': 'view' },
        { 'data': 'path' },
        { 'data': 'placement' },
        { 'data': 'description' },
        {
          'data': null,
          'render': (view) => {
            let status;
            let className;
            if (view.status == 1) {
              status = 'Activo';
              className = 'badge bg-success rounded-pill';
            } else if (view.status == 0) {
              status = 'Inactivo';
              className = 'badge bg-danger rounded-pill'
            } else {
              status = 'Eliminado';
              className = 'badge bg-dark rounded-pill';
            }
            return g.Badge(status, { class: className }).toHTML();
          }
        },
        {
          'data': null,
          'render': (view) => {
            let btn_update;
            let btn_delete;
            let btn_restore;
            let btn_activate;
            let btn_deactivate;
            if (view.status != null) {
              btn_update = g.Button(g.Icon('fas fa-pen'), {
                class: 'btn btn-sm btn-primary waves-effect waves-light',
                onclick: 'onUpdateClicked(this)'
              }).data('view', view);
              btn_delete = g.Button(g.Icon('fas fa-trash'), {
                class: 'btn btn-sm btn-danger waves-effect waves-light',
                onclick: 'onDeleteClicked(this)'
              }).data('view', view);
              if (view.status == 1) {
                btn_deactivate = g.Button(g.Icon('fas fa-toggle-on text-success'), {
                  class: 'btn btn-sm btn-light waves-effect waves-light',
                  onclick: 'onDeactivateClicked(this)'
                }).data('view', view);
              } else {
                btn_activate = g.Button(g.Icon('fas fa-toggle-off text-danger'), {
                  class: 'btn btn-sm btn-light waves-effect waves-light',
                  onclick: 'onActivateClicked(this)'
                }).data('view', view);
              }
            } else {
              btn_restore = g.Button(g.Icon('fas fa-trash-restore'), {
                class: 'btn btn-sm btn-dark waves-effect waves-light',
                onclick: 'onRestoreClicked(this)'
              }).data('view', view);
            }
            return g.Dom('div', { class: 'btn-group' }).multipleAppend([
              btn_update,
              btn_activate,
              btn_deactivate,
              btn_delete,
              btn_restore
            ]).toHTML();
          }
        }
      ]
    });
  } catch (e) {
    gNotify.add({
      title: 'Error',
      body: e.message,
      type: 'danger'
    });
  }
}

const datatable_reload = () => {
  $('#views_table').DataTable().ajax.reload();
}

column.onchange = function () {
  if (search.value) {
    datatable_reload();
  }
}
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
  datatable_reload()
};

btn_create.onclick = onCreateClicked;

views_form.onsubmit = onSubmitClicked;