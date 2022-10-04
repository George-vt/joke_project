<?php
namespace App\Model;

use App\Interface\Joke\JokeInterface;

class JokeapiModel implements JokeInterface
{
    /**
     * Get jokes from https://v2.jokeapi.dev
     * TODO: build other models for different APIS
     *
     * @param int $number - Defaults to one joke to fetch
     * @return string - The string of jokes to return
     *
     */
    public function getJokes(int $number = 1) : string {

        $url = 'https://v2.jokeapi.dev/joke/Any?type=single';
        $query_string = '';

        if ($number > 1) {
            $query_string = '&amount=' . $number;
        }

        $url .= $query_string;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        $result = curl_exec($ch);
        $data = json_decode($result, true);

        $response_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $return = [];

        if ($response_code >= 400) {
            $return[] = "Sorry cannot fetch jokes, error: " . $response_code; // TODO: Log these errors
        }

        if ($number > 1) {
            $return = array_column($data['jokes'], 'joke');
        } else {
            $return[] = $data['joke'];
        }

        return implode('<br><br>', $return);
    }
}