<?php
namespace App\Controller;

/**
 * Classe de base pour les contrôleurs.
 * Fournit une méthode commune pour rendre les vues, ce qui évite la répétition de code.
 * C'est un exemple simple d'héritage pour centraliser une logique commune.
 */
abstract class BaseController
{
    /**
     * Affiche une vue en l'insérant dans le layout principal.
     *
     * @param string $view Le chemin vers le fichier de la vue (ex: 'clients/list').
     * @param array $data Les données à extraire pour la vue.
     */
    protected function render(string $view, array $data = []): void
    {
        // Rend les clés du tableau $data accessibles comme des variables dans la vue.
        // ex: $data['clients'] devient $clients
        extract($data);

        // Le contenu de la vue est d'abord stocké dans une mémoire tampon
        ob_start();
        include __DIR__ . "/../../views/{$view}.php";
        $content = ob_get_clean(); // On récupère le contenu de la mémoire tampon

        // On inclut le layout principal qui affichera la variable $content
        include __DIR__ . '/../../views/layout.php';
    }
}