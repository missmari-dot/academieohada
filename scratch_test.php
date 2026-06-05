<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;
use App\Models\Commande;

try {
    $c = Commande::whereNotNull('fichier_client')->first();
    if (!$c) {
        echo "No command with fichier_client found.\n";
        exit;
    }
    $response = Storage::download($c->fichier_client);
    $middleware = new \App\Http\Middleware\SecurityHeaders();
    $request = \Illuminate\Http\Request::capture();
    $res = $middleware->handle($request, function() use ($response) { return $response; });
    echo "Middleware Response class: " . get_class($res) . "\n";
} catch (\Throwable $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
