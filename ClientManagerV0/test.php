<?php
class Product
{
    private string $name; //L'encapsulation
    private float $price;

    // Le constructeur est appelé lors de `new Product(...)`
    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
        echo "Produit '" . $name . "' créé.\n";
    }
    public function setName(string $name)
    {
        $this->name = $name;
    }
    public function getName(): string
    {
        return $this->name;
    }

    public function getDetails(): string
    {
        return $this->name . " - " . $this->price . " €";
    }
}

// On instancie la classe Product en passant les arguments requis par le constructeur.
$product1 = new Product('Livre PHP 8', 29.99);
// Affiche "Produit 'Livre PHP 8' créé."
$product1->name = 'table';
echo $product1->getDetails();
// Affiche "Livre PHP 8 - 29.99 €"