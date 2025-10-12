<?php
namespace App\Core;

class Redirect
{
    /**
     * Redirige vers une URL relative au basePath défini dans .env
     */
    public static function to(string $path, int $status = 302): void
    {
        $base = rtrim($_ENV['APP_BASEPATH'] ?? '', '/');
        $location = $base . '/' . ltrim($path, '/');

        header("Location: {$location}", true, $status);
        exit;
    }

    /**
     * Redirige vers la route précédente (si disponible)
     */
    public static function back(): void
    {
        $referer = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: {$referer}");
        exit;
    }

    /**
     * Redirige vers la page d’accueil
     */
    public static function home(): void
    {
        self::to('/');
    }
}
