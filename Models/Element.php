<?php
namespace Models;

class Element
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur de l'élément.
     * Hydrate l'objet directement avec les données fournies.
     *
     * @param array $data Données à hydrater.
     */
    public function __construct(array $data)
    {
        $this->urlImg = '';
        $this->hydrate($data);
    }

    /**
     * Hydrate l'objet avec un tableau associatif.
     * Appelle les setters correspondants aux clés du tableau.
     *
     * @param array $data Données clé/valeur.
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
     * Récupère l'identifiant de l'élément.
     *
     * @return string|null
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Récupère le nom de l'élément.
     *
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Récupère l'URL de l'image de l'élément.
     *
     * @return string
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l'identifiant de l'élément.
     *
     * @param string|null $id
     * @return void
     */
    public function setId(?string $id): void { $this->id = $id; }

    /**
     * Définit le nom de l'élément.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l'URL de l'image de l'élément.
     * Note : Nommé setUrl_img pour correspondre à la colonne BDD lors de l'hydratation.
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }
}