<?php
session_start();
session_destroy();
header('Location: ../iniciodesesión.php');
exit();
