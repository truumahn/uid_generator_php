<?php declare(strict_types = 1);

use FP_Interview\UIDGenerator;

require_once __DIR__ . '/../autoload.php';

$uid_generator = new UIDGenerator;
echo $uid_generator->getId();
