<?php
echo PHP_BINARY . '<br>';
echo php_ini_loaded_file() . '<br>';
print_r(PDO::getAvailableDrivers());