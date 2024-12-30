# les concepts fondamentaux de la POO en PHP

La programmation orientée objet (POO) est une façon d'organiser le code informatique pour qu'il soit plus simple à comprendre, à gérer et à étendre. En PHP, la POO permet de travailler avec des objets qui sont créés à partir de classes. Ces objets peuvent contenir des données et des fonctions pour manipuler ces données.

## 1. Qu'est-ce qu'une classe ?

Une classe est comme un modèle ou un plan pour créer des objets. Elle définit les caractéristiques (données) et les actions (fonctions ou méthodes) que les objets auront.

Exemple de classe en PHP :

\`\`\`<?php
    class Voiture {
        // Propriétés (caractéristiques)
        public $marque;
        public $couleur;

        // Méthode (fonction)
        public function démarrer() {
            echo "La voiture démarre.";
        }
    }
?>

## 2. Qu'est-ce qu'un objet ?

Un objet est une instance d'une classe. En d'autres termes, un objet est une création concrète à partir d'une classe. Un objet peut avoir des valeurs spécifiques pour ses propriétés.

Exemple de création d'un objet :

```php
    $maVoiture = new Voiture(); 
    // Création d'un objet "maVoiture"
    $maVoiture->marque = "Peugeot"; 
    // Définir la marque de la voiture
    $maVoiture->couleur = "rouge";
    // Définir la couleur de la voiture

    // Utilisation de la méthode "démarrer"
    $maVoiture->démarrer(); 
```
## 3. Encapsulation

L'encapsulation est un principe important en POO. Cela signifie que les données et les fonctions qui manipulent ces données sont regroupées ensemble dans la même classe. Cela permet de protéger les données en limitant leur accès.

Exemple d'encapsulation :

```php
    class Voiture {
        // Propriétés privées
        private $marque;
        private $couleur;

        // Getter pour obtenir la marque
        public function getMarque() {
            return $this->marque;
        }

        // Setter pour définir la marque
        public function setMarque($marque) {
            $this->marque = $marque;
        }
    }
```

## 4. Héritage

L'héritage permet à une classe de hériter des propriétés et des méthodes d'une autre classe. Cela permet de réutiliser le code et de créer des classes spécialisées basées sur une classe plus générale.

Exemple d'héritage :

```php
    class Voiture {
        public $marque;
        public $couleur;

        public function démarrer() {
            echo "La voiture démarre.";
        }
    }

    class VoitureElectrique extends Voiture {
        public $autonomie;

        public function charger() {
            echo "La voiture est en train de se charger.";
        }
    }

    $maVoitureElectrique = new VoitureElectrique();
    $maVoitureElectrique->marque = "Tesla";
    $maVoitureElectrique->couleur = "bleu";
    $maVoitureElectrique->autonomie = 400;
    $maVoitureElectrique->démarrer(); // Méthode de la classe parent
    $maVoitureElectrique->charger();  // Méthode de la classe enfant
```

## 5. Polymorphisme

Le polymorphisme permet à une méthode d'avoir des comportements différents selon le type de l'objet qui l'appelle.

Exemple de polymorphisme :

```php
    interface AnimalInterface {
        public function parler();
    }

    class Chat implements AnimalInterface {
        public function parler() {
            echo "Le chat miaule.";
        }
    }

    class Chien implements AnimalInterface {
        public function parler() {
            echo "Le chien aboie.";
        }
    }

    $chat = new Chat();
    $chien = new Chien();

    $chat->parler(); // Affiche "Le chat miaule."
    $chien->parler(); // Affiche "Le chien aboie."
```

## Conclusion

En résumé, la programmation orientée objet en PHP permet de structurer le code en utilisant des classes et des objets. Les concepts clés comme l'encapsulation, l'héritage et le polymorphisme permettent de créer des programmes plus modulaires, flexibles et faciles à maintenir.