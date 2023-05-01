<?php
/* Autorizar acesso. */
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'admin') {
    echo 'Acesso não autorizado!';
    exit;
}
?>