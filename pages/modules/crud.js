const onCreateClicked = () => {
    myCenterModalLabel.innerText = 'Agregar módulo';
    entry_id.value = null;
    entry_module.value = null;
    entry_correlative.value = null;
    entry_description.value = null;
    entry_repository.value = null;
    entry_status.value = 1;
}
const onUpdateClicked = (button) => {
    let module = g.Dom(button).data('module');
    myCenterModalLabel.innerText = 'Actualizar módulo';
    entry_id.value = module.id;
    entry_module.value = module.module;
    entry_correlative.value = module.correlative;
    entry_description.value = module.description;
    entry_repository.value = module.repository;
    entry_status.value = module.status;
    $(modules_modal).modal('show');
}
const onDeleteClicked = async (button) => {
    let module = g.Dom(button).data('module');
    await onFetch({
        url: './api/modules',
        method: 'DELETE',
        request: module
    });
}
const onDeactivateClicked = async (button) => {
    let module = g.Dom(button).data('module');
    module.status = 0;
    await onFetch({
        url: './api/modules',
        method: 'PATCH',
        request: module
    });
}
const onActivateClicked = async (button) => {
    let module = g.Dom(button).data('module');
    module.status = 1;
    await onFetch({
        url: './api/modules',
        method: 'PATCH',
        request: module
    });
}
const onRestoreClicked = async (button) => {
    let module = g.Dom(button).data('module');
    await onFetch({
        url: './api/modules/restore',
        request: module
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
        url: './api/modules', method, request,
        success: () => {
            $(modules_modal).modal('hide');
        }
    });
}

const onFetch = async ({
    url = './api/modules',
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
        $('#modules_table').DataTable().ajax.reload();
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