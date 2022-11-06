const onPermissionsClicked = async (button) => {
    var data = g.Dom(button).data('role');
    var permissions = g.Dom(button).data('permissions');
    var flatten = gJSON.flatten(permissions);
    g.Query('.checkbox_container input[type="checkbox"]').forEach(e => {
        e.checked = false; 
    });
    for (let i in flatten) {
        let element = g.Query(`[data-id="${i}"]`, 'one');
        if (element) element.checked = true;
    }
    permission_rol_id.value = data.id;
    $(permissions_modal).modal('show');
}
const onCreateClicked = async () => {
    myCenterModalLabel.innerText = 'Agregar rol';
    entry_id.value = null;
    entry_role.value = null;
    entry_priority.value = null;
    entry_description.value = null;
    entry_status.value = 1;

    $(roles_modal).modal('show');
}
const onUpdateClicked = async (button) => {
    let role = g.Dom(button).data('role');
    myCenterModalLabel.innerText = 'Actualizar rol';

    entry_id.value = role.id;
    entry_role.value = role.role;
    entry_priority.value = role.priority;
    entry_description.value = role.description;
    entry_status.value = role.status;

    $(roles_modal).modal('show');
}
const onDeleteClicked = async (button) => {
    let role = g.Dom(button).data('role');
    await onFetch({
        url: './api/roles',
        method: 'DELETE',
        request: role
    });
}
const onDeactivateClicked = async (button) => {
    let role = g.Dom(button).data('role');
    role.status = 0;
    await onFetch({
        url: './api/roles',
        method: 'PUT',
        request: role
    });
}
const onActivateClicked = async (button) => {
    let role = g.Dom(button).data('role');
    role.status = 1;
    await onFetch({
        url: './api/roles',
        method: 'PUT',
        request: role
    });
}
const onRestoreClicked = async (button) => {
    let role = g.Dom(button).data('role');
    await onFetch({
        url: './api/roles/restore',
        request: role
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
        url: './api/roles', method, request,
        success: () => {
            $(roles_modal).modal('hide');
        }
    });

}
const onPermissionsSubmitClicked = async (e) => {
    e.preventDefault();
    let request = {};
    request.id = permission_rol_id.value;
    let permissions = {};
    g.Query('#permissions_form input').forEach(input => {
        if (input.checked) {
            permissions[g.Dom(input).data('id')] = true;
        }
    })
    request.permissions = JSON.stringify(gJSON.restore(permissions));
    await onFetch({
        url: './api/roles/permissions',
        method: 'PUT',
        request: request,
        success: () => {
            $(permissions_modal).modal('hide');
        }
    });
}
const onFetch = async ({
    url = './api/roles',
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
        $('#roles_table').DataTable().ajax.reload();
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