<?php
function prepareCabinet(){
    if(isset($_SESSION['user'])) {

    }
    else{
        header("Location: /");
    }
}