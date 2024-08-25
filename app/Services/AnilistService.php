<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AnilistService
{
    protected $baseUrl = 'https://graphql.anilist.co';

    public function fetchAnime($query, $variables = [])
    {
        try {
            $response = Http::post($this->baseUrl, [
                'query' => $query,
                'variables' => $variables
            ]);

            if ($response->failed()) {
                throw new \Exception('Request failed with status ' . $response->status());
            }

            return $response->json();
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
