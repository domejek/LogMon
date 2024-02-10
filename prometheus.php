<?php
require 'vendor/autoload.php';

use Prometheus\CollectorRegistry;
use Prometheus\Storage\Redis;
use Prometheus\RenderTextFormat;

// Konfiguration für Redis
$redisConfig = ['host' => 'localhost'];

// Ein neues Registry-Objekt mit Redis-Adapter erstellen
$adapter = new Redis($redisConfig);
$registry = new CollectorRegistry($adapter);

// Ein Gauge-Metrik-Objekt registrieren
$gauge = $registry->registerGauge('php_metric', 'Example of a PHP metric', ['type']);

// Metrikwert setzen
$gauge->set(10, ['type' => 'example']);

// Renderer erstellen und Metrikdaten ausgeben
$renderer = new RenderTextFormat();
echo $renderer->render($registry->getMetricFamilySamples());

