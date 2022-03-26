<?php
  $min_end = file_get_contents (file_get_contents ("D:/way5.php")."/end05.php");
  if (file_get_contents (file_get_contents ("D:/way5.php")."/end15.php") < $min_end)
    $min_end = file_get_contents (file_get_contents ("D:/way5.php")."/end15.php");
  if (file_get_contents (file_get_contents ("D:/way5.php")."/end05.php") < $min_end)
    $min_end = file_get_contents (file_get_contents ("D:/way25.php")."/end25.php");
  echo "
  <table>
  <tr>
  <td>
  Минимальный номер страницы с загружаемой фотографией:
  </td>
  <td>
  <input type='text' id='begin' value='".$min_end."'/>
  <input type='hidden' id='begin_default' value='".$min_end."'/>
  <input type='hidden' id='end0' value='".file_get_contents (file_get_contents ("D:/way5.php")."/end05.php")."'/>
  <input type='hidden' id='end1' value='".file_get_contents (file_get_contents ("D:/way5.php")."/end15.php")."'/>
  <input type='hidden' id='end2' value='".file_get_contents (file_get_contents ("D:/way5.php")."/end25.php")."'/>
  </td>
  </tr>
  <tr>
  <td>
  Максимальный номер страницы с загружаемой фотографией:
  </td>
  <td>
  <input type='text' id='end' value='".($min_end + 100)."'/>
  </td>
  </tr>
  <tr>
  <td>
  Шаг обхода страниц (может быть отрицательным):
  </td>
  <td>
  <input type='text' id='step' value='1'/>
  </td>
  </tr>
  <tr>
  <td>
  Путь на своём компьютере для загрузки файлов
  </td>
  <td>
  <input type='text' id='way' value='".file_get_contents ("D:/way5.php")."'/>
  </td>
  </tr>
  </table>
  <input type='submit' value='Пуск' onClick='thr()'>
  <br/>
  <br/>
  <form action='stop.php' method='post'>
  <input type='submit' value='Стоп'>
  </form>
  <div id='dest'></div>";  
?>

<script language="javascript">
  function thr()
  {
    if (document.getElementById ("way").value.match (/^[A-Za-z]:\u002f.+/))
	{
	  if (document.getElementById ("begin").value.match (/^\d*$/))
	  {
	    if (document.getElementById ("step").value.match (/^\u002d?\d*$/))
	    {
	      if (document.getElementById ("end").value.match (/^\d*$/))
	      {
		    if ((document.getElementById ("begin").value == document.getElementById ("begin_default").value) && (document.getElementById ("step")   == 1))
			{
              thr1 (document.getElementById ("end0").value);
              thr1 (document.getElementById ("end1").value);
              thr1 (document.getElementById ("end2").value);
			}
			else
			{
              thr1 (document.getElementById ("begin").value);
              thr1 (parseInt (document.getElementById ("begin").value) + 1 * parseInt (document.getElementById ("step").value));
              thr1 (parseInt (document.getElementById ("begin").value) + 2 * parseInt (document.getElementById ("step").value));
			}
		  }
		  else
			alert ("Введите корректный верхний предел закачки!");
		}
	    else
	      alert ("Введите корректный шаг закачки!");
      }
	  else
	    alert ("Введите корректный номер стартовой страницы!");
	}
	else
	  alert ("Введите корректный адрес!");
  }

  function thr1 (begin)
  {
    var req = null;
    document.getElementById ("dest").innerHTML = "Идёт загрузка файлов...";	
    if (window.XMLHttpRequest)
	  req = new XMLHttpRequest();
    else
	  if (window.ActiveXObject)
	  {
	    try
	    {
		  req = new ActiveXObject ("Msxml2.XMLHTTP");
	    }
	    catch (e)
	    {
		  try
		  {
		    req = new ActiveXObject ("Microsoft.XMLHTTP");
	      }
		  catch (e)
		  {
	      }
	    }
	  }
    req.onreadystatechange = function ()
    {
      if (req.readyState == 4)
      {
	    if (req.status == 200)
	    {
	      document.getElementById ("dest").innerHTML = req.responseText;
	    }
	    else
	    {
	      document.getElementById ("dest").innerHTML = "Код ошибки: " + req.status + " " + req.statusText;
	    }
      }
    };
	var step = document.getElementById ("step").value;
	var end = document.getElementById ("end").value;
	var way = document.getElementById ("way").value;
	way = way.replace(/\u002f/, '*');
    var url = "process.php?begin=" + escape (begin) + "&way=" + escape (way) + "&step=" + escape (step) + "&end=" + escape (end);
    req.open ("GET", url, true);
    req.send (null);
  }
</script>