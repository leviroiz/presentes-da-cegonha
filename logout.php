<?php

declare(strict_types=1);

require_once __DIR__ . '/config/bootstrap.php';

require_post();
require_csrf();
destroy_session();
redirect('index.php');
