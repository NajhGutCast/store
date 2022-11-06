const permissionsPriority = (permission) => {
    let permissions = {
        'read': 1,
        'create': 2,
        'update': 3,
        'change_status': 4,
        'delete_restore': 5,
        'see_trash': 6
    };
    return permissions[permission];
}

const onPermissionsLoaded = async () => {
    let res = await fetch('./api/permissions', {
        headers: {
            'SoDe-Auth-Required': 'Yes'
        }
    });
    let data = await res.json();
    let list_permissions = data.data;

    list_permissions = list_permissions.sort((a, b) => {
        return permissionsPriority(a.correlative) - permissionsPriority(b.correlative);
    })

    list_permissions.forEach(permission => {
        let view_container = g.Query(`[data-view="view_${permission.view.path}"]`, 'one');
        let checkbox_container = g.Query(`[data-view="view_${permission.view.path}"] .checkbox_container`, 'one');
        if (!view_container) {
            view_container = g.Dom('div', {
                class: 'col-lg-4 col-md-6 col-xs-12',
                'data-view': `view_${permission.view.path}`
            }).oneAppend(
                g.Dom('div', { class: 'card border border-dark' }).multipleAppend([
                    g.Dom('h5', { class: 'card-header bg-dark text-light p-2' }).multipleAppend([
                        permission.view.view,
                        ' ',
                        g.Dom('small', { class: 'text-muted' }).oneAppend(`${permission.view.path}`)
                    ]),
                    g.Dom('small', { class: 'card-body p-2' }).multipleAppend([
                        permission.view.description,
                        checkbox_container = g.Dom('div', { class: 'checkbox_container mt-2' })
                    ])
                ])
            );
            permissions_container.append(view_container);
        }

        let id = guid.any('xxxx_xxx_xx_x');

        let input_attrs = {
            class: 'form-check-input rounded-circle',
            type: 'checkbox',
            id: `_${id}`,
            'data-id': `${permission.view.path}.${permission.correlative}`
        };
        if (!hasPermission(permission.view.path, permission.correlative))
            input_attrs['disabled'] = 'disabled';

        checkbox_container.oneAppend(
            g.Dom('div', { class: 'form-check mb-1 form-check-primary' }).multipleAppend([
                g.Dom('input', input_attrs),
                g.Dom('label', {
                    class: 'form-check-label',
                    for: `_${id}`,
                    title: permission.description,
                    tabindex: "0",
                    'data-plugin': 'tippy',
                    'data-tippy-placement': 'top',
                    'data-tippy-arrow': true,
                    'style': 'cursor: pointer; user-select: none;'
                }).oneAppend(permission.permission)
            ])
        );
    });
    tippy('[data-plugin="tippy"]');
}