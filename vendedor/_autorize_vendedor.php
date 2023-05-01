<?php
/* Autorizar acesso.*/
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'vendedor') {
    echo 'Acesso não autorizado!';
    exit;
}
?>