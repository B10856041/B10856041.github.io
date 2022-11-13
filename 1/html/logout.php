<?php
    setcookie("account", "", time()-3600);
    header("refresh:0;url=index.html");
?>