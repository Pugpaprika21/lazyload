<?php

$conn = mysqli_connect("localhost", "root", "", "lazy_load_db");
if (mysqli_connect_errno()) {
    exit("failed to connect to MySQL: " . mysqli_connect_error());
}