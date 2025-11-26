<?php
namespace Helpers;

class Message
{
    private string $message;
    private string $color;
    private string $title;

    public function __construct(string $message, string $color = "light-blue", string $title = "Message")
    {
        $this->message = $message;
        $this->color = $color;
        $this->title = $title;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
