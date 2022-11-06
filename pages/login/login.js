window.onload = async () => {
  sessionStorage.clear();
  if (gCookie.get('SoDe-Remember')) {
    checkbox.checked = true;
  }
  try {
    var res = await fetch(`./api/session/verify`, {
      method: 'POST',
      headers: {
        'Sode-Auth-Required': 'Yes'
      }
    });
    var data = await res.json();
    if (!res.ok) {
      gCookie.clean(['SoDe-Auth-Token', 'SoDe-Auth-User']);
      throw new Error(data.message);
    }
    location.href = './home';
  } catch (error) {
    var sode_remember = gCookie.get('SoDe-Remember');
    if (!sode_remember) {
      return;
    }
    var res = await fetch(`./api/users/get/${sode_remember}`);
    if (!res.ok) {
      gNotify.add({
        title: 'Error de sesión',
        body: 'El usuario solicitado no existe',
        type: 'danger'
      });
      gCookie.clean('SoDe-Remember');
      return;
    }
    var data = await res.json();
    drawUser(data.data);
  } finally {
    gLoader.hide();
  }
}

class gLoader {
  static show() {
    loader.style.opacity = 1;
    loader.style.display = 'grid';
  }
  static hide() {
    loader.style.opacity = 0;
    setTimeout(() => {
      loader.style.display = 'none';
    }, 250);
  }
}

const drawUser = (data) => {
  image.src = `./api/profile/${data.relative_id}/mini`;
  title.innerText = data.name;
  description.innerText = data.role.role;
  input.type = 'password';
  input.value = null;
  label.innerText = 'Contraseña';
  btn_submit.innerText = 'Iniciar sesión';
  btn_forgot.innerText = 'Usar otra cuenta';
  sessionStorage.username = data.username;
}

image.onerror = () => {
  console.log('Falló al cargar la imagen');
  image.src = './images/logo.svg';
}

form.onsubmit = async (e) => {
  e.preventDefault();
  gLoader.show();
  if (input.type == 'password') {
    try {
      var password = input.value;
      if (!password) {
        throw new Error('Ingrese contraseña para continuar');
      }
      var res = await fetch(`./api/session/login`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: gJSON.stringify({
          'username': sessionStorage.username,
          'password': password
        })
      });
      var data = await res.text();
      if (!res.ok) {
        let message = gJSON.parseable(data) ? gJSON.parse(data).message : 'Error al iniciar sesión';
        throw new Error(message);
      }
      data = gJSON.parse(data);
      gNotify.add({
        title: 'Operación correcta',
        body: `Bienvenido al sistema`,
        type: 'success'
      });
      if (checkbox.checked) {
        gCookie.set('SoDe-Remember', sessionStorage.username);
      } else{
        gCookie.clean('SoDe-Remember');
      }
      // gCookie.set('SoDe-Auth-Token', data.data.auth_token);
      // gCookie.set('SoDe-Auth-User', data.data.username);
      location.href = './home';
    } catch (error) {
      gNotify.add({
        title: 'Error de sesión',
        body: error.message,
        type: 'danger'
      });
    }
  } else {
    try {
      var username = input.value;
      if (!username) {
        throw new Error('Ingrese usuario para continuar');
      }
      var res = await fetch(`./api/users/get/${username}`);
      var data = await res.text();
      if (!res.ok) {
        let message = gJSON.parseable(data) ? gJSON.parse(data).message : 'Error al obtener usuario';
        throw new Error(message);
      }
      data = gJSON.parse(data);
      drawUser(data.data);
      gNotify.add({
        title: 'Operación correcta',
        body: `Se encontró el usuario ${username}`,
        type: 'success'
      });
    } catch (error) {
      gNotify.add({
        title: 'Error de sesión',
        body: error.message,
        type: 'danger'
      });
    }
  }
  gLoader.hide();
};

btn_forgot.onclick = () => {
  if (input.type == 'password') {
    gCookie.clean();
    location.reload();
  } else {
    console.log('Clicaste en olvidé mi contraseña');
  }
}