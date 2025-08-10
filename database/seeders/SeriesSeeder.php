<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Series;

class SeriesSeeder extends Seeder
{
    public function run(): void
    {
        $series = [
            [
                'title' => 'Breaking Bad',
                'description' => 'A high school chemistry teacher turned methamphetamine producer partners with a former student to secure his family\'s financial future.',
                'show_time' => 'Sunday @ 9:00 PM',
            ],
            [
                'title' => 'Game of Thrones',
                'description' => 'Nine noble families fight for control over the mythical lands of Westeros, while an ancient enemy returns after being dormant for millennia.',
                'show_time' => 'Monday @ 8:00 PM',
            ],
            [
                'title' => 'The Office',
                'description' => 'A mockumentary on a group of typical office workers, where the workday consists of ego clashes, inappropriate behavior, and tedium.',
                'show_time' => 'Tuesday-Friday @ 7:30 PM',
            ],
            [
                'title' => 'Stranger Things',
                'description' => 'When a young boy disappears, his mother, a police chief and his friends must confront terrifying supernatural forces in order to get him back.',
                'show_time' => 'Wednesday @ 8:30 PM',
            ],
            [
                'title' => 'Friends',
                'description' => 'Follows the personal and professional lives of six twenty to thirty-something-year-old friends living in Manhattan.',
                'show_time' => 'Thursday @ 7:00 PM',
            ],
            [
                'title' => 'The Crown',
                'description' => 'Follows the political rivalries and romance of Queen Elizabeth II\'s reign and the events that shaped the second half of the twentieth century.',
                'show_time' => 'Friday @ 9:30 PM',
            ],
            [
                'title' => 'Sherlock',
                'description' => 'A modern update finds the famous sleuth and his doctor partner solving crime in 21st century London.',
                'show_time' => 'Saturday @ 8:00 PM',
            ],
            [
                'title' => 'The Mandalorian',
                'description' => 'The travels of a lone bounty hunter in the outer reaches of the galaxy, far from the authority of the New Republic.',
                'show_time' => 'Sunday @ 10:00 PM',
            ],
        ];

        foreach ($series as $show) {
            Series::create($show);
        }
    }
}
