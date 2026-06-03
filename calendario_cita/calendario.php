<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario Interactivo</title>
    <link rel="stylesheet" href="../css/style_calendario.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Afacad:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        /* Estilo para el día actual */
        .current-day {
            background-color: rgb(98, 177, 178); /* Color de fondo diferente */
            color: black; /* Color de texto para el día actual */
            border-radius: 10px; /* Para darle un aspecto circular */
            border: 1px solid black;
        }

        /* Estilo para días deshabilitados */
        .disabled {
            color: grey;
            pointer-events: none; /* Deshabilitar clic */
            opacity: 0.5;
        }
    </style>
</head>
<body>

    <div id="barra">
        <div id="calendario"><img src="../img/cita.png" class="icono">CALENDARIO</div>
        <div id="regresar"><a href="../home.php">Regresar</a></div>
    </div>

    <div id="calendar" class="calendar">
        <h2 id="month-year"></h2>
        <div class="days">
            <div class="day-name">Dom</div>
            <div class="day-name">Lun</div>
            <div class="day-name">Mar</div>
            <div class="day-name">Mié</div>
            <div class="day-name">Jue</div>
            <div class="day-name">Vie</div>
            <div class="day-name">Sáb</div>
        </div>
        <div class="days" id="days"></div>
        <div class="controls">
            <button onclick="prevMonth()" class="boton">Mes anterior</button>
            <button onclick="nextMonth()" class="boton">Siguiente mes</button>
        </div>
    </div>

    <script>
        ///////////////////////////////////////////////////////////////
        // En caso de que sea paciente existente
        const urlParams = new URLSearchParams(window.location.search);
        const idPaciente = urlParams.get('id_paciente');
        ///////////////////////////////////////////////////////////////

        // Efecto de flotar hacia arriba solo para el div 'calendar' al cargar la página
        window.onload = function() {
            document.getElementById('calendar').classList.add('float-up'); // Aplicar la clase al div calendar
        };

        let currentDate = new Date(); // Fecha actual
        let monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        let today = new Date(); // Fecha actual para resaltar el día

        // Función para actualizar el calendario
        function updateCalendar() {
            let month = currentDate.getMonth(); // Obtener mes actual
            let year = currentDate.getFullYear(); // Obtener año actual

            // Actualizar el título del mes
            document.getElementById('month-year').innerText = monthNames[month] + " " + year;

            let daysInMonth = new Date(year, month + 1, 0).getDate(); // Días del mes actual
            let firstDay = new Date(year, month, 1).getDay(); // Día de la semana del primer día del mes

            let daysContainer = document.getElementById('days');
            daysContainer.innerHTML = ''; // Limpiar los días previos

            // Deshabilitar botón de mes anterior si estamos en el mes actual o anterior
            let prevButton = document.querySelector('.controls button:first-child');
            if (year === today.getFullYear() && month <= today.getMonth()) {
                prevButton.disabled = true;
            } else {
                prevButton.disabled = false;
            }

            // Rellenar los días con espacios vacíos hasta el primer día
            for (let i = 0; i < firstDay; i++) {
                let emptyCell = document.createElement('div');
                daysContainer.appendChild(emptyCell);
            }

            // Crear los días del mes con un enlace para cada uno
            for (let day = 1; day <= daysInMonth; day++) {
                let dayCell = document.createElement('div');
                dayCell.innerText = day;
                dayCell.className = "day";

                let cellDate = new Date(year, month, day);

                // Verificar si es el día actual para resaltarlo
                if (day === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                    dayCell.classList.add('current-day'); // Aplicar la clase al día actual
                }

                // Deshabilitar días anteriores a la fecha actual
                if (cellDate < new Date(today.getFullYear(), today.getMonth(), today.getDate())) {

                    dayCell.classList.add('disabled'); // Aplicar clase para estilo deshabilitado
                    dayCell.onclick = null; // Eliminar la función de clic
                } else {
                    // Configurar el redireccionamiento al hacer clic en el día
                    dayCell.onclick = function() {
                        let url = `horarios_cita.php?dia=${day}&mes=${month + 1}&anio=${year}`;
                        
                        // Agregar id_paciente si está en la URL
                        if (idPaciente) {
                            url += `&id_paciente=${idPaciente}`;
                        }

                        window.location.href = url;
                    };
                }

                daysContainer.appendChild(dayCell);
            }
        }

        // Función para avanzar al siguiente mes
        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1); // Cambiar al siguiente mes
            updateCalendar(); // Actualizar el calendario
        }

        // Función para retroceder al mes anterior
        function prevMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1); // Cambiar al mes anterior
            updateCalendar(); // Actualizar el calendario
        }

        // Inicializar el calendario al cargar la página
        updateCalendar();
    </script>

</body>
</html>
