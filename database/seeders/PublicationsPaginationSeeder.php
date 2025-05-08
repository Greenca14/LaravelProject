<?php

namespace Database\Seeders;

use App\Models\Journal;
use App\Models\Publication;
use Illuminate\Database\Seeder;

class PublicationsPaginationSeeder extends Seeder
{
    public function run()
    {
        // Создаем журнал через фабрику
        $journal = Journal::factory()->create([
            'name' => 'Журнал для пагинации'
        ]);

        // Создаем публикации
        Publication::factory()
            ->count(20)
            ->create([
                'journal_id' => $journal->id
            ]);
    }
}