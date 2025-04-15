<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journal;
use App\Models\Person;
use App\Models\Publication;
use App\Models\Author;

class PublicationsSeeder extends Seeder
{
    public function run()
    {
        // Очищаем таблицы (для повторного запуска)
        Author::truncate();
        Publication::truncate();
        Journal::truncate();
        Person::truncate();

        // Создаем журналы
        $journal1 = Journal::create(['name' => 'Science Today']);
        $journal2 = Journal::create(['name' => 'Nature Reviews']);
        $journal3 = Journal::create(['name' => 'Технический вестник']);

        // Создаем персон
        $person1 = Person::create([
            'full_name' => 'Иванов Иван Иванович',
            'birth_date' => '1980-05-15'
        ]);
        
        $person2 = Person::create([
            'full_name' => 'Петрова Мария Сергеевна',
            'birth_date' => '1975-11-22'
        ]);
        
        $person3 = Person::create([
            'full_name' => 'Сидоров Алексей Петрович',
            'birth_date' => '1990-03-10'
        ]);

        // Создаем публикации и связываем с авторами
        $publication1 = Publication::create([
            'journal_id' => $journal1->id,
            'title' => 'Новые открытия в квантовой физике',
            'publication_date' => '2023-01-10'
        ]);
        
        $publication1->authors()->createMany([
            ['person_id' => $person1->id, 'contribution_share' => 60],
            ['person_id' => $person3->id, 'contribution_share' => 40]
        ]);

        $publication2 = Publication::create([
            'journal_id' => $journal2->id,
            'title' => 'Биоразнообразие коралловых рифов',
            'publication_date' => '2023-02-15'
        ]);
        
        $publication2->authors()->create([
            'person_id' => $person2->id,
            'contribution_share' => 100
        ]);

        // Публикация с тремя авторами
        $publication3 = Publication::create([
            'journal_id' => $journal3->id,
            'title' => 'Современные технологии в энергетике',
            'publication_date' => '2023-03-20'
        ]);
        
        $publication3->authors()->createMany([
            ['person_id' => $person1->id, 'contribution_share' => 40],
            ['person_id' => $person2->id, 'contribution_share' => 35],
            ['person_id' => $person3->id, 'contribution_share' => 25]
        ]);
    }
}