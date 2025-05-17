const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?: [A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/;
const telefonoRegex = /^\d{10}$/;
const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const contrasenaRegex = /^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/;

const telefonoPersona = document.getElementById('telefono');
const correoPersona = document.getElementById('email');
const clavePersona = document.getElementById('pwd');
const nombrePersona = document.getElementById('nombrePersona');

/**
 * Manejador del evento blur para validar el campo nombrePersona.
 * Si el valor está vacío o no cumple el patrón de sólo letras y espacios,
 * muestra una notificación de error mediante mostrarNotificacion.
 *
 * @param {FocusEvent} e – Objeto de evento blur.
 * @returns {void}
 */
nombrePersona.addEventListener('blur', (e) => {
  const valor = nombrePersona.value.trim();
  if (valor === '' || !nombreRegex.test(valor)) {
    mostrarNotificacion(
      'Por favor, ingresa un nombre válido (solo letras y espacios).',
      true
    );
  }
});


/**
 * Manejador del evento blur para validar el campo telefonoPersona.
 * Recorta espacios en blanco y comprueba que el valor no esté vacío
 * y cumpla el patrón de 10 dígitos numéricos. Si no es válido,
 * muestra una notificación de error mediante mostrarNotificacion.
 *
 * @param {FocusEvent} e – Objeto de evento blur.
 * @returns {void}
 */
telefonoPersona.addEventListener('blur', (e) => {
  const valor = telefonoPersona.value.trim();
  if (valor === '' || !telefonoRegex.test(valor)) {
    mostrarNotificacion('Por favor, ingresa un número de teléfono válido (10 dígitos).');
  }
});



/**
 * Manejador del evento blur para validar el campo correoPersona.
 * Recorta espacios en blanco y comprueba que el valor no esté vacío
 * y cumpla el patrón de correo electrónico. Si no es válido,
 * muestra una notificación de error con mostrarNotificacion.
 *
 * @param {FocusEvent} e – Objeto de evento blur.
 * @returns {void}
 */
correoPersona.addEventListener('blur', (e) => {
  const valor = correoPersona.value.trim();
  if (valor === '' || !correoRegex.test(valor)) {
    mostrarNotificacion('Por favor, ingresa un correo electrónico válido.', true);
  }
});



/**
 * Manejador del evento blur para validar el campo clavePersona.
 * Recorta espacios en blanco y comprueba que el valor no esté vacío
 * y cumpla el patrón de contraseña (mínimo 8 caracteres, al menos
 * una letra y un número). Si no es válido, muestra una notificación
 * de error con mostrarNotificacion.
 *
 * @param {FocusEvent} e – Objeto de evento blur.
 * @returns {void}
 */
clavePersona.addEventListener('blur', (e) => {
  const valor = clavePersona.value.trim();
  if (valor === '' || !contrasenaRegex.test(valor)) {
    mostrarNotificacion(
      'La contraseña debe tener al menos 8 caracteres, incluyendo una letra y un número.',
      true
    );
  }
});


/**
 * Muestra una notificación estilo “Toast” en la esquina inferior derecha.
 * Crea dinámicamente un elemento <div> con el mensaje y estilos CSS, lo inserta
 * en el body, y anima su entrada y salida automáticamente.
 *
 * @param {string} mensaje – El texto a mostrar dentro del Toast.
 * @param {boolean} [esError=true] – Si es true, el fondo será rojo; si es false, verde.
 * @returns {void}
 */
function mostrarNotificacion(mensaje, esError = true) {
    const toast = document.createElement('div');
    toast.style.position = 'fixed';
    toast.style.bottom = '20px';
    toast.style.right = '20px';
    toast.style.padding = '12px 24px';
    toast.style.backgroundColor = esError ? '#ff4444' : '#4CAF50';
    toast.style.color = 'white';
    toast.style.borderRadius = '4px';
    toast.style.boxShadow = '0 2px 10px rgba(0,0,0,0.2)';
    toast.style.zIndex = '10000';
    toast.style.maxWidth = '300px';
    toast.style.transition = 'all 0.3s ease';
    toast.style.transform = 'translateX(200%)';
    toast.style.opacity = '0';
    toast.textContent = mensaje;
    
    document.body.appendChild(toast);
    
    // Animación de entrada
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
        toast.style.opacity = '1';
    }, 10);
    
    // Desaparece después de 3 segundos
    setTimeout(() => {
        toast.style.transform = 'translateX(200%)';
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}