window.onload = async () => {
  sessionStorage.clear();
  if (gCookie.get('SoDe-Remember')) {
    checkbox.checked = true;
  }
  try {
    /**
     * Comprobando si el usuario está logueado. Si lo está,
     * redirige a la página de inicio.
     */
    var res = await fetch(`./api/sesion/verificar`, {
      method: 'POST',
      headers: {
        'Sode-Auth-Required': 'Yes'
      }
    });
    var data = await res.json();
    if (!res.ok) {
      throw new Error(data.message);
    }
    location.href = './inicio';
  } catch (error) {
    /**
     * Comprobando si el usuario recordado existe. Si lo está, 
     * pinta sus datos para solicitar solo la contraseña
     */
    var sode_remember = gCookie.get('SoDe-Remember');
    if (!sode_remember) {
      return;
    }
    var res = await fetch(`./api/usuarios/obtener/${sode_remember}`);
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
    mostrarDatos(data.data);
  } finally {
    /**
     * Oculta la pantalla de carga
     */
    gLoader.ocultar();
  }
}

class gLoader {
  static mostrar() {
    loader.style.opacity = 1;
    loader.style.display = 'grid';
  }
  static ocultar() {
    loader.style.opacity = 0;
    setTimeout(() => {
      loader.style.display = 'none';
    }, 250);
  }
}

const mostrarDatos = (data) => {
  /**
   * Pinta los datos después de ingresar el usuario o
   * verificar que el usuario recordado existe
   */
  image.src = `./api/perfil/${data.id_relativo}/mini`;
  title.innerText = data.persona.nombres;
  description.innerText = data.rol.rol;
  input.type = 'password';
  input.value = null;
  label.innerText = 'Contraseña';
  btn_submit.innerText = 'Iniciar sesión';
  btn_forgot.innerText = 'Usar otra cuenta';
  sessionStorage.usuario = data.usuario;
}

image.onerror = () => {
  console.log('Falló al cargar la imagen');
  image.src = './images/logo.svg';
}

form.onsubmit = async (e) => {
  e.preventDefault();
  gLoader.mostrar();
  if (input.type == 'password') {
    try {
      /**
       * Verifica si la contraseña está vacía, si lo está,
       * arroja un error. Si no es así, envía una solicitud
       * POST al servidor con el nombre de usuario y la contraseña.
       * Si la solicitud no tiene éxito, arroja un error.
       * Si tiene éxito, redirige a la página de inicio.
       */
      var clave = input.value;
      if (!clave) {
        throw new Error('Ingrese contraseña para continuar');
      }
      var res = await fetch(`./api/sesion/ingresar`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: gJSON.stringify({
          'usuario': sessionStorage.usuario,
          'clave': clave
        })
      });
      var data = await res.text();
      if (!res.ok) {
        let mensaje = gJSON.parseable(data) ? gJSON.parse(data).message : 'Error al iniciar sesión';
        throw new Error(mensaje);
      }
      data = gJSON.parse(data);
      gNotify.add({
        title: 'Operación correcta',
        body: `Bienvenido al sistema`,
        type: 'success'
      });
      if (checkbox.checked) {
        gCookie.set('SoDe-Remember', sessionStorage.usuario);
      } else {
        gCookie.clean('SoDe-Remember');
      }
      location.href = './inicio';
    } catch (error) {
      /**
       * Muestra el error en forma de notificación
       */
      gNotify.add({
        title: 'Error de sesión',
        body: error.message,
        type: 'danger'
      });
    }
  } else {
    try {
      /**
       * Comprobando si el usuario existe. Si existe,
       * muestra los datos del usuario.
       */
      var usuario = input.value;
      if (!usuario) {
        throw new Error('Ingrese usuario para continuar');
      }
      var res = await fetch(`./api/usuarios/obtener/${usuario}`);
      var data = await res.text();
      if (!res.ok) {
        let message = gJSON.parseable(data) ? gJSON.parse(data).message : 'Error al obtener usuario';
        throw new Error(message);
      }
      data = gJSON.parse(data);
      mostrarDatos(data.data);
      gNotify.add({
        title: 'Operación correcta',
        body: `Se encontró el usuario ${usuario}`,
        type: 'success'
      });
    } catch (error) {
      /**
       * Muestra el error en forma de notificación
       */
      gNotify.add({
        title: 'Error de sesión',
        body: error.message,
        type: 'danger'
      });
    }
  }
  gLoader.ocultar();
};

btn_forgot.onclick = () => {
  if (input.type == 'password') {
    gCookie.clean();
    location.reload();
  } else {
    console.log('Clicaste en olvidé mi contraseña');
  }
}