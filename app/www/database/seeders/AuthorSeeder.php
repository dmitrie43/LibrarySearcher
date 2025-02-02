<?php

namespace Database\Seeders;

use App\Helpers\FileUploader;
use App\Models\Author;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public static function run()
    {
        $authors = [
            'Анджей Сапковский' => [
                'photo' => FileUploader::upload(
                    new UploadedFile(path: public_path('/img/Sapkovskie.png'), originalName: 'Sapkovskie'),
                    FileUploader::IMAGE_PATH
                ),
            ],
            'Рэй Брэдбери' => [
                'photo' => FileUploader::upload(
                    new UploadedFile(path: public_path('/img/bredbery.jpg'), originalName: 'Bredbery'),
                    FileUploader::IMAGE_PATH
                ),
            ],
            'Стивен Кинг' => [
                'photo' => FileUploader::upload(
                    new UploadedFile(path: public_path('/img/stiven-king.webp'), originalName: 'StivenKing'),
                    FileUploader::IMAGE_PATH
                ),
            ],
            'Ричард Мэтисон' => [
                'photo' => FileUploader::upload(
                    new UploadedFile(path: public_path('/img/richardM.jpg'), originalName: 'RichardM'),
                    FileUploader::IMAGE_PATH
                ),
            ],
            'Джордж Оруэлл' => [
                'photo' => FileUploader::upload(
                    new UploadedFile(path: public_path('/img/Oruel.jpg'), originalName: 'JorgeO'),
                    FileUploader::IMAGE_PATH
                ),
            ],
        ];
        foreach ($authors as $authorName => $authorData) {
            Author::create([
                'full_name' => $authorName,
                'photo' => $authorData['photo'] ?? null,
            ]);
        }
    }
}
