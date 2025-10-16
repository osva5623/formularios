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
        .color_movistar {
            background-color: #019DF4;
            color: white;
        }




        :root {
            --highlight-color: #019DF4;
            --background-overlay: rgba(0, 0, 0, 0.4);
            --item-height: 42px;
            --font-family: 'Poppins', 'Roboto', sans-serif;
        }

        /* Fondo difuminado */
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: var(--background-overlay);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .modal-background.hidden {
            opacity: 0;
            pointer-events: none;
        }

        /* Contenedor principal del picker */
        .date-picker-container {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
            width: 340px;
            padding: 20px 16px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: var(--font-family);
            transform: translateY(20px);
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .labels,
        .labels-bottom {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .labels span,
        .labels-bottom span {
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 0.85em;
            font-weight: 600;
            color: #555;
        }

        .labels span::before {
            content: "▲";
            font-size: 1.3em;
            margin-bottom: 2px;
        }

        .labels-bottom span::after {
            content: "▼";
            font-size: 1.3em;
            margin-top: 2px;
        }

        /* Cuerpo del selector */
        .date-picker {
            display: flex;
            justify-content: space-around;
            align-items: center;
            position: relative;
            padding: 10px 0;
            width: 100%;
            height: 160px;
            overflow: hidden;
        }

        /* Zona resaltada (la fila activa) */
        .date-picker::before {
            content: "";
            position: absolute;
            top: 50%;
            left: 12px;
            right: 12px;
            height: var(--item-height);
            background-color: rgba(1, 157, 244, 0.08);
            border-radius: 8px;
            transform: translateY(-50%);
            pointer-events: none;
        }

        /* Columnas */
        .column {
            flex: 1;
            text-align: center;
            height: 100%;
            overflow-y: scroll;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
            padding: 80px 0;
        }

        .column::-webkit-scrollbar {
            display: none;
        }

        /* Ítems */
        .item {
            height: var(--item-height);
            line-height: var(--item-height);
            color: #777;
            font-size: 0.95em;
            transition: all 0.2s ease-in-out;
            user-select: none;
        }

        .item.active {
            color: var(--highlight-color);
            font-weight: 600;
            font-size: 1.05em;
            transform: scale(1.05);
        }

        /* Botones */
        .button-container {
            width: 100%;
            display: flex;
            justify-content: center;
            padding-top: 10px;
        }

        .accept-button {
            width: 90%;
            text-align: center;
            background: linear-gradient(90deg, #00AEEF, #019DF4);
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            padding: 10px 0;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0 3px 6px rgba(0, 157, 244, 0.3);
            transition: all 0.2s ease;
        }

        .accept-button:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 12px rgba(0, 157, 244, 0.4);
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light color_movistar d-flex align-items-center ps-3">
        <h4 class="m-0">Datos personales</h4>
    </nav>
    <br>
    <div class="container">

        <form id="myForm">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="hidden" name="usuario" value="{{ $usuario }}" class="form-control" id="usuario">


                <input type="text" class="form-control " name="name" id="name" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"
                    title="Solo letras" autocomplete="off" required>

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" name="apellidoP" id="apellidoP" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"
                    title="Solo letras" autocomplete="off" required>

                <label for="apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" name="apellidoM" id="apellidoM" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+"
                    title="Solo letras" autocomplete="off" required>
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email" autocomplete="off" required>
                <label for="fecha_na">Fecha de nacimiento</label>
                <input type="text" id="fecha-input" class="form-control" name="fecha_na" pattern="[0-9\-]+"
                    title="formato de fecha: aaaa-mm-dd" autocomplete="off" required>
            </div>
            <div class="modal-background hidden">
                <div class="date-picker-container">
                    <div class="labels">
                        <span>Día</span>
                        <span>Mes</span>
                        <span>Año</span>
                    </div>
                    <div class="date-picker">
                        <div class="column days-column">
                        </div>
                        <div class="column months-column"></div>
                        <div class="column years-column"></div>
                    </div>
                    <div class="labels-bottom">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="button-container">
                        <div class="accept-button btn color_movistar">ACEPTAR</div>
                    </div>
                </div>
            </div>

            <input class="btn color_movistar btn-lg btn-block" value="Enviar" class="btn btn-primary mt-3"
                type="submit">
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const fechaInput = document.getElementById('fecha-input');
            const modalBackground = document.querySelector('.modal-background');
            const daysColumn = document.querySelector('.days-column');
            const monthsColumn = document.querySelector('.months-column');
            const yearsColumn = document.querySelector('.years-column');
            const acceptButton = document.querySelector('.accept-button');
            const cancelButton = document.querySelector('.cancel-button');

            let selectedValues = {
                day: 0,
                month: 0,
                year: 0
            };

            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            const itemHeight = 40; // Debe coincidir con el CSS

            // --- Funciones para generar contenido dinámico ---

            const addPadding = (column) => {
                // Añade 2 divs vacíos de padding al principio y al final
                for (let i = 0; i < 2; i++) {
                    column.prepend(document.createElement('div'));
                    column.appendChild(document.createElement('div'));
                }
            };

            const generateDays = (year, month) => {
                daysColumn.innerHTML = '';
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let i = 1; i <= daysInMonth; i++) {
                    const item = document.createElement('div');
                    item.classList.add('item');
                    item.textContent = i;
                    item.dataset.value = i;
                    daysColumn.appendChild(item);
                }
                addPadding(daysColumn);

                if (selectedValues.day > daysInMonth) {
                    selectedValues.day = daysInMonth;
                }
            };

            const generateMonths = () => {
                monthsColumn.innerHTML = '';
                months.forEach((month, index) => {
                    const item = document.createElement('div');
                    item.classList.add('item');
                    item.textContent = month;
                    item.dataset.value = index;
                    monthsColumn.appendChild(item);
                });
                addPadding(monthsColumn);
            };

            const generateYears = () => {
                yearsColumn.innerHTML = '';
                const currentYear = new Date().getFullYear();



                for (let i = currentYear - 18; i >= currentYear - 90; i--) {
                    const item = document.createElement('div');
                    item.classList.add('item');
                    item.textContent = i;
                    item.dataset.value = i;
                    yearsColumn.appendChild(item);
                }
                addPadding(yearsColumn);
            };

            // --- Lógica de selección y scroll ---

            const findClosestElement = (column) => {
                const items = column.querySelectorAll('.item');
                let closestItem = null;
                let minDistance = Infinity;
                const columnCenter = column.scrollTop + (column.clientHeight / 2);

                items.forEach(item => {
                    // Se calcula la distancia al centro del elemento, ignorando el padding
                    const itemCenter = item.offsetTop + (item.clientHeight / 2);
                    const distance = Math.abs(columnCenter - itemCenter);

                    if (distance < minDistance) {
                        minDistance = distance;
                        closestItem = item;
                    }
                });
                return closestItem;
            };

            const selectClosestElement = (column, type) => {
                const closest = findClosestElement(column);
                if (closest) {
                    const offset = closest.offsetTop - (column.clientHeight / 2) + (closest.clientHeight / 2);

                    // Usar requestAnimationFrame para un scroll más suave
                    column.scrollTo({
                        top: offset,
                        behavior: 'smooth'
                    });

                    column.querySelectorAll('.item').forEach(el => el.classList.remove('active'));
                    closest.classList.add('active');

                    let value = parseInt(closest.dataset.value);
                    if (selectedValues[type] !== value) {
                        selectedValues[type] = value;
                        if (type === 'month' || type === 'year') {
                            generateDays(selectedValues.year, selectedValues.month);
                            selectElement(daysColumn, selectedValues.day);
                        }
                    }
                }
            };

            const selectElement = (column, value) => {
                const items = column.querySelectorAll('.item');
                let itemToSelect = null;
                items.forEach(item => {
                    if (parseInt(item.dataset.value) === value) {
                        itemToSelect = item;
                    }
                });

                if (itemToSelect) {
                    column.querySelectorAll('.item').forEach(el => el.classList.remove('active'));
                    itemToSelect.classList.add('active');
                    const offset = itemToSelect.offsetTop - (column.clientHeight / 2) + (itemToSelect.clientHeight / 2);
                    column.scrollTop = offset;
                }
            };

            // --- Eventos de UI ---

            const handleScrollEnd = (column, type) => {
                clearTimeout(column.scrollTimeout);
                column.scrollTimeout = setTimeout(() => {
                    selectClosestElement(column, type);
                }, 150);
            };

            daysColumn.addEventListener('scroll', () => handleScrollEnd(daysColumn, 'day'));
            monthsColumn.addEventListener('scroll', () => handleScrollEnd(monthsColumn, 'month'));
            yearsColumn.addEventListener('scroll', () => handleScrollEnd(yearsColumn, 'year'));

            // Abrir el modal
            fechaInput.addEventListener('click', () => {
                const now = new Date();
                currentYear = new Date().getFullYear();
                selectedValues.day = now.getDate();
                selectedValues.month = now.getMonth();
                selectedValues.year = currentYear - 18;

                generateYears();
                generateMonths();
                generateDays(selectedValues.year, selectedValues.month);

                selectElement(yearsColumn, selectedValues.year);
                selectElement(monthsColumn, selectedValues.month);
                selectElement(daysColumn, selectedValues.day);

                modalBackground.classList.remove('hidden');
            });

            //   cancelButton.addEventListener('click', () => {
            //       modalBackground.classList.add('hidden');
            //   });

            acceptButton.addEventListener('click', () => {
                const formattedDate = `${selectedValues.year}-${selectedValues.month + 1}-${selectedValues.day}`;
                fechaInput.value = formattedDate;
                modalBackground.classList.add('hidden');
            });
        });


        const form = document.getElementById("myForm")


        enviarTracking('formulario_cargado', { pagina: window.location.href });
        const ENDPOINT_TRACKING = 'https://10b83db3f512.ngrok-free.app/api/tracking'; // 🔁 tu endpoint real
        const enviarTracking = async (evento, datos = {}) => {
            const tracking = {
                evento,
                timestamp: new Date().toISOString(),
                usuario,
                datos
            };

            try {
                await fetch(ENDPOINT_TRACKING, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(tracking)
                });
                console.log('Tracking enviado:', tracking);
            } catch (error) {
                console.error('Error al enviar tracking:', error);
            }
        };

        // Lista de dominios permitidos (todo en minúsculas)
        const allowedDomains = [
            'gmail.com',
            'hotmail.com',
            'outlook.com',
            'yahoo.com',
            'icloud.com',
            'live.com',
            'protonmail.com',
            'me.com',
            'mac.com',
            'yahoo.com.mx',
            'hotmail.com.mx',
            'outlook.com.mx',
            'live.com.mx',
            'prodigy.net.mx',
            'infinitum.net.mx',
            'terra.com.mx',
            'axtel.net',
            'izzi.mx',
            'megacable.com.mx',
            'une.net.mx',
            'protonmail.com',
            'zoho.com',
            'gmx.com',
            'mail.com',
            'aol.com',
            'tutanota.com',
            'startmail.com',
            'hushmail.com',
            'educacion.gob.mx',
            'sep.gob.mx',
            'gob.mx',
            'unam.mx',
            'ipn.mx',
            'tec.mx',
            'udg.mx',
            'uanl.mx',
            'uabc.mx',
            'itesm.mx',
            'uady.mx',
            'universidad.edu.mx'
        ];



        const email = document.getElementById('email');

        email.addEventListener('input', () => {
            // limpia cualquier error personalizado para que el browser re-evalúe el campo
            email.setCustomValidity('');
        });


        form.addEventListener("submit", async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const data = Object.fromEntries(formData.entries());

            const emailVal = email.value.trim();


            email.setCustomValidity("");

            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            // Validación dominio del email
            const lowerEmail = emailVal.toLowerCase();
            const parts = lowerEmail.split('@');
            if (parts.length !== 2 || parts[0].length === 0 || parts[1].length === 0) {
                email.setCustomValidity('Formato de correo inválido.');
                email.reportValidity();
                return;
            }

            const domain = parts[1];
            if (!allowedDomains.includes(domain)) {

                email.setCustomValidity('Por favor ingresa un domino valido');
                email.reportValidity();
                return;
            }

            try {
                const response = await fetch("https://10b83db3f512.ngrok-free.app/submit", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const result = await response.json();
                    await enviarTracking('formulario_enviado', { datosFormulario: data });
                    Swal.fire({
                        icon: 'success',
                        title: 'Listo',
                        text: 'Tu información se envió correctamente. Da clic en continuar',
                        confirmButtonColor: '#019DF4',
                        confirmButtonText: 'Continuar'
                    }).then(() => {
                        window.close();
                    });
                } else {
                    await enviarTracking('Error_envio_Formulario', { datosFormulario: data });
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: '❌ Hubo un problema al enviar tu información'
                    });
                }
            } catch (error) {
                await enviarTracking('Error_desconocido', { datosFormulario: data });
                console.error("Error de red:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: '❌ No se pudo conectar con el servidor.'
                });
            }

        });

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
