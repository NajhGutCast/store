class g {
    static Dom = (element = 'span', attrs = {}) => {
        let dom = element;

        if (typeof element == 'string') {
            dom = document.createElement(element);
        }

        for (let attr in attrs) {
            let value = attrs[attr];
            dom.setAttribute(attr, value);
        }
        dom.oneAppend = (e) => {
            dom.append(e);
            return dom;
        }
        dom.onePrepend = (e) => {
            dom.prepend(e);
            return dom;
        }
        dom.multipleAppend = (elements = []) => {
            elements = elements.filter(Boolean);
            elements.forEach(e => {
                dom.append(e);
            })
            return dom;
        }
        dom.multiplePrepend = (elements = []) => {
            elements = elements.filter(Boolean);
            elements.forEach(e => {
                dom.prepend(e);
            })
            return dom;
        }
        dom.toHTML = () => {
            return dom.outerHTML;
        }
        dom.data = (data = '', value = undefined) => {
            if (value) {
                let attr = data ? `data-${data}` : 'data';
                if (typeof value == 'object') {
                    let json = JSON.stringify(value);
                    dom.setAttribute(attr, json)
                } else {
                    dom.setAttribute(attr, value);
                }
                return dom;
            } else {
                let attr = data ? `data-${data}` : 'data';
                value = dom.getAttribute(attr);
                try {
                    let json = JSON.parse(value);
                    return json;
                } catch (error) {
                    return value;
                }
            }
        }
        dom.callback = (fn) => {
            fn();
        };
        return dom;
    }

    static Tr = (attrs = {}) => {
        let tr = this.Dom('tr', attrs);
        return tr;
    }
    static Td = (text = '', attrs = {}) => {
        let td = this.Dom('td', attrs);
        if (typeof text == 'string') {
            td.innerText = text;
        } else {
            td.oneAppend(text);
        }
        return td;
    }

    static Button = (text = '', attrs = {
        type: 'button'
    }) => {
        let button = this.Dom('button', attrs);
        if (typeof text == 'string') {
            button.innerText = text;
        } else {
            button.oneAppend(text);
        }
        return button;
    }

    static Icon = (i = 'fas fa-circle') => {
        let icon = this.Dom('i', { class: i });
        return icon;
    }

    static Badge = (text = '', attrs = {}) => {
        let badge = this.Dom('badge', attrs);
        if (typeof text == 'string') {
            badge.innerText = text;
        } else {
            badge.oneAppend(text);
        }
        return badge;
    }

    static Option = (text = '', attrs = {}) => {
        let option = this.Dom('option', attrs);
        option.innerText = text;
        return option;
    }

    static Select = (element = 'select', attrs = {}) => {
        let select = this.Dom(element, attrs);
        select.setOptions = (data = [], conf = {}) => {
            select.innerHTML = null;
            data.forEach(op => {
                let option;
                if (typeof op == 'string') {
                    option = this.Option(op, {
                        value: op,
                        label: op
                    });
                } else {
                    let attrs = {};
                    let text = '';
                    let temp = gJSON.flatten(op);
                    for (let i in conf) {
                        if (i == 'text') {
                            text = temp[conf[i]];
                        } else if (i == 'enabled') {
                            if (!temp[conf[i]]) {
                                attrs['disabled'] = 'disabled';
                            }
                        } else {
                            attrs[i] = temp[conf[i]];
                        }
                    }
                    option = this.Option(text, attrs);
                }
                select.oneAppend(option);
            })
            return select;
        };
        select.setValue = (value) => {
            select.value = value;
            return select;
        }
        return select;
    }

    static Dropdown = ({
        text,
        element = 'button',
        _class = 'btn btn-sm btn-dark',
        items = []
    }) => {
        let dropdown = this.Dom('div', { class: 'btn-group' });
        let clickable;
        if (element == 'button') {
            clickable = g.Button(text, {
                class: `${_class} dropdown-toggle`,
                'data-bs-toggle': 'dropdown',
                'aria-expanded': 'false'
            })
        } else {
            clickable = g.Dom('a', {
                href: '#',
                class: 'dropdown-toggle',
                'data-bs-toggle': 'dropdown',
                'aria-expanded': 'false'
            }).oneAppend(text);
        }
        let list = [];
        items.forEach(item => {
            item.class = 'dropdown-item'
            list.push(g.Dom('a', item).oneAppend(item.text));
        })
        dropdown.multipleAppend([
            clickable,
            g.Dom('div', { class: 'dropdown-menu'}).multipleAppend(list)
        ]);
        return dropdown;
    }

    static Query = (selector = 'body', quantity = 'multiple') => {
        if (quantity == 'one') {
            return document.querySelector(selector);
        }
        return document.querySelectorAll(selector);
    }

    static getFormData = (form = '') => {
        let request = {};
        this.Query(`${form} [id^="entry"]`).forEach(entry => {
            request[entry.id.replace('entry_', '')] = entry.value;
        })
        return request;
    }

}
