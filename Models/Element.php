<?php
namespace Models;

class Element
{
    private ?string $id;
    private string $name;
    private string $urlImg;

    public function __construct(array $data)
    {
        $this->urlImg = '';
        $this->hydrate($data);
    }

    // Hydratation
    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    // Getters
    public function getId(): ?string { return $this->id; }
    public function getName(): string { return $this->name; }
    public function getUrlImg(): string { return $this->urlImg; }

    // Setters
    public function setId(?string $id): void { $this->id = $id; }
    public function setName(string $name): void { $this->name = $name; }
    public function setUrl_img(string $urlImg): void { $this->urlImg = $urlImg; }
}
