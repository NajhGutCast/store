const onCreateClicked = async () => {
    myCenterModalLabel.innerText = 'Agregar permiso';
    entry_id.value = null;
    entry_permission.value = null;
    entry_correlative.value = null;
    entry_description.value = null;
    entry_status.value = 1;

    getViews(null);
    $(permission_modal).modal('show');
}
const onUpdateClicked = async (button) => {
    let permission = g.Dom(button).data('permission');
    myCenterModalLabel.innerText = 'Actualizar permiso';
    entry_id.value = permission.id;
    entry_permission.value = permission.permission;
    entry_correlative.value = permission.correlative;
    entry_description.value = permission.description;
    entry_status.value = permission.status;
    getViews(permission.view);
    $(permission_modal).modal('show');
}
const onDeleteClicked = async (button) => {
    let permission = g.Dom(button).data('permission');
    await onFetch({
        url: './api/permissions',
        method: 'DELETE',
        request: permission
    });
}
const onDeactivateClicked = async (button) => {
    let permission = g.Dom(button).data('permission');
    permission.status = 0;
    permission._view = permission.view.id;
    await onFetch({
        url: './api/permissions',
        method: 'PUT',
        request: permission
    });
}
const onActivateClicked = async (button) => {
    let permission = g.Dom(button).data('permission');
    permission.status = 1;
    permission._view = permission.view.id;
    await onFetch({
        url: './api/permissions',
        method: 'PUT',
        request: permission
    });
}
const onRestoreClicked = async (button) => {
    let view = g.Dom(button).data('permission');
    await onFetch({
        url: './api/permissions/restore',
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
        url: './api/permissions', method, request,
        success: () => {
            $(permission_modal).modal('hide');
        }
    });

}
const onFetch = async ({
    url = './api/permissions',
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
        $('#permission_table').DataTable().ajax.reload();
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