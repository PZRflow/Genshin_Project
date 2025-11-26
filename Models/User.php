<?php
namespace Models;

class User {
    private string $id;
    private string $username;
    private string $hash_pwd;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->hash_pwd = $data['hash_pwd'];
    }

    public function getId(): string { return $this->id; }
    public function getUsername(): string { return $this->username; }
    public function getHashPwd(): string { return $this->hash_pwd; }
}