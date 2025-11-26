<?php
namespace Models;

class Personnage
{
    private ?string $id;
    private string $name;
    private int $element;
    private int $unitclass;
    private ?int $origin = null;
    private int $rarity;
    private string $urlImg;

    private ?Element $elementObj = null;
    private ?UnitClass $unitClassObj = null;
    private ?Origin $originObj = null;

    /**
     * Constructeur du Personnage.
     * Hydrate l'objet si des données sont fournies.
     *
     * @param array $data Tableau associatif des données du personnage.
     */
    public function __construct(array $data = [])
    {
        $this->urlImg = '';
        if (!empty($data)) {
            $this->hydrate($data);
        }
    }

    /**
     * Hydrate l'objet en utilisant les setters.
     * Convertit automatiquement les clés (ex: url_img -> setUrlImg).
     *
     * @param array $data Données à injecter.
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Récupère l'ID du personnage.
     *
     * @return string|null
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Récupère le nom du personnage.
     *
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Récupère l'ID de l'élément (int).
     *
     * @return int
     */
    public function getElement(): int { return $this->element; }

    /**
     * Récupère l'ID de la classe d'unité (int).
     *
     * @return int
     */
    public function getUnitclass(): int { return $this->unitclass; }

    /**
     * Récupère la rareté (nombre d'étoiles).
     *
     * @return int
     */
    public function getRarity(): int { return $this->rarity; }

    /**
     * Récupère l'ID de l'origine (peut être null).
     *
     * @return int|null
     */
    public function getOrigin(): ?int { return $this->origin; }

    /**
     * Récupère l'URL de l'image.
     *
     * @return string
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Récupère l'objet Element associé (pour l'affichage).
     *
     * @return Element|null
     */
    public function getElementObj(): ?Element { return $this->elementObj; }

    /**
     * Récupère l'objet UnitClass associé (pour l'affichage).
     *
     * @return UnitClass|null
     */
    public function getUnitClassObj(): ?UnitClass { return $this->unitClassObj; }

    /**
     * Récupère l'objet Origin associé (pour l'affichage).
     *
     * @return Origin|null
     */
    public function getOriginObj(): ?Origin { return $this->originObj; }

    /**
     * Définit l'ID du personnage.
     *
     * @param string|null $id
     * @return void
     */
    public function setId(?string $id): void { $this->id = $id; }

    /**
     * Définit le nom du personnage.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l'ID de l'élément.
     *
     * @param int $element
     * @return void
     */
    public function setElement(int $element): void { $this->element = $element; }

    /**
     * Définit l'ID de la classe d'unité.
     *
     * @param int $unitclass
     * @return void
     */
    public function setUnitclass(int $unitclass): void { $this->unitclass = $unitclass; }

    /**
     * Définit la rareté.
     *
     * @param int $rarity
     * @return void
     */
    public function setRarity(int $rarity): void { $this->rarity = $rarity; }

    /**
     * Définit l'ID de l'origine. Gère les valeurs vides.
     *
     * @param mixed $origin
     * @return void
     */
    public function setOrigin(mixed $origin): void
    {
        $this->origin = empty($origin) ? null : (int)$origin;
    }

    /**
     * Définit l'URL de l'image.
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Alias de setUrlImg pour l'hydratation (url_img).
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }

    /**
     * Associe un objet Element complet au personnage.
     *
     * @param Element|null $elementObj
     * @return void
     */
    public function setElementObj(?Element $elementObj): void { $this->elementObj = $elementObj; }

    /**
     * Associe un objet UnitClass complet au personnage.
     *
     * @param UnitClass|null $unitClassObj
     * @return void
     */
    public function setUnitClassObj(?UnitClass $unitClassObj): void { $this->unitClassObj = $unitClassObj; }

    /**
     * Associe un objet Origin complet au personnage.
     *
     * @param Origin|null $originObj
     * @return void
     */
    public function setOriginObj(?Origin $originObj): void { $this->originObj = $originObj; }
}