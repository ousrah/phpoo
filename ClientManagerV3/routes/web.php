<?php
use Bramus\Router\Router;
use App\Controller\ClientController;
use App\Controller\FournisseurController;
use App\Controller\PersonneController;

return function (Router $router) {
    // Route par défaut (liste polymorphe)
    $router->get('/', [new PersonneController(), 'index']);

    // ==================
    // ROUTES POUR LES CLIENTS (API pour AJAX)
    // ==================
    $router->get('/clients', [new ClientController(), 'index']);           // Page principale (liste)
    $router->post('/clients', [new ClientController(), 'store']);          // Créer un client
    $router->get('/clients/(\d+)', [new ClientController(), 'show']);      // Obtenir les données d'un client (pour l'éditer)
    $router->post('/clients/(\d+)', [new ClientController(), 'update']);   // Mettre à jour un client
    $router->post('/clients/(\d+)/delete', [new ClientController(), 'destroy']); // Supprimer un client
    $router->get('/clients/form', [new ClientController(), 'showForm']);        // Pour ajouter
    $router->get('/clients/(\d+)/form', [new ClientController(), 'showForm']); // Pour modifier

    // ==================
    // ROUTES POUR LES FOURNISSEURS (API pour AJAX)
    // ==================
    $router->get('/fournisseurs', [new FournisseurController(), 'index']);
    $router->post('/fournisseurs', [new FournisseurController(), 'store']);
    $router->get('/fournisseurs/(\d+)', [new FournisseurController(), 'show']);
    $router->post('/fournisseurs/(\d+)', [new FournisseurController(), 'update']);
    $router->post('/fournisseurs/(\d+)/delete', [new FournisseurController(), 'destroy']);


    $router->get('/fournisseurs/form', [new FournisseurController(), 'showForm']);
    $router->get('/fournisseurs/(\d+)/form', [new FournisseurController(), 'showForm']);

};