const onDeleteProfileClicked = () => {
    gStorage.session('image_type', 'none');
    gStorage.session('image_mini', 'none');
    gStorage.session('image_full', 'none');
    preview_image.src = './images/user_not_found.svg';
}
const onProfileUploaded = (file) => {
    if (file.type.startsWith('image')) {
        gImage.compress({
            blob: file,
            callback: ({ image_type, image_full, image_mini }) => {
                gStorage.session('image_type', image_type);
                gStorage.session('image_mini', image_mini);
                gStorage.session('image_full', image_full);
            }
        })
        gImage.blobToBase64(file, (base64) => {
            preview_image.src = base64;
        });
    }
}

const onAccountSubmit = async (e) => {
    e.preventDefault();
    let request = g.getFormData('#account_form');
    request.image_type = gStorage.session('image_type');
    request.image_mini = gStorage.session('image_mini');
    request.image_full = gStorage.session('image_full');

    await onFetch({
        url: './api/profile/account',
        method: 'PATCH',
        request,
        success: () => {
            document.location.reload();
        }
    });
}

const onPasswordSubmit = async(e) => {
    e.preventDefault();
    let request = g.getFormData('#password_form');
    await onFetch({
        url: './api/profile/password',
        method: 'PATCH',
        request,
        success: () => {
            document.location.reload();
        }
    });
}

const onPersonalSubmit = async(e) => {
    e.preventDefault();
    let request = g.getFormData('#personal_form');
    await onFetch({
        url: './api/profile/personal',
        method: 'PATCH',
        request,
        success: () => {
            document.location.reload();
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