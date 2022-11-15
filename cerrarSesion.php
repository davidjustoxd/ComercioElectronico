<?php
session_name('cesta');
session_start();
session_destroy();
header("Location:.");
?>