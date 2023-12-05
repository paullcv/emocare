<?php

namespace App\Http\Controllers;

use App\Imports\UAGRMImport;
use App\Exports\UAGRMExport;
use App\Imports\CiudadImport;
use App\Models\Ciudad;
use App\Models\Datosuagrm;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Imports\CiudadExcelImporter;
use App\Imports\ExcelImport;
use App\Models\Excel;
use App\Models\Imagen;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
//use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel as ExcelExcel;

use Maatwebsite\Excel\Validators\ValidationException;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ExcelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('import-form');
    }

    public function showImportForm()
    {

        // $tipo = "ShowDataUagrm";
        // $Datosuagrm = DB::select('CALL Proc_List_Gral_V01(:tipo)', ['tipo' => $tipo]);

        // $NameColumn = !empty($Datosuagrm) ? array_keys((array) $Datosuagrm[0]) : [];
        // return view('import-form', compact('Datosuagrm', 'NameColumn'));

        // Utiliza el modelo para obtener todos los datos
        $Datosexcel = User::all(); // Esto obtendrá todos los registros de la tabla
        //  $NameColumn = Excel::first()->getFillable();

        //solo para el encabezado
        $excelModel = new User; // Crear una instancia del modelo, no importa si hay registros o no
        //From database
        $NameColumn = Schema::getColumnListing('excel');
        // $NameColumn = excelModel::first()->getFillable();

        $NameColumn = $excelModel->getFillable();
        // return $Datosexcel;
        return view('users.import', compact('Datosexcel', 'NameColumn'));
    }


    // public function import_actual_v1(Request $request)
    // {
    //     //import_actual
    //     // Obtener el archivo Excel subido
    //     $file = $request->file('excel_file');

    //     // Obtener el índice de la hoja (la primera hoja tiene un índice de 0)
    //     $sheetIndex = 1;

    //     // Cargar el archivo Excel usando PhpSpreadsheet
    //     $spreadsheet = IOFactory::load($file);
    //     $sheet = $spreadsheet->getSheet($sheetIndex);

    //     // Obtener la primera fila que contiene los nombres de las columnas
    //     $headerRow = $sheet->getRowIterator()->current();
    //     $cellIterator = $headerRow->getCellIterator();
    //     $cellIterator->setIterateOnlyExistingCells(false);

    //     // Crear un mapeo de nombres de columna y sus respectivas letras
    //     $columnMap = [];
    //     foreach ($cellIterator as $cell) {
    //         $column = $cell->getColumn();
    //         $value = $cell->getValue();
    //         $columnMap[$value] = $column;
    //     }

    //     // Iterar sobre las filas de datos
    //     foreach ($sheet->getRowIterator() as $index => $row) {
    //         if ($index == 1) {
    //             // Saltar la primera fila que contiene los nombres de las columnas
    //             continue;
    //         }

    //         $cellIterator = $row->getCellIterator();
    //         $cellIterator->setIterateOnlyExistingCells(false);

    //         $data = [];
    //         foreach ($cellIterator as $cell) {
    //             $column = $cell->getColumn();
    //             $value = $cell->getValue();
    //             $columnName = array_search($column, $columnMap);
    //             $data[$columnName] = $value;
    //         }

    //         // Obtener los valores de las columnas por su nombre
    //         $descripcion = $data['Descripcion'] ?? null;
    //         $sigla = $data['Sigla'] ?? null;
    //         $longitud = $data['Longitud'] ?? null;
    //         $latitud = $data['Latitud'] ?? null;

    //         // Verificar si el registro ya existe en la base de datos
    //         $ciudad = Ciudad::where('descripcion', $descripcion)->first();

    //         if ($ciudad) {
    //             // Si el registro existe, actualizar los campos
    //             $ciudad->sigla = $sigla;
    //             $ciudad->longitud = $longitud;
    //             $ciudad->latitud = $latitud;
    //             $ciudad->save();
    //         } else {
    //             // Si el registro no existe, crear uno nuevo
    //             Ciudad::create([
    //                 'descripcion' => $descripcion,
    //                 'sigla' => $sigla,
    //                 'longitud' => $longitud,
    //                 'latitud' => $latitud,
    //             ]);
    //         }
    //     }


    //     return redirect()->back()->with('success', 'La importación del archivo Excel se ha completado.');
    // }

    public function import118(Request $request)
    {
        ExcelExcel::import(new ExcelImport, request()->file('excel_file'));
        // Almacenar el mensaje de importación exitosa en la sesión
        Session::flash('success', '¡Los datos se han importado con éxito!');
        // Redirigir de vuelta a la misma vista
        return back();
    }



    // public function import(Request $request)
    // {
    //     try {
    //         Excel::import(new ExcelImport, $request->file('excel_file'));

    //         // Almacenar el mensaje de importación exitosa en la sesión
    //         Session::flash('success', '¡Los datos se han importado con éxito!');
    //     } catch (ValidationException $e) {
    //         // Manejar excepciones de validación específicas de Laravel Excel
    //         // Puedes obtener detalles de validación del objeto $e
    //         // Por ejemplo, puedes obtener los errores de validación con $e->validator->errors()->toArray()

    //         // Pasar los errores a la vista
    //         return back()->withErrors($e->validator->errors()->toArray())->withInput();
    //     } catch (Exception $e) {
    //         // Manejar otras excepciones generales
    //         // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico al usuario
    //         Session::flash('error', 'Se ha producido un error durante la importación.');
    //     }

    //     // Redirigir de vuelta a la misma vista
    //     return back();
    // }



    public function import(Request $request)
    {
        return "holaaa";
        // Validar la solicitud y asegurarse de que tenga un archivo
        $validator = Validator::make($request->all(), [
            'excel_file' => 'required|mimes:xlsx,csv,txt',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            // Validar campos específicos antes de la importación
            $validator = Validator::make($request->all(), [
                // Agrega las reglas de validación necesarias para los campos
                'nombre' => 'required|string',
                'correoelectronico' => 'required|email',
                'tipo' => 'required|in:1,2,3,4', // Ajusta los valores permitidos
                'password' => 'required|min:8',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            // Si la validación pasa, realiza la importación
            ExcelExcel::import(new ExcelImport, $request->file('excel_file'));

            // Almacenar el mensaje de importación exitosa en la sesión
            session()->flash('success', '¡Los datos se han importado con éxito!');
        } catch (Exception $e) {
            // Manejar otras excepciones generales
            // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico al usuario
            session()->flash('error', 'Se ha producido un error durante la importación. Detalles: ' . $e->getMessage());
            Log::error('Error durante la importación: ' . $e->getMessage());
                }

        // Redirigir de vuelta a la misma vista
        return back();
    }



    public function import0007(Request $request)
    {
        // DB::table('imagen')->delete();
       // DB::table('user')->where('tipo', 1)->delete();
        // DB::statement('ALTER TABLE imagen AUTO_INCREMENT = 1');
        //  DB::statement('ALTER TABLE datosuagrm AUTO_INCREMENT = 1');

        try {
            ExcelExcel::import(new ExcelImport, request()->file('excel_file'));

            // Almacenar el mensaje de importación exitosa en la sesión
          //  Session::flash('success', '¡Los datos se han importado con éxito!');
        } catch (ValidationException $e) {
            // Manejar excepciones de validación específicas de Laravel Excel
            // Puedes obtener detalles de validación del objeto $e
            // Por ejemplo, puedes obtener los errores de validación con $e->failures()
            // y luego manejarlos de acuerdo a tus necesidades.
            Session::flash('error', 'Error de validación durante la importación.');
        } catch (Exception $e) {
            // Manejar otras excepciones generales
            // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico al usuario
            Session::flash('error', 'Se ha producido un error durante la importación.');
        }
        // Redirigir de vuelta a la misma vista
        return back();
    }



    public function import00(Request $request)
    {
        // DB::table('imagen')->delete();
        // DB::table('user')->where('tipo', 1)->delete();
        // DB::statement('ALTER TABLE imagen AUTO_INCREMENT = 1');
        //  DB::statement('ALTER TABLE datosuagrm AUTO_INCREMENT = 1');

        try {
            ExcelExcel::import(new ExcelImport, request()->file('excel_file'));

            // Almacenar el mensaje de importación exitosa en la sesión
            // Session::flash('success', '¡Los datos se han importado con éxito!');
        } catch (ValidationException $e) {
            // Manejar excepciones de validación específicas de Laravel Excel
            // Puedes obtener detalles de validación del objeto $e
            // Por ejemplo, puedes obtener los errores de validación con $e->failures()
            // y luego manejarlos de acuerdo a tus necesidades.
            Session::flash('error', 'Error de validación durante la importación.');
        } catch (Exception $e) {
            // Manejar otras excepciones generales
            // Por ejemplo, puedes registrar el error o mostrar un mensaje genérico al usuario
            Session::flash('error', 'Se ha producido un error durante la importación.');
        }
        // Redirigir de vuelta a la misma vista
        return back();
    }

    // public function import_dabien(Request $request)
    // {
    //     // return dd(request()->file('excel_file'));
    //     //  return "oki";
    //     Datosuagrm::truncate();

    //     // return "oki";
    //     Excel::import(new UAGRMImport, request()->file('excel_file'));
    //     //Excel::import(new YourImportClass, 'archivo.xlsx', null, Excel::XLSX);

    //     return back();
    // }


    // public function export()
    // {
    //     return Excel::download(new UAGRMExport, 'UAGRM_Export.xlsx');
    // }

    // public function edit($id)
    // {
    //     $data = DB::table('datosuagrm')->where('Id_DatosUagrm',$id)->get();

    //     return view('auth.edit_data', ['id' => $id], ['datos' => $data]);
    // }

    // public function store(Request $request, $id)
    // {
    //     DB::table('datosuagrm')->where('Id_DatosUagrm', $id)->
    //     update(array('Facultad' => $request->input('facultad'), 'Descripcion' => $request->input('descripcion'),
    //      'Localidad' => $request->input('localidad'), 'Recursos' => $request->input('recursos'),
    //      'Latitud' => $request->input('latitud'), 'Longitud' => $request->input('longitud')));
    //     return redirect()->route('index.import');
    // }
}
