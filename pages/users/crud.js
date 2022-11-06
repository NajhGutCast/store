const onCreateClicked = async () => {
    myCenterModalLabel.innerText = 'Agregar usuario';
    entry_id.value = null;

    // BEGIN PROFILE
    preview_image.src = './images/user_not_found.svg';
    g.Dom(watch_image, {
        href: './images/user_not_found.svg'
    });
    g.Dom(download_image, {
        href: './images/user_not_found.svg',
        download: 'newuser.svg'
    })
    sessionStorage.removeItem('image_type');
    sessionStorage.removeItem('image_mini');
    sessionStorage.removeItem('image_full');
    // END PROFILE

    entry_username.value = null;
    entry_password.value = null;
    entry_password.required = true;
    entry_dni.value = null;
    entry_lastname.value = null;
    entry_name.value = null;
    entry_email.value = null;
    entry_phone_prefix.value = '51';
    entry_phone_number.value = null;
    entry__role.value = null;
    entry_status.value = 1;
    getRoles(null);
    $(users_modal).modal('show');
}
const onUpdateClicked = async (button) => {
    let user = g.Dom(button).data('user');
    myCenterModalLabel.innerText = 'Actualizar usuario';
    entry_id.value = user.id;

    // BEGIN PROFILE
    preview_image.src = `./api/profile/${user.relative_id}/mini`;

    g.Dom(watch_image, {
        href: `./api/profile/${user.relative_id}/full`
    });
    g.Dom(download_image, {
        href: `./api/profile/${user.relative_id}/full`,
        download: `${user.username}.png`
    })

    sessionStorage.removeItem('image_type');
    sessionStorage.removeItem('image_mini');
    sessionStorage.removeItem('image_full');
    // END PROFILE

    entry_username.value = user.username;
    entry_password.value = null;
    entry_password.required = false;
    entry_dni.value = user.dni;
    entry_lastname.value = user.lastname;
    entry_name.value = user.name;
    entry_email.value = user.email;
    entry_phone_prefix.value = '51';
    entry_phone_number.value = user.phone_number;
    entry__role.value = user._role;
    entry_status.value = user.status;
    getRoles(user.role);
    $(users_modal).modal('show');
}
const onDeleteProfileClicked = () => {
    sessionStorage.image_type = 'none';
    sessionStorage.image_mini = 'none';
    sessionStorage.image_full = 'none';
    preview_image.src = './images/user_not_found.svg';
}
const onDeactivateClicked = async (button) => {
    let user = g.Dom(button).data('user');
    sessionStorage.removeItem('image_type');
    sessionStorage.removeItem('image_mini');
    sessionStorage.removeItem('image_full');
    user._role = user.role.id;
    user.status = 0;
    await onFetch({
        url: './api/users',
        method: 'PUT',
        request: user
    });
}
const onActivateClicked = async (button) => {
    let user = g.Dom(button).data('user');
    user._role = user.role.id;
    user.status = 1;
    await onFetch({
        url: './api/users',
        method: 'PUT',
        request: user
    });
}
const onDeleteClicked = async (button) => {
    let user = g.Dom(button).data('user');
    sessionStorage.removeItem('image_type');
    sessionStorage.removeItem('image_mini');
    sessionStorage.removeItem('image_full');
    await onFetch({
        url: './api/users',
        method: 'DELETE',
        request: user
    });
}
const onRestoreClicked = async (button) => {
    let view = g.Dom(button).data('user');
    await onFetch({
        url: './api/users/restore',
        request: view
    });
}
const onSubmitClicked = async (e) => {
    e.preventDefault();
    let request = g.getFormData();

    if (sessionStorage.image_type != undefined) {
        request.image_type = sessionStorage.image_type;
        request.image_mini = sessionStorage.image_mini;
        request.image_full = sessionStorage.image_full;
    }

    let method = 'POST';
    if (request.id) {
        method = 'PUT';
    }

    await onFetch({
        url: './api/users', method, request,
        success: () => {
            $(users_modal).modal('hide');
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
        datatable_reload();
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

const onProfileUploaded = (file) => {
    if (file.type.startsWith('image')) {
        gImage.compress({
            blob: file,
            mini_length: 120,
            callback: ({ image_type, image_full, image_mini }) => {
                sessionStorage.image_type = image_type;
                sessionStorage.image_mini = image_mini;
                sessionStorage.image_full = image_full;
            }
        })
        gImage.blobToBase64(file, (base64) => {
            preview_image.src = base64;
        });
    }
}