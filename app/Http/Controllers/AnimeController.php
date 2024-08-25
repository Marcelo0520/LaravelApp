<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnilistService;

class AnimeController 
{
    protected $anilist;

    public function __construct(AnilistService $anilist)
    {
        $this->anilist = $anilist;
    }

    public function search(Request $request)
{
    $query = <<<'GRAPHQL'
    query ($search: String, $page: Int) {
        Page(perPage: 50, page: $page) {
            media(search: $search, type: ANIME) {
                id
                title {
                    romaji
                    english
                }
                description
                coverImage {
                    large
                }
            }
            pageInfo {
                total
                perPage
                currentPage
                lastPage
                hasNextPage
            }
        }
    }
    GRAPHQL;

    $variables = [
        'search' => $request->input('search'),
        'page' => 1
    ];

    $animeList = [];
    do {
        $response = $this->anilist->fetchAnime($query, $variables);

        if (isset($response['error'])) {
            return view('anime.search', ['error' => $response['error']]);
        }

        $animeList = array_merge($animeList, $response['data']['Page']['media']);
        $hasNextPage = $response['data']['Page']['pageInfo']['hasNextPage'];

        if ($hasNextPage) {
            $variables['page']++;
        }
    } while ($hasNextPage);

    return view('anime.search', ['animeList' => $animeList]);
}

}
