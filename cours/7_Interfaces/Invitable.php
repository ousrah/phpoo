<?php
// On réutilise les classes Client et Fournisseur de l'exemple précédent.

/**
 * Interface Invitable
 * Elle garantit que toute classe qui l'implémente aura la méthode envoyerInvitation().
 */
interface Invitable {
    public function envoyerInvitation($evenement);
}