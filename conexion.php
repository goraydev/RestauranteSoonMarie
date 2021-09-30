<?php
$mysqli = new mysqli('localhost:3307', 'root', '', 'restaurantesoonmarie');
if ($mysqli->connect_error) {
    die('Error en la conexión' . $mysqli->connect_error);
}
