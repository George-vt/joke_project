<?php

namespace App\Interface\Joke;

interface JokeInterface
{
    /**
     * Get
     */
    public function getJokes(int $number) : string;
}
