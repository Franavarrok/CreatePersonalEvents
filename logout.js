document.addEventListener('DOMContentLoaded', function() {
    // 1. Obtener el botón por su ID
    const logoutBtn = document.getElementById('logoutButton');

    if (logoutBtn) {
        // 2. Añadir el escuchador de eventos al hacer clic
        logoutBtn.addEventListener('click', function() {
            // 3. Redirigir la ventana a la ruta donde está el script de PHP.
            // Esto le dice al servidor que ejecute el código PHP de destrucción de sesión.
            window.location.href = 'logout.php';
        });
    }
});
