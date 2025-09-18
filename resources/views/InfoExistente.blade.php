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

    <title>Información personal</title>
    <style>
        .color_movistar{
            background-color: #019DF4;
            color:white;
        }
:root {
    --highlight-color: #019DF4;

    --item-height: 40px;
}




.input-container {
    margin: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
}



/* Modal del selector de fecha */
.modal-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    opacity: 1;
    transition: opacity 0.3s ease;
}

.modal-background.hidden {
    opacity: 0;
    pointer-events: none; /* No interactuable cuando está oculto */
}

.date-picker-container {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    width: 320px;
    padding: 20px;
    display: flex;
    flex-direction: column;
}

.date-picker {
    display: flex;
    justify-content: space-around;
    padding: 20px 0;
    position: relative;
}

.date-picker::before,
.date-picker::after {
    content: '';
    position: absolute;
    left: 10px;
    right: 10px;
    height: 1px;
    background-color: var(--border-color);
    z-index: 1;
}

.date-picker::before {
    top: calc(50% - var(--item-height) / 2);
}

.date-picker::after {
    top: calc(50% + var(--item-height) / 2);
}

.column {
    flex: 1;
    text-align: center;
    height: calc(var(--item-height) * 2); /* Aumenta la altura para que 5 elementos quepan */
    overflow-y: scroll;
    -ms-overflow-style: none;
    scrollbar-width: none;
    /* Aumenta el padding para que el último elemento pueda llegar al centro */
    padding: calc(var(--item-height) * 2) 0;
}

.column::-webkit-scrollbar {
    display: none;
}

.item {
    height: var(--item-height);
    line-height: var(--item-height);
    font-size: 0.9em;
    color: #666;
    transition: all 0.2s ease-in-out;
    user-select: none; /* Evita la selección de texto */
}

.item.active {
    font-weight: bold;
    color: #000;
    font-size: 1.0em;
}

.button-container {
    display: flex;
    justify-content: flex-end;
    padding-top: 10px;
    gap: 10px;
}

.button-container button {
    background: none;
    border: none;
    color: var(--highlight-color);
    font-size: 1em;
    padding: 10px 15px;
    cursor: pointer;
    text-transform: uppercase;
    font-weight: bold;
    transition: background-color 0.2s;
    border-radius: 4px;
}

.button-container button:hover {
    background-color: #f0f0f0;
}
    </style>
</head>

<body>
    <nav class="navbar navbar-light color_movistar d-flex align-items-center ps-3">
        <h4 class="m-0">Datos personales</h4>
    </nav>
    <br>
    <div class="container">
    <div class="card">
        <h1>✅ Solicitud registrada</h1>
        <p>Hemos recibido tu formulario.</p>
        <p>Estos son los datos que enviaste:</p>
        <p><strong>Nombre:</strong> {{ $user['nombre'] }} {{ $user['apellido_p'] }} {{ $user['apellido_m'] }}</p>
        <p><strong>Correo:</strong> {{ $user['correo'] }}</p>
        <p><strong>Fecha de nacimiento:</strong> {{ $user['fecha_nacimiento'] }}</p>
        <p><em>Fecha de registro: {{ $user['created_at'] }}</em></p>
        <br>
    </div>

    </div>
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
