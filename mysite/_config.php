<?php

global $project;
$project = 'mysite';

global $database;
# Don't override the environment variable if it is set
if( ! defined('SS_DATABASE_NAME')) {
    $database = 'dnawebsite';
} else {
    $database = SS_DATABASE_NAME;
}
