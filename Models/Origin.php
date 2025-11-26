<?php
namespace Models;

class Origin
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur de l'origine.
     * Hydrate l'objet avec les données fournies.
     *
     * @param array $data Tableau associatif des données.
     */
    public function __construct(array $data)
    {
        $this->urlImg = '';
        $this->hydrate($data);
    }

    /**
     * Hydrate l'objet en appelant les setters correspondants aux clés du tableau.
     *
     * @param array $data Données à injecter.
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
     * Récupère l'identifiant de l'origine.
     *
     * @return string|null
     */
    public function getId(): ?string { return $this->id; }

    /**
     * Récupère le nom de l'origine.
     *
     * @return string
     */
    public function getName(): string { return $this->name; }

    /**
     * Récupère l'URL de l'image de l'origine.
     *
     * @return string
     */
    public function getUrlImg(): string { return $this->urlImg; }

    /**
     * Définit l'identifiant de l'origine.
     *
     * @param string|null $id
     * @return void
     */
    public function setId(?string $id): void { $this->id = $id; }

    /**
     * Définit le nom de l'origine.
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void { $this->name = $name; }

    /**
     * Définit l'URL de l'image.
     * Nommé setUrl_img pour correspondre au champ BDD lors de l'hydratation.
     *
     * @param string $urlImg
     * @return void
     */
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }
}