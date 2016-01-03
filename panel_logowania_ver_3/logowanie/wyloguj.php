<?php

session_start();
session_destroy();
	
header('Location: ../index.php');
echo '<a href="index.php">wróć na stronę główna</a>';
exit;

?>
