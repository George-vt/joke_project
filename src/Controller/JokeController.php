<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Model\JokeapiModel;


class JokeController extends AbstractController
{
    const MAX_JOKES = 20;

    /**
     * Delivers homepage for site with one joke already loaded
     *
     * @param int $number - The number of jokes requested
     * @return html
     */
    public function home($number = 1): Response
    {
        if ($number > self::MAX_JOKES) {
            // TODO : return error message
        }

        $jokeModel = new JokeapiModel();
        $jokes = $jokeModel->getJokes($number);

        return $this->render('joke/home.html.twig', [
            'joke' => $jokes,
            'maximum' => self::MAX_JOKES,
        ]);
    }

    public function getJokes($number = 1): Response
    {
        if ($number > self::MAX_JOKES) {
            // TODO : return error message
        }

        $jokeModel = new JokeapiModel();
        $jokes = $jokeModel->getJokes($number);

        return new Response(
            $jokes,
        );
    }
}
