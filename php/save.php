<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    myFunction();
}

function myFunction()
{
    echo "ok";
    echo '<script type="text/javascript">window.location.href="../adm_tablo.php"</script>';
}
?>