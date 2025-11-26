<?php
namespace Models;

class UnitClass
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur de la classe d'unité.
     *
     * @param array $data Données à hydrater.
     */
    public function __construct(array $data)
    {
        $this->urlImg = '';
        $this->hydrate($data);
    }

    /**
     * Hydrate l'objet avec les données fournies.
     *
     * @param array $data Tableau associatif clé/valeur.
     * @return void
     */
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Récupère l'identifiant de la classe.
     *
     * @return string|null
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Récupère le nom de la classe.
     *
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Récupère l'URL de l'image de la classe.
     *
     * @return string
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l'identifiant de la classe.
     *
     * @param string|null $id
     * @return void
     */
    public function setId(?string $id): void { $this->id = $id; }

    /**
     * Définit le nom de la classe.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l'URL de l'image.
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }
}