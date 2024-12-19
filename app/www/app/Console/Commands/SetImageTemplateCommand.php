<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Repository\IBookRepository;
use Illuminate\Console\Command;

class SetImageTemplateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:set-image-template';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Заменяет у всех книг изображение на дефолтный шаблон';

    /**
     * Execute the console command.
     */
    public function handle(IBookRepository $bookRepository)
    {
        $books = Book::query()->cursor();
        foreach ($books as $book) {
            $bookRepository->uploadCoverImg($bookRepository->getDefaultCoverImg());
            $book->update(['cover_img' => $bookRepository->cover_img]);
        }
    }
}
