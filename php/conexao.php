<?php

function conectar() {
    return $conn = mysqli_connect("localhost", "root", "", "delivery");
}
