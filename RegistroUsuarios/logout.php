<?php
require_once __DIR__ . '/classes/Sessao.php';
Sessao::destruir();
header("Location: login.php");
exit;
