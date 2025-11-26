<?php
namespace Helpers;

class Message
{
    private string $message;
    private string $color;
    private string $title;

    /**
     * Constructeur du message.
     *
     * @param string $message Le contenu du message.
     * @param string $color La couleur associée (ex: 'success', 'error', 'light-blue').
     * @param string $title Le titre du message.
     */
    public function __construct(string $message, string $color = "light-blue", string $title = "Message")
    {
        $this->message = $message;
        $this->color = $color;
        $this->title = $title;
    }

    /**
     * Récupère le contenu du message.
     *
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Récupère la couleur du message.
     *
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Récupère le titre du message.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }
}