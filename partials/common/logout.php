<?php
    if (session_destroy()):
        unset($_SESSION['admin']);
        echo "<script>window.location.href=window.location.href=document.location.origin + document.location.pathname + '?page=common&subpage=login';</script>";
    else:
        echo "hataaaa";
    endif;
?>