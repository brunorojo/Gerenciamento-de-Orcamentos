<?php

/* Autorizar acesso apenas do admin */
if (isset($_SESSION['usuario']) && $_SESSION['usuario'] != 'admin') {
    echo 'Acesso não autorizado!';
    exit;
}
