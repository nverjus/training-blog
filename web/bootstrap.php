<?php
require_once '../vendor/autoload.php';

$app = new Blog\BlogApplication;

$response = $app->getController()->execute();

$app->getResponse()->send($response);
