<?php
session_start();
unset($_SESSION['cLogin']);
unset($_SESSION['cAdmin']);
unset($_SESSION['nome']);

header("location: index.php");