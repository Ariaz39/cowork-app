<?php

namespace Database\Seeders;

use App\Models\Workspace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkspaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Workspace::create([
            'name' => 'Sala de Reuniones 1',
            'description' => 'Espacio ideal para reuniones pequeñas con capacidad para 6 personas.',
        ]);

        Workspace::create([
            'name' => 'Espacio de Co-Working',
            'description' => 'Área de trabajo compartido con estaciones de trabajo individuales.',
        ]);

        Workspace::create([
            'name' => 'Sala de Conferencias',
            'description' => 'Sala de conferencias equipada con proyector y capacidad para 20 personas.',
        ]);
    }
}
