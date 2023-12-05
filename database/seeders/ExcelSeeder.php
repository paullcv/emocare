<?php

namespace Database\Seeders;

use App\Models\Excel;
use App\Models\Uagrmgral;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Mockery\Matcher\HasKey;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Psy\Readline\Hoa\Console;
use Symfony\Component\Console\Output\ConsoleOutput;

class ExcelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = public_path('excel/usuarios_seeder.xlsx');
        $sheetIndex = 0; // Índice de la hoja (la primera hoja tiene un índice de 0)

        // Cargar el archivo Excel usando PhpSpreadsheet
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getSheet($sheetIndex);

        // Obtener la primera fila que contiene los nombres de las columnas
        $headerRow = $sheet->getRowIterator()->current();
        $cellIterator = $headerRow->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);

        // Crear un mapeo de nombres de columna y sus respectivas letras
        $columnMap = [];
        foreach ($cellIterator as $cell) {
            $column = $cell->getColumn();
            $value = $cell->getValue();
            $columnMap[$value] = $column;
        }

        // Iterar sobre las filas de datos
        foreach ($sheet->getRowIterator() as $index => $row) {
            if ($index == 1) {
                // Saltar la primera fila que contiene los nombres de las columnas
                continue;
            }

            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false);

            $data = [];
            foreach ($cellIterator as $cell) {
                $column = $cell->getColumn();
                $value = $cell->getValue();
                $columnName = array_search($column, $columnMap);
                $data[$columnName] = $value;
            }

            // Obtener los valores de las columnas por su nombre
            $id = $data['Id'] ?? null;
            $nombre = $data['Nombre'] ?? null;
            $apellido = $data['Apellido'] ?? null;
            $tipo = $data['Tipo'] ?? null;
            $fechaNacimiento = Carbon::createFromDate(1900, 1, 1)->addDays($data['FechaNacimiento'] - 1);

           // $this->command->info("Fecha asdasdasdasdasd: " . $fechaNacimiento);

            $correoElectronico = $data['CorreoElectronico'] ?? null;
            $contrasenia = $data['Contrasenia'] ?? null;
            $curso = $data['Curso'] ?? null;
            $direccion = $data['Direccion'] ?? null;

            // Verificar si el registro ya existe en la base de datos
            $model = Excel::where('id', $id)->first();

            //$model =  Excel::find($id)

            try {
                if ($model) {
                    // Si el registro existe, actualizar los campos
                    $model->nombre = $nombre;
                    $model->apellido = $apellido;
                    $model->tipo = $tipo;
                    $model->fecha_nacimiento = $fechaNacimiento;
                    $model->correo_electronico = $correoElectronico;
                    $model->contrasenia = $contrasenia;
                    $model->curso = $curso;
                    $model->direccion = $direccion;
                    $model->save();
                } else {
                    // Si el registro no existe, crear uno nuevo
                    Excel::create([
                        'id' => $id,
                        'nombre' => $nombre,
                        'apellido' => $apellido,
                        'fechaNacimiento' => $fechaNacimiento,
                        'correoelectronico' => $correoElectronico,
                        'contrasenia' => $contrasenia,
                        'curso' => $curso,
                        'direccion' => $direccion,
                    ]);
            
                    User::create([
                        'name' => $nombre,
                        'email' => $correoElectronico,
                        'tipo' => $tipo,
                        'password' => Hash::make($contrasenia),
                    ]);
                }
            } catch (Exception $e) {
                // Manejar la excepción aquí
                // Puedes imprimir un mensaje de error o realizar acciones específicas de manejo de errores.
                // Por ejemplo: Log::error($e->getMessage());
                Log::error($e->getMessage());
                // También podrías lanzar una nueva excepción o simplemente dejarla en blanco dependiendo de tus necesidades.
            }
            
        }
    }
}
