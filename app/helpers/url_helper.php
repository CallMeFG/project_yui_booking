<?php
// Helper untuk redirect halaman
function redirect($page)
{
    header('location: ' . URLROOT . '/' . $page);
}
