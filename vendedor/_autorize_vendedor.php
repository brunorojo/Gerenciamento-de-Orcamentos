<?php

/* Autorizar acesso apenas do admin */
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'vendedor') {
    echo 'Acesso não autorizado!';
    exit;
}
