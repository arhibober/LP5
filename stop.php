<?php  
  $f = fopen (file_get_contents ("D:/way5.php")."/IsStarted5.php", "w+");
  fwrite ($f, "0");
  fclose ($f);
  header('Location: index.php'); 
?>