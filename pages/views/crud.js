const onCreateClicked = () => {
    myCenterModalLabel.innerText = 'Agregar vista';
    entry_id.value = null;
    entry_view.value = null;
    entry_path.value = null;
    entry_placement.value = null;
    entry_description.value = null;
    entry_status.value = 1;
    $(views_modal).modal('show');
}
const onUpdateClicked = (button) => {
    myCenterModalLabel.innerText = 'Actualizar vista';
    let view = g.Dom(button).data('view');
    entry_id.value = view.id;
    entry_view.value = view.view;
    entry_path.value = view.path;
    entry_placement.value = view.placement;
    entry_description.value = view.description;
    entry_status.value = view.status;
    $(views_modal).modal('show');
}
const onDeleteClicked = async (button) => {
    let view = g.Dom(button).data('view');
    await onFetch({
        url: './api/views',
        method: 'DELETE',
        request: view
    });
}
const onDeactivateClicked = async (button) => {
    let view = g.Dom(button).data('view');
    view.status = 0;
    await onFetch({
        url: './api/views',
        method: 'PUT',
        request: view
    });
}
const onActivateClicked = async (button) => {
    let view = g.Dom(button).data('view');
    view.status = 1;
    await onFetch({
        url: './api/views',
        method: 'PUT',
        request: view
    });
}
const onRestoreClicked = async (button) => {
    let view = g.Dom(button).data('view');
    await onFetch({
        url: './api/views/restore',
        request: view
    });
}
const onSubmitClicked = async (e) => {
    e.preventDefault();

    let request = g.getFormData();
    let method = 'POST';
    if (request.id) {
        method = 'PUT';
    }

    await onFetch({
        url: './api/views', method, request,
        success: () => {
            $(views_modal).modal('hide');
        }
    });
}

const onFetch = async ({
    url = './api/views',
    method = 'POST',
    request = {},
    success = () => { },
    error = () => { }
}) => {
    try {
        let res = await fetch(url, {
            method, headers: {
                'SoDe-Auth-Required': 'Yes'
            }, body: JSON.stringify(request)
        });
        let data = await res.json();
        if (!res.ok) {
            throw new Error(data.message);
        }
        gNotify.add({
            title: 'Operación correcta',
            body: data.message,
            type: 'success'
        });
        $('#views_table').DataTable().ajax.reload();
        success();

    } catch (e) {
        gNotify.add({
            title: 'Error',
            body: e.message,
            type: 'danger'
        });
        error();
    }
}