<?php
session_start();

// 正確是1;否則0
echo ($_SESSION['ans'] == $_GET['ans']) ? 1 : 0;
