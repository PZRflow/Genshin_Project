<?php
namespace Models;

class User {
    private string $id;
    private string $username;
    private string $hash_pwd;

    /**
     * Constructeur de l'utilisateur.
     *
     * @param array $data Données de l'utilisateur (id, username, hash_pwd).
     */
    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->hash_pwd = $data['hash_pwd'];
    }

    /**
     * Récupère l'identifiant de l'utilisateur.
     *
     * @return string
     */
    public function getId(): string { return $this->id; }

    /**
     * Récupère le nom d'utilisateur.
     *
     * @return string
     */
    public function getUsername(): string { return $this->username; }

    /**
     * Récupère le mot de passe haché.
     *
     * @return string
     */
    public function getHashPwd(): string { return $this->hash_pwd; }
}