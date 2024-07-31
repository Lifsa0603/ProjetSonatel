<?php
define('MAX_INACTIVITY_DURATION', 1800); // 30 minutes

function init_session() : bool
{
    if (!session_id()) {
        session_start();
        session_regenerate_id(true);
        return true;
    } else {
        return false;
    }
}

function destroy_session() : void
{
    session_unset();
    session_destroy();
}

if (init_session()) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > MAX_INACTIVITY_DURATION) {
        destroy_session();
        header("Location:../Login.php");
        exit;
    } else {
        $_SESSION['last_activity'] = time();
    }
}
?>
