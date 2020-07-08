<?php

$time = time();

echo "Time: $time".PHP_EOL."Hash: ".sha1($argv[1].$time.'Las bodas son exactamente funerales con un pastel!').PHP_EOL;