const alertConsole = () => {
  /* Mensaje de advertencia que aparece en la consola cuando se intenta acceder a la consola. */
  console.log("%c¡Detente!", `color: red;font-family:system-ui;font-size:3rem;-webkit-text-stroke:1px black;font-weight:bold;`);
  console.log(`%cEsta función del navegador está pensada para desarrolladores. Si alguien te indicó que copiaras y pegaras algo aquí para habilitar una función de Activity o para "hackear" la cuenta de alguien, se trata de un fraude. Si lo haces, esta persona podrá acceder a los datos de tu cuenta SoDe.`, `color:#fff;font-size:1.25rem;`);
}
prepath = typeof prepath == 'undefined' ? '' : prepath;

/**
 * Reemplaza todos los atributos g-text y g-attr con los valores del objeto de sesión
 * @param session - El objeto de sesión que desea dibujar.
 */

const tienePermiso = (vista, permiso) => {
  let flatten = gJSON.flatten(permisos);
  if (
    flatten.esRoot || flatten.esAdmin ||
    flatten[`${vista}.todo`] ||
    flatten[`${vista}.${permiso}`]
  ) {
    return true;
  }
  return false;
}

const setgAttr = (element, attr, datos, regexp) => {
  let attrs = element.getAttribute(attr);
  let list = attrs.match(/(?=\S)[^;]+?(?=\s*(;|$))/g).filter(Boolean);
  list.forEach(e => {
    let kv = e.match(/(?=\S)[^:]+?(?=\s*(:|$))/g);
    element.setAttribute(kv[0],
      kv[1].replace(regexp, matched => datos[matched.replace('__', '').replace('__', '')])
    );
  })
}
const setgText = (element, attr, datos, regexp) => {
  let template = element.getAttribute(attr);
  element.innerText = template.replace(regexp, matched => datos[matched.replace('__', '').replace('__', '')]);
}

const drawSession = (sesion) => {
  permisos = gJSON.flatten(sesion.rol.permisos);
  var datos = gJSON.flatten(sesion);

  gCookie.set('SoDe-Remember', datos.username);
  let keys = `\\b(?:__${Object.keys(datos).join('__|__')}__)\\b`;
  let regexp = new RegExp(keys, 'gi');

  let g_texts = g.Query('[g-text]');
  g_texts.forEach(g_text => {
    try {
      setgText(g_text, 'g-text', datos, regexp);
    } catch (error) {
      console.warn(error);
    }

  })

  let g_attrs = g.Query('[g-attr]');
  g_attrs.forEach(g_attr => {
    try {
      setgAttr(g_attr, 'g-attr', datos, regexp);
    } catch (error) {
      console.warn(error);
    }
  })

  let g_conds = g.Query('[g-cond]');
  g_conds.forEach(g_cond => {
    try {
      let cond = Boolean(eval(g_cond.getAttribute('g-cond')));
      if (cond) {
        if (g_cond.hasAttribute('g-if-attr')) {
          setgAttr(g_cond, 'g-if-attr', datos, regexp);
        }
        if (g_cond.hasAttribute('g-if-text')) {
          setgText(g_cond, 'g-if-text', datos, regexp);
        }
      } else {
        if (g_cond.hasAttribute('g-else-attr')) {
          setgAttr(g_cond, 'g-else-attr', datos, regexp);
        }
        if (g_cond.hasAttribute('g-else-text')) {
          setgText(g_cond, 'g-else-text', datos, regexp);
        }
      }
    } catch (error) {
      console.warn(error);
    }
  })
}

// Verificando sesión
(async () => {
  alertConsole();
  try {
    var res = await fetch(`${prepath}./api/sesion/verificar`, {
      method: 'POST',
      headers: {
        'SoDe-Auth-Required': 'Yes'
      }
    });
    var data = await res.json();
    if (!res.ok) {
      throw new Error(data.message);
    }
    drawSession(data.data);
  } catch (error) {
    location.href = `${prepath}./login`;
  }
})();

// Cerrar sesión
g.Query('#btn_logout').forEach(btn => {
  btn.onclick = async () => {
    gCookie.clean();
    try {
      var res = await fetch(`${prepath}./api/sesion/cerrar`, {
        method: 'POST',
        headers: {
          'SoDe-Auth-Required': 'Yes'
        }
      })
      let data = await res.json();
      if (!res.ok) {
        throw new Error(data.message);
      }
    } catch (error) {
      gNotify.add({
        title: 'Error',
        body: e.message,
        type: 'danger'
      });
    } finally {
      location.href = `${prepath}./login`;
    }
  }
});

// Bloquear pantalla
g.Query('#btn_lock').forEach(btn => {
  btn.onclick = async () => {
    let usuario = gCookie.get('SoDe-Remember');
    gCookie.clean();
    gCookie.set('SoDe-Remember', usuario);
    try {
      var res = await fetch(`${prepath}./api/sesion/cerrar`, {
        method: 'POST',
        headers: {
          'SoDe-Auth-Required': 'Yes'
        }
      })
      let data = await res.json();
      if (!res.ok) {
        throw new Error(data.message);
      }
    } catch (error) {
      gNotify.add({
        title: 'Error',
        body: e.message,
        type: 'danger'
      });
    } finally {
      location.href = `${prepath}./login`;
    }
  }
});