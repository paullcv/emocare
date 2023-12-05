<?php

namespace App\Imports;

use App\Models\Excel;
use App\Models\Imagen;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash as FacadesHash;

use Illuminate\Support\Facades\Log;
use Psy\Readline\Hoa\Console;

use Illuminate\Support\Facades\Session;


class ExcelImport implements ToModel, WithHeadingRow //, ShouldQueue
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    // public function model(array $row)
    // {
    //     Log::info('Datos del Usuario:', $row);

    //     try {
    //         $user = new User([
    //             "name" => $row['nombre'] ?? null,
    //             "email" => $row['correoelectronico'] ?? null,
    //             "tipo" => $row['tipo'],null,
    //             "password" => FacadesHash::make($row['contrasenia'] ?? null),
    //         ]);
    
    //         $user->save();
    //         return $user;
    //     } catch (Exception $e) {
    //         Log::error($e->getMessage());
    //     }
    // }

    
    
    // public function model(array $row)
    // {
    //     Log::info('Datos del Usuario:', $row);

    //     try {
    //         $user = new User([
    //             "name" => $row['nombre'] ?? null,
    //             "email" => $row['correoelectronico'] ?? null,
    //             "tipo" => $row['tipo'] ?? null,
    //             "password" => FacadesHash::make($row['contrasenia'] ?? null),
    //         ]);

    //         $user->save();
    //                     Session::flash('success', '¡Los datos se han importado con éxito!');

    //         return $user;
    //     } catch (ValidationException $e) {
    //         // Manejar excepciones de validación específicas de Laravel Excel
    //         // Puedes obtener detalles de validación del objeto $e
    //         // Por ejemplo, puedes obtener los errores de validación con $e->errors()
    //       //  Log::error('Error de validación durante la importación: ' . json_encode($e->failures()));
    //        // $validationErrors = json_encode($e->errors(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    //     //    Log::error('Error de validación durante la importación: ' . $validationErrors);

    //         Log::error('Error de validación durante la importación: ');


    //     } catch (Exception $e) {
    //         // Manejar otras excepciones generales
    //         Log::error('Error durante la importación: ' . $e->getMessage());

    //     }
    // }




    // public function model(array $row)
    // {
    //     Log::info('Datos del Usuario:', $row);

    //     try {
    //         $user = new User([
    //             "name" => $row['nombre'] ?? null,
    //             "email" => $row['correoelectronico'] ?? null,
    //             "tipo" => $row['tipo'] ?? null,
    //             "password" => FacadesHash::make($row['contrasenia'] ?? null),
    //         ]);

    //         $user->save();
    //         Session::flash('success', '¡Los datos se han importado con éxito!');
    //         return $user;
    //     } catch (ValidationException $e) {
    //         // Manejar excepciones de validación específicas de Laravel Excel
    //         // Puedes obtener detalles de validación del objeto $e
    //         // Por ejemplo, puedes obtener los errores de validación con $e->failures()
        
    //         //$validationErrors = method_exists($e, 'errors') ? $e->errors() : [];

    //         // Almacenar los mensajes de error en la sesión
    //        // Session::flash('validation_errors', $validationErrors);

    //         // Loggear los errores si es necesario
    //         Log::error('Error de validación durante la importación: ' . json_encode($validationErrors, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    //         Session::flash('error', '¡Error de validación durante la importación!');

    //     } catch (Exception $e) {
    //         // Manejar otras excepciones generales
    //         Session::flash('error', '¡Error durante la importación!');
    //         Log::error('Error durante la importación: ' . $e->getMessage());
    //     }
    // }
    


    public function model(array $row)
    {
        Log::alert("dentro de excel import - model:",$row) ;
        try {
            $user = new User([
                "name" => $row['nombre'] ?? null + $row['apellido'] ?? null,
                "email" => $row['correoelectronico'] ?? null,
                "tipo" => $row['tipo'] ?? null,
                "password" => FacadesHash::make($row['contrasenia'] ?? null),
            ]);
            $user->save();
            Session::flash('success', '¡Los datos se han importado con éxito!');

            Log::info("success ¡Los datos se han importado con éxito!");
            return $user;
        } catch (ValidationException $e) {
            // Manejar excepciones de validación específicas de Laravel Excel
            // Puedes obtener detalles de validación del objeto $e
            // Por ejemplo, puedes obtener los errores de validación con $e->validator->errors()->toArray()
          //  throw $e;
        } catch (Exception $e) {
            // Manejar otras excepciones generales
          //  throw $e;
        }
    }

    
}
