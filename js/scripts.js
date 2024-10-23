//login.html

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevenir el envío por defecto del formulario
      validateForm();
    });
  });
  
  function validateForm() {
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("psw").value.trim();
    const errors = []; // Array para almacenar los mensajes de error
  
    // Validación del correo electrónico
    if (!validateEmail(email)) {
      errors.push("Por favor, introduce un correo electrónico válido.");
    }
  
    // Validación de la contraseña
    if (password === "" || /^\s+$/.test(password)) {
      errors.push("Por favor, introduce tu contraseña.");
    }
  
    // Mostrar los errores agrupados si existen
    if (errors.length > 0) {
      alert(errors.join("\n")); // Unir los mensajes de error con saltos de línea
    } else {
      // Si no hay errores, redirigir al usuario
      window.location.href = "identificado.html";
    }
  }
  
  function validateEmail(email) {
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
  }
  
// registro.js

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registrationForm");
    form.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevenir el envío por defecto del formulario
      validateRegistrationForm();
    });
  });
  
  function validateRegistrationForm() {
    const errors = [];
    resetErrorStyles(); // Limpiar los estilos de error previos
  
    // Validación del nombre de usuario
    const username = document.getElementById("usu");
    if (!/^[A-Za-z][A-Za-z0-9]{2,14}$/.test(username.value.trim())) {
      errors.push("El nombre de usuario debe contener entre 3 y 15 caracteres alfanuméricos y no puede empezar con un número.");
      applyErrorStyles(username);
    }
  
    // Validación de la contraseña
    const password = document.getElementById("pwd");
    if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d\-_]{6,15}$/.test(password.value)) {
      errors.push("La contraseña debe tener entre 6 y 15 caracteres, incluir al menos una letra mayúscula, una minúscula y un número.");
      applyErrorStyles(password);
    }
  
    // Validación de la confirmación de la contraseña
    const confirmPassword = document.getElementById("pwd2");
    if (password.value !== confirmPassword.value) {
      errors.push("Las contraseñas no coinciden.");
      applyErrorStyles(confirmPassword);
    }
  
    // Validación del correo electrónico
    const email = document.getElementById("email");
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
      errors.push("El correo electrónico no es válido.");
      applyErrorStyles(email);
    }
  
    // Validación del género
    const gender = document.getElementById("genero");
    if (gender.value === "") {
      errors.push("Por favor, selecciona un género.");
      applyErrorStyles(gender);
    }
  
    // Validación de la fecha de nacimiento (mayoría de edad)
    const birthDate = document.getElementById("fnac");
    if (!isAdult(new Date(birthDate.value))) {
      errors.push("Debes ser mayor de 18 años.");
      applyErrorStyles(birthDate);
    }
  
    // Validación de la ciudad de residencia
    const city = document.getElementById("city");
    if (city.value.trim() === "" || /^\s+$/.test(city.value)) {
      errors.push("Por favor, introduce tu ciudad de residencia.");
      applyErrorStyles(city);
    }
  
    // Validación del país de residencia
    const country = document.getElementById("country");
    if (country.value === "") {
      errors.push("Por favor, selecciona un país.");
      applyErrorStyles(country);
    }
  
    // Mostrar los errores agrupados si existen
    if (errors.length > 0) {
      alert(errors.join("\n")); // Unir los mensajes de error con saltos de línea
    } else {
      // Si no hay errores, mostrar mensaje de éxito y redirigir
      alert("Registro exitoso. Ahora serás redirigido a la página de inicio de sesión.");
      window.location.href = "login.html";
    }
  }
  
  function applyErrorStyles(inputElement) {
    inputElement.classList.add("input-error"); // Aplicar estilo de error al campo
    const label = inputElement.previousElementSibling; // Asumimos que el label está antes del input
    if (label) {
      label.classList.add("label-error");
    }
  }
  
  function resetErrorStyles() {
    const errorInputs = document.querySelectorAll(".input-error");
    errorInputs.forEach(input => input.classList.remove("input-error"));
  
    const errorLabels = document.querySelectorAll(".label-error");
    errorLabels.forEach(label => label.classList.remove("label-error"));
  }
  
  // Función para comprobar si la persona es mayor de 18 años
  function isAdult(birthDate) {
    const today = new Date();
    const age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();
    const dayDiff = today.getDate() - birthDate.getDate();
    return age > 18 || (age === 18 && (monthDiff > 0 || (monthDiff === 0 && dayDiff >= 0)));
  }