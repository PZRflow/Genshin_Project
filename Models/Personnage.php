<?php
namespace Models;

class Personnage
{
    // --- 1. DONNÉES DE LA BDD (IDs et Valeurs simples) ---
    // L'ID du personnage (varchar selon ton sujet)
    private ?string $id;
    private string $name;

    // CORRECTION : Ici on stocke les IDs (clés étrangères), donc des INT.
    // Ce ne sont PAS des objets Element/UnitClass ici.
    private int $element;
    private int $unitclass;

    // Origin est nullable dans la BDD, donc ?int
    private ?int $origin = null;

    private int $rarity;
    private string $urlImg;

    // --- 2. OBJETS LIÉS (Pour l'affichage) ---
    // CORRECTION : On les initialise à null pour éviter l'erreur "accessed before initialization"
    private ?Element $elementObj = null;
    private ?UnitClass $unitClassObj = null;
    private ?Origin $originObj = null;

    public function __construct(array $data = [])
    {
        // Initialisation par défaut pour éviter les bugs
        $this->urlImg = '';
        // Si des données sont passées, on hydrate
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    // Hydratation
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            // Gestion du snake_case vers camelCase (ex: url_img -> setUrlImg)
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // --- GETTERS (Modifiés pour correspondre aux types) ---

    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }

    // Retourne l'ID (int)
    public function getElement(): int { return $this->element; }
    public function getUnitclass(): int { return $this->unitclass; }
    public function getRarity(): int { return $this->rarity; }
    public function getOrigin(): ?int { return $this->origin; }
    public function getUrlImg(): string { return $this->urlImg; }

    // Retourne l'Objet (ou null)
    public function getElementObj(): ?Element { return $this->elementObj; }
    public function getUnitClassObj(): ?UnitClass { return $this->unitClassObj; }
    public function getOriginObj(): ?Origin { return $this->originObj; }

    // --- SETTERS (Modifiés pour correspondre aux types) ---

    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }

    // Accepte l'ID (int). Le formulaire envoie "1" (string), PHP le convertira en int.
    public function setElement(int $element): void { $this->element = $element; }

    public function setUnitclass(int $unitclass): void { $this->unitclass = $unitclass; }

    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    // Origin peut être vide ("") venant du formulaire, on gère ça :
    public function setOrigin(mixed $origin): void
    {
        // Si c'est vide ou null, on met null, sinon on cast en int
        $this->origin = empty($origin) ? null : (int)$origin;
    }

    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
    // Pour compatibilité avec l'hydratation si la clé est 'url_img'
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }

    // Setters pour les Objets (Utilisés par le Service, pas par le formulaire)
    public function setElementObj(?Element $elementObj): void { $this->elementObj = $elementObj; }
    public function setUnitClassObj(?UnitClass $unitClassObj): void { $this->unitClassObj = $unitClassObj; }
    public function setOriginObj(?Origin $originObj): void { $this->originObj = $originObj; }
}