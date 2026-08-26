<?php

namespace Core;

use PDO;

abstract class Migration
{
    abstract public function up(PDO $db): void;
    abstract public function down(PDO $db): void;
}
