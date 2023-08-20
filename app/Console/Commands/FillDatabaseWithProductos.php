<?php

namespace App\Console\Commands;

use App\Models\Producto;
use Illuminate\Console\Command;
use Faker\Factory as FakerFactory;

class FillDatabaseWithProductos extends Command
{
    protected $signature = 'db:fill-productos';

    protected $description = 'Fill the database with productos';

    public function handle()
    {
        $faker = FakerFactory::create();

        $departamentoIds = [1, 2, 3, 4, 5, 6, 7];
        $categoriaIds = [1, 2, 3, 4, 5, 6, 7, 8];
        $colaboradorIds = range(1, 16);

        for ($i = 0; $i < 50; $i++) {
            $departamentoId = $faker->randomElement($departamentoIds);
            $ciudadId = $this->getCorrespondingCiudadId($departamentoId);
            $categoriaId = $faker->randomElement($categoriaIds);
            $colaboradorId = $faker->randomElement($colaboradorIds);

            Producto::create([
                'IdInscribirProducto' => $faker->numberBetween(1, 12),
                'IdDepartamento' => $departamentoId,
                'IdCiudad' => $ciudadId,
                'IdCategoria' => $categoriaId,
                'IdColaborador' => $colaboradorId,
                'Nombre' => $faker->unique()->word . ' ' . $faker->unique()->word,
                'Precio' => $faker->randomFloat(2, 10, 1000),
                'Descripcion' => $faker->paragraph(2),
            ]);
        }

        $this->info('50 productos created successfully.');
    }

    protected function getCorrespondingCiudadId($departamentoId)
    {
        switch ($departamentoId) {
            case 1:
                return rand(1, 5);
            case 2:
                return 10;
            case 3:
                return rand(7, 9);
            case 4:
                return 11;
            case 5:
                return 2;
            case 6:
                return 6;
            case 7:
                return 1;
            default:
                return 1;
        }
    }
}
