<?php
/*
 * Base Controller
 * Memuat models dan views
 */
class Controller
{
    // Muat model
    public function model($model)
    {
        // Require model file
        require_once '../app/models/' . $model . '.php';
        // Instatiate model
        return new $model();
    }

    // Muat view
    public function view($view, $data = [])
    {
        // Cek file view
        if (file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            // View tidak ada
            die('View does not exist');
        }
    }
}
