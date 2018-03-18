<?php
session_start();
echo $_SESSION['text'];
session_destroy();