<?php
session_start();
class auth
{
    public function checkRoleAdmin()
    {
        if (isset($_SESSION['id_quyen']) && $_SESSION['id_quyen'] == '1') {
            return 1;
        } else {
            return 0;
        }
    }
    public function checkRoleDelivery()
    {
        if (isset($_SESSION['id_quyen']) && $_SESSION['id_quyen'] == '3') {
            return 1;
        } else {
            return 0;
        }
    }
}
