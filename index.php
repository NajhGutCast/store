<?php
session_start();
if ($_SESSION['auth_user'] || $_SESSION['username']) {
    header('location: ./home');
} else {
    header('location: ./login');
}
