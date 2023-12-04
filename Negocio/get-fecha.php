<?php
$fecha = new DateTime($fecha_registro);

$nombre_dia = [
    'Monday'    => 'Lunes',
    'Tuesday'   => 'Martes',
    'Wednesday' => 'Miércoles',
    'Thursday'  => 'Jueves',
    'Friday'    => 'Viernes',
    'Saturday'  => 'Sábado',
    'Sunday'    => 'Domingo',
];

$nombre_mes = [
    'January'   => 'enero',
    'February'  => 'febrero',
    'March'     => 'marzo',
    'April'     => 'abril',
    'May'       => 'mayo',
    'June'      => 'junio',
    'July'      => 'julio',
    'August'    => 'agosto',
    'September' => 'septiembre',
    'October'   => 'octubre',
    'November'  => 'noviembre',
    'December'  => 'diciembre',
];

$fecha_formateada = $nombre_dia[$fecha->format('l')] . ' ' . $fecha->format('j') . ' de ' . $nombre_mes[$fecha->format('F')] . ' del ' . $fecha->format('Y');
echo '<small class="sombra">Publicado el ' . $fecha_formateada . '</small>';
?>