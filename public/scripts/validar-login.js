function validarLogin() {
  let usu = document.getElementById('usu').value.trim(),
      pwd = document.getElementById('pwd').value.trim(),
      usernameError = document.getElementById('usernameError'),
      passwordError = document.getElementById('passwordError'),
      esValido = true;

  if (usu === '') {
    usernameError.textContent = 'El nombre de usuario no puede estar vacío o contener espacios en blanco.';
    esValido = false;
  } else {
    usernameError.textContent = ''; // reseteo el mensaje de error
  }

  if (pwd === '') {
    passwordError.textContent = 'La contraseña no puede estar vacía o contener espacios en blanco.';
    esValido = false;
  } else {
    passwordError.textContent = '';
  }

  return esValido;
}

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('miForm').addEventListener('submit', (event) => {
    event.preventDefault();
    if (validarLogin()) {
      window.location.href = 'identificado.html';
    }
  });
});