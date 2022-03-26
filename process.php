<?php
  $i = $_GET ["begin"];
  set_time_limit (10000);
  $way = str_replace ("*", "/", $_GET ["way"]);
  //echo $way;
  if (!file_exists ($way))
    mkdir ($way);
  $f = fopen ("D:/way5.php", "w+");
  fwrite ($f, $way);
  fclose ($f);
  $f = fopen ($way."/IsStarted5.php", "w+");
  fwrite ($f, "1");
  fclose ($f);
  while ($i < $_GET ["end"])
  {
    if (file_get_contents ($way."/IsStarted5.php") == 0)
	    break;
	$was_file = false;
	opendir ($way);
	while ($dirs = readdir ($way))
	{
		opendir ($way."/".$dirs);
		while ($dirs1 = readdir ($way."/".$dirs))
		{
			opendir ($way."/".$dirs."/".$dirs1);			
			while ($dirs2 = readdir ($way."/".$dirs."/".$dirs1))
				if (strstr (substr (strstr ($way."/".$dirs."/".$dirs1."/".$dirs2, "("), 1, strlen (strstr ($way."/".$dirs."/".$dirs1."/".$dirs2, "(")) - 1), "(", true) == $i);
					$was_file = true;
		}
	}
	if (!file_exists ($way."/error_".$i) && (!$was_file) && (!strstr ($way."/apcens.php", "(".$i.")")))
	{
      if (@fopen ("http://www.nipic.com/show/".$i.".html", "r"))
	  {
  	    $cont = file_get_contents ("http://www.nipic.com/show/".$i.".html");
  	    if (strstr ($cont, "http://pic"))
  	    {
  	      $photo = strstr (strstr ($cont, "http://pic"), "\"",
  	        true);
		  if (!file_exists ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1)))
		    mkdir ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1));
	      if (!file_exists ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1)."/".strstr (substr (strrchr ($photo, "/"),  1, strlen (strrchr ($photo, "/")) - 1), "_", true)))
		    mkdir ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1)."/".strstr (substr (strrchr ($photo, "/"), 1,        strlen (strrchr ($photo, "/")) - 1), "_", true));
	      if (!file_exists ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1)."/".strstr (substr (strrchr ($photo, "/"), 1, strlen (strrchr ($photo, "/")) - 1), "_", true)."/".strstr (substr (strrchr ($photo, "/"), 1, strlen (strrchr ($photo, "/")) - 1), ".", true)."(".$i.").".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".") - 1))))
	      {
  	        $f = fopen ($way."/".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1)."/".strstr (substr (strrchr ($photo, "/"),
  	          1, strlen (strrchr ($photo, "/")) - 1), "_", true)."/".strstr (substr (strrchr ($photo, "/"), 1, strlen (strrchr ($photo, "/")) - 1), ".", true)."(".$i.").".substr (strrchr ($photo, "."), 1, strlen (strrchr ($photo, ".")) - 1), "w+");
            fwrite ($f, file_get_contents ($photo));
  	        fclose ($f);
	      }
          $f = fopen ($way."/end".($i % 3)."5.php", "w+");
          fwrite ($f, $i);
          fclose ($f);
	    }
	    else	
	    {
          $f = fopen ($way."/end".($i % 3)."5.php", "w+");
          fwrite ($f, $i);
          fclose ($f);
		  $f = fopen ($way."/apcents.php", "a");
		  fwrite ($f, "(".$i.") ");
  	      fclose ($f);
        }
      }
	  else	
	  {
        $f = fopen ($way."/end".($i % 3)."5.php", "w+");
        fwrite ($f, $i);
        fclose ($f);
	    $f = fopen ($way."/error_".$i, "w+");
  	    fclose ($f);
      }
	}
  	$i += 3 * $_GET ["step"];
  }
  echo "Проверьте, пожалуйста, все фотографии в данном диапазоне закачаны успешно.";
?>