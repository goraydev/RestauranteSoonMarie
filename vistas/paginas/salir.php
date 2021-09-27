<?php
session_destroy();
echo '<script> 
window.location="' . $rutaBackend . '";
</script>';
