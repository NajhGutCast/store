const onCreateClicked = () => {
    myCenterModalLabel.innerText = 'Agregar ambiente';
    entry_id.value = null;
    entry_environment.value = null;
    entry_description.value = null;
    entry_status.value = 1;
}
const onUpdateClicked = (button) => {
    let environment = g.Dom(button).data('environment');
    myCenterModalLabel.innerText = 'Actualizar ambiente';
    entry_id.value = environment.id;
    entry_environment.value = environment.environment;
    entry_description.value = environment.description;
    entry_status.value = environment.status;
    $(environments_modal).modal('show');
}
const onDeleteClicked = async (button) => {
    let environment = g.Dom(button).data('environment');
    await onFetch({
        url: './api/environments',
        method: 'DELETE',
        request: environment
    });
}
const onDeactivateClicked = async (button) => {
    let environment = g.Dom(button).data('environment');
    environment.status = 0;
    await onFetch({
        url: './api/environments',
        method: 'PATCH',
        request: environment
    });
}
const onActivateClicked = async (button) => {
    let environment = g.Dom(button).data('environment');
    environment.status = 1;
    await onFetch({
        url: './api/environments',
        method: 'PATCH',
        request: environment
    });
}
const onRestoreClicked = async (button) => {
    let environment = g.Dom(button).data('environment');
    await onFetch({
        url: './api/environments/restore',
        request: environment
    });
}
const onSubmitClicked = async (e) => {
    e.preventDefault();

    let request = g.getFormData();
    let method = 'POST';
    if (request.id) {
        method = 'PATCH';
    }

    await onFetch({
        url: './api/environments', method, request,
        success: () => {
            $(environments_modal).modal('hide');
        }
    });
}

const onFetch = async ({
    url = './api/environments',
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
        $('#environments_table').DataTable().ajax.reload();
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