<?php
function init_session() : bool
{
        if (!session_id()) //S'il n'y a pas une session en cours
        {
            session_start();
            session_regenerate_id(); //New id pour des raisons de sécurité
            return true;
        }
        else {
                return false;
        } 
         //Si l'utilisateur est déjà connecté par exemple
}
    
function destroy_session() : void
{
        session_unset();
        session_destroy();
}
?>