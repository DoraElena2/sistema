// Función para iniciar sesión
document.getElementById('loginForm')?.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {
        action: 'login',
        correo: formData.get('correo'),
        password: formData.get('password')
    };

    const response = await fetch('http://localhost/backend/api/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (result.success) {
        alert('Login exitoso');
        window.location.href = 'menu_principal.html';  // Redirige al menú principal
    } else {
        alert('Credenciales incorrectas');
    }
});

// Función para registrar un nuevo paciente
document.getElementById('registroForm')?.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {
        action: 'crear_usuario',
        nombre: formData.get('nombre'),
        correo: formData.get('correo'),
        telefono: formData.get('telefono'),
        sexo: formData.get('sexo'),
        edad: formData.get('edad'),
        password: formData.get('password'),
        rol: 'paciente'
    };

    const response = await fetch('http://localhost/backend/api/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (result.success) {
        alert('Registro exitoso');
        window.location.href = 'login.html';  // Redirige a la página de inicio de sesión
    } else {
        alert('Error en el registro');
    }
});

// Función para registrar un nuevo usuario (administrador o dentista)
document.getElementById('altaUsuarioForm')?.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {
        action: 'crear_usuario',
        correo: formData.get('correo'),
        nombre: formData.get('nombre'),
        rol: formData.get('rol'),
        password: formData.get('password')
    };

    const response = await fetch('http://localhost/backend/api/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (result.success) {
        alert('Usuario registrado con éxito');
    } else {
        alert('Error al registrar el usuario');
    }
});

// Función para cargar citas en la lista de citas pendientes, realizadas o rechazadas
async function cargarCitas() {
    const response = await fetch('http://localhost/backend/api/index.php?citas');
    const citas = await response.json();

    const listaPendientes = document.getElementById('listaCitasPendientes');
    const listaRealizadas = document.getElementById('listaCitasRealizadas');
    const listaRechazadas = document.getElementById('listaCitasRechazadas');

    citas.forEach(cita => {
        const li = document.createElement('li');
        li.textContent = `Paciente: ${cita.paciente_id}, Tipo: ${cita.tipo_atencion}, Fecha: ${cita.fecha_deseada}`;

        if (cita.estado === 'Pendiente') {
            listaPendientes?.appendChild(li);
        } else if (cita.estado === 'Realizada') {
            listaRealizadas?.appendChild(li);
        } else if (cita.estado === 'Rechazada') {
            listaRechazadas?.appendChild(li);
        }
    });
}

if (window.location.pathname.endsWith('citas_pendientes.html')) {
    cargarCitas();
}
if (window.location.pathname.endsWith('citas_realizadas.html')) {
    cargarCitas();
}
if (window.location.pathname.endsWith('citas_rechazadas.html')) {
    cargarCitas();
}

// Función para reprogramar citas
document.getElementById('reprogramarForm')?.addEventListener('submit', async function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const data = {
        action: 'reprogramar_cita',
        cita_id: formData.get('cita_id'),  // Debes obtener este ID de alguna forma (por ejemplo, seleccionando la cita de una lista)
        fecha: formData.get('fecha')
    };

    const response = await fetch('http://localhost/backend/api/index.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    const result = await response.json();
    if (result.success) {
        alert('Cita reprogramada con éxito');
        window.location.href = 'citas_pendientes.html';  // Redirige a la lista de citas pendientes
    } else {
        alert('Error al reprogramar la cita');
    }
});

// Función para volver al menú principal
function volverAlMenu() {
    window.location.href = 'menu_principal.html';
}

// Función para cerrar sesión
function cerrarSesion() {
    // Implementa la lógica de cierre de sesión según cómo estés gestionando las sesiones del usuario
    window.location.href = 'login.html';
}
