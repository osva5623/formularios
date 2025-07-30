<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cambiate de plan</title>
</head>

<body>
    <nav class="navbar navbar-light bg-primary">

    </nav>
    <div class="container">

        <form id="myForm">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="hidden" name="usuario" value="{{ $usuario }}" class="form-control" id="usuario">

                <input type="text" class="form-control" name="name" id="name" required>

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" name="apellidoP" id="apellidoP" required>

                <label for="apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" name="apellidoM" id="apellidoM" required>
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" required>
                <div class="row g-12">
                    <!-- Día -->
                    <div class="col-md-1">
                        <label for="day" class="form-label">Día</label>
                        <select class="form-control" id="day" name="day" required>
                            <option selected disabled>Selecciona el día</option>
                            <!-- JS rellenará -->
                        </select>
                    </div>

                    <!-- Mes -->
                    <div class="col-md-2">
                        <label for="month" class="form-label">Mes</label>
                        <select class="form-control" id="month" name="month" required>
                            <option selected disabled>Selecciona el mes</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>
                        </select>
                    </div>

                    <!-- Año -->
                    <div class="col-md-1">
                        <label for="year" class="form-label">Año</label>
                        <select class="form-control" id="year" name="year" required>
                            <option selected disabled>Selecciona el año</option>
                            <!-- JS rellenará -->
                        </select>
                    </div>
                </div>
            </div>

            <input class="btn btn-primary" value="Enviar" class="btn btn-primary mt-3" type="submit">
        </form>
    </div>
    <script>
document.getElementById("myForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());

    try {
        const response = await fetch("https://92753b7c2711.ngrok-free.app/submit", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        if (response.ok) {
            const result = await response.json();

            Swal.fire({
                icon: 'success',
                title: 'Formulario enviado',
                text: '✅ ¡Tu información fue enviada correctamente! puedes cerrar el navegador.',
                confirmButtonText: 'Aceptar'
            }).then(() => {
                // Redirección después de aceptar
                window.close();
            });

        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error en el envío',
                text: '❌ Hubo un problema al enviar el formulario.'
            });
        }
    } catch (error) {
        console.error("Error de red:", error);
        Swal.fire({
            icon: 'error',
            title: 'Error de conexión',
            text: '❌ No se pudo conectar con el servidor.'
        });
    }
});
        // Rellenar días del 1 al 31
        const daySelect = document.getElementById('day');
        for (let i = 1; i <= 31; i++) {
            daySelect.innerHTML += `<option value="${i}">${i}</option>`;
        }

        // Rellenar años desde 1920 hasta año actual - 10 (por ejemplo para mayores de 10 años)
        const yearSelect = document.getElementById('year');
        const currentYear = new Date().getFullYear();
        for (let i = currentYear - 10; i >= 1920; i--) {
            yearSelect.innerHTML += `<option value="${i}">${i}</option>`;
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
