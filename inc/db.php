<?php
$con = new mysqli("205.185.125.123", "aat", "aat", "aat");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
}

