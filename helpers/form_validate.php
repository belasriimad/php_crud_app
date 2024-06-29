<?php    
    if (!$title) {
        $errors[] = "The title field is required.";
    }

    if (!$body) {
        $errors[] = "The body field is required.";
    }