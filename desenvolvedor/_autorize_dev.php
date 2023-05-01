<?php
/* Autorizar acesso.*/
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'dev') {
    echo 'Acesso não autorizado!';
    exit;
}
?>