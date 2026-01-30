<?php

// Fix for Vercel routing: Ensure Laravel sees the full path
$_SERVER['SCRIPT_NAME'] = '/index.php';

require __DIR__ . '/../public/index.php';
