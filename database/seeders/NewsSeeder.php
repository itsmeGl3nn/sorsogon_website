<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Facades\Storage;

class NewsSeeder extends Seeder
{
    public function run()
    {
        $newsItems = [
            [
                'title' => 'Breaking News: Laravel Releases New Version',
                'description' => 'Laravel has released a new version with exciting features...',
                'content' => 'Full content of the news goes here...',
                'author' => 'Jane Doe',
                'image' => $this->storeImage('1CcpdAKWQty45DhJ11cnNpHOKwvdYFdlmhRf12RV.jpg'),
                'category' => 'Technology',
            ],
            [
                'title' => 'Sports Update: Local Team Wins Championship',
                'description' => 'The local team has secured a championship title...',
                'content' => 'Full content of the sports news goes here...',
                'author' => 'John Smith',
                'image' => $this->storeImage('EoVYphVknn30sD8JANqgl7pJCLRSvKnh8Ag4umeD.png'),
                'category' => 'Sports',
            ],
        ];

        foreach ($newsItems as $newsData) {
            News::create($newsData);
        }
    }

    private function storeImage($imageName)
    {
        // Use the custom path for storing images
        $imagePath = storage_path("app/images/{$imageName}");
        if (!file_exists($imagePath)) {
            // Copy a default image if the specified one doesn't exist
            copy(storage_path('app/images/default_news.jpg'), $imagePath);
        }
        return "images/{$imageName}";
    }

}
