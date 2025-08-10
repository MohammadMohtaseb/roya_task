<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Episode;
use App\Models\Series;

class EpisodeSeeder extends Seeder
{
    public function run(): void
    {
        $series = Series::all();

        $episodes = [
            [
                'title' => 'Pilot',
                'description' => 'The first episode that sets up the entire series premise.',
                'duration' => 47,
                'airing_time' => 'Sunday @ 9:00 PM',
            ],
            [
                'title' => 'The Cat\'s in the Bag...',
                'description' => 'Walter and Jesse attempt to tie up loose ends.',
                'duration' => 48,
                'airing_time' => 'Sunday @ 9:00 PM',
            ],
            [
                'title' => '...And the Bag\'s in the River',
                'description' => 'Walter faces a difficult decision about what to do with Krazy-8.',
                'duration' => 48,
                'airing_time' => 'Sunday @ 9:00 PM',
            ],
        ];

        foreach ($series as $show) {
            foreach ($episodes as $index => $episodeData) {
                Episode::create([
                    'series_id' => $show->id,
                    'title' => $episodeData['title'] . ' - ' . $show->title,
                    'description' => $episodeData['description'],
                    'duration' => $episodeData['duration'],
                    'airing_time' => $show->show_time,
                ]);

                if ($index >= 2) break;
            }
        }

        $breakingBad = Series::where('title', 'Breaking Bad')->first();
        if ($breakingBad) {
            $breakingBadEpisodes = [
                [
                    'title' => 'Cancer Man',
                    'description' => 'Walter tells the family about his cancer diagnosis.',
                    'duration' => 48,
                    'airing_time' => 'Sunday @ 9:00 PM',
                ],
                [
                    'title' => 'Gray Matter',
                    'description' => 'Walter\'s former colleagues offer to pay for his treatment.',
                    'duration' => 48,
                    'airing_time' => 'Sunday @ 9:00 PM',
                ],
                [
                    'title' => 'Crazy Handful of Nothin\'',
                    'description' => 'Walter adopts a new identity to deal with Tuco.',
                    'duration' => 48,
                    'airing_time' => 'Sunday @ 9:00 PM',
                ],
            ];

            foreach ($breakingBadEpisodes as $episodeData) {
                Episode::create([
                    'series_id' => $breakingBad->id,
                    'title' => $episodeData['title'],
                    'description' => $episodeData['description'],
                    'duration' => $episodeData['duration'],
                    'airing_time' => $episodeData['airing_time'],
                ]);
            }
        }

        $gameOfThrones = Series::where('title', 'Game of Thrones')->first();
        if ($gameOfThrones) {
            $gotEpisodes = [
                [
                    'title' => 'Winter Is Coming',
                    'description' => 'Eddard Stark is torn between his family and an old friend when asked to serve at the side of King Robert Baratheon.',
                    'duration' => 62,
                    'airing_time' => 'Monday @ 8:00 PM',
                ],
                [
                    'title' => 'The Kingsroad',
                    'description' => 'While Bran recovers from his fall, Ned takes only his daughters to King\'s Landing.',
                    'duration' => 56,
                    'airing_time' => 'Monday @ 8:00 PM',
                ],
                [
                    'title' => 'Lord Snow',
                    'description' => 'Jon begins his training with the Night\'s Watch; Ned confronts his past.',
                    'duration' => 58,
                    'airing_time' => 'Monday @ 8:00 PM',
                ],
            ];

            foreach ($gotEpisodes as $episodeData) {
                Episode::create([
                    'series_id' => $gameOfThrones->id,
                    'title' => $episodeData['title'],
                    'description' => $episodeData['description'],
                    'duration' => $episodeData['duration'],
                    'airing_time' => $episodeData['airing_time'],
                ]);
            }
        }
    }
}
