<?php

/**
 * Script de test pour vérifier le système de notifications ciblées
 * 
 * Ce script peut être exécuté via la ligne de commande pour tester
 * la logique de sélection des destinataires.
 * 
 * Usage: php test_notifications.php
 */

require_once __DIR__ . '/vendor/autoload.php';

// Simuler l'environnement Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Services\NotificationService;
use App\Models\User;
use Illuminate\Support\Facades\DB;

echo "=== Test du Système de Notifications Ciblées ===\n\n";

// Créer une instance du service de notification
$notificationService = new NotificationService();

// Utiliser la réflexion pour accéder à la méthode privée getConcernedValidators
$reflection = new ReflectionClass($notificationService);
$method = $reflection->getMethod('getConcernedValidators');
$method->setAccessible(true);

// Types de demandes à tester
$testTypes = [
    'demande d\'absence',
    'autorisation d\'absence',
    'certificat de travail',
    'demande spéciale'
];

// Services à tester (supposons qu'il y a des services avec ID 1, 2, 3)
$testServices = [1, 2, 3];

foreach ($testTypes as $type) {
    echo "\n--- Test pour le type: $type ---\n";
    
    foreach ($testServices as $serviceId) {
        echo "\nService ID: $serviceId\n";
        
        try {
            // Appeler la méthode getConcernedValidators
            $validators = $method->invoke($notificationService, $type, $serviceId);
            
            echo "Nombre de validateurs trouvés: " . $validators->count() . "\n";
            
            if ($validators->count() > 0) {
                echo "Validateurs sélectionnés:\n";
                foreach ($validators as $validator) {
                    echo "  - {$validator->nom} (ID: {$validator->id}, Service: {$validator->id_service}, Permission: {$validator->permissionrh}, Rôle: {$validator->role})\n";
                }
            } else {
                echo "  Aucun validateur trouvé pour ce service.\n";
            }
            
        } catch (Exception $e) {
            echo "Erreur: " . $e->getMessage() . "\n";
        }
    }
}

// Test de la logique complète avec un utilisateur fictif
echo "\n\n=== Test de la Logique Complète ===\n";

try {
    // Récupérer un utilisateur existant pour le test
    $testUser = User::where('status', 'actif')->first();
    
    if ($testUser) {
        echo "\nTest avec l'utilisateur: {$testUser->nom} (Service: {$testUser->id_service})\n";
        
        // Simuler un modèle de demande
        $mockModel = (object) ['id' => 999, 'id_superieur' => null];
        
        // Tester la méthode complète (sans envoyer d'emails)
        echo "\nSimulation de notifyNewRequest pour 'demande d\'absence':\n";
        
        // Récupérer les validateurs concernés
        $validators = $method->invoke($notificationService, 'demande d\'absence', $testUser->id_service);
        echo "Validateurs qui seraient notifiés: " . $validators->count() . "\n";
        
        // Récupérer les supérieurs du service
        $superiors = User::where('permissionrh', 'superieur')
                        ->where('id_service', $testUser->id_service)
                        ->where('status', 'actif')
                        ->get();
        echo "Supérieurs du service qui seraient notifiés: " . $superiors->count() . "\n";
        
        $totalRecipients = $validators->count() + $superiors->count();
        echo "Total des destinataires: $totalRecipients\n";
        
    } else {
        echo "Aucun utilisateur actif trouvé pour le test.\n";
    }
    
} catch (Exception $e) {
    echo "Erreur lors du test complet: " . $e->getMessage() . "\n";
}

echo "\n=== Fin des Tests ===\n";