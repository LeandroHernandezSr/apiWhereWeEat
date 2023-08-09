<?php

if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['accion']) && $_GET['accion']=='saludar'){
    echo "Estoy desde PHP!";
}