<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Perfil;
use App\Caracter;
use App\Inscripcion;
use Illuminate\Http\Request;
use App\Ayudas\ValidadorMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class InscripcionMasivaController extends Controller
{
    private function procesarCsv(Request $request, $ruta)
    {
        $gestor = fopen($ruta, "r");
        if ($gestor === false) {
            Log::error('Error al tratar de abrir el archivo.');
            abort(500);
        } else {
            DB::transaction(function () use($request, $gestor) {
                $fila = 0;
                $datos = fgetcsv($gestor, 1000, ";");
                while ($datos !== false) {
                    $fila++;
                    $numero = count($datos);
                    Log::info('Número de campos en la línea '.$fila.': '.$numero);
                    Log::info('Datos: '.print_r($datos, true));
                    if ($numero != 6 && $numero != 7)
                        Log::error('Error en el tipo de datos.');
                    else {
                        $campos = [
                            'nombre' => $datos[0],
                            'apellido' => $datos[1],
                            'telefono' => $datos[2],
                            'email' => $datos[3],
                            'organismo' => $datos[4],
                            'cargo' => $datos[5]
                        ];
                        if (!$this->validarPerfil($campos))
                            Log::error('Uno o más datos son incorrectos.');
                        else {
                            Log::info('Datos correctos.');
                            $perfil = Perfil::updateOrCreate(
                               ['email' => $campos['email']],
                               $campos
                            );
                            Inscripcion::create([
                                'tipo' => $request->tipo,
                                'fk_perfil' => $perfil->id_perfil,
                                'fk_evento' => $request->evento,
                                'asistencia' => $request->asistencia
                            ]);
                        }
                    }
                    $datos = fgetcsv($gestor, 1000, ";");
                }
            });
            Log::info('Transacción exitosa.');
            fclose($gestor);
        }
    }

    private function validarPerfil($campos)
    {
        $iterator = new \ArrayIterator($campos);
        while ($iterator->valid() && $iterator->current() != '')
            $iterator->next();
        return !$iterator->valid() && $iterator->offsetExists('email') && ValidadorMail::superValidateEmail($iterator->offsetGet('email'));
    }

    /**
     * Muestra el formulario para inscribir perfiles de forma masiva.
     *
     * @return \Illuminate\Http\Response
     */
    public function agregarMasivo()
    {
        $eventos = Evento::select('id_evento', 'nombre')->orderBy('nombre')->get();
        $caracteres = Caracter::all();
        return view('perfiles.agregar-masivo', compact('eventos', 'caracteres'));
    }

    public function storeOrUpdateMasivo(Request $request)
    {
        $request->validate([
            'csvFile' => 'required|file|mimes:csv,txt',
            'evento' => 'required|exists:evento,id_evento',
            'tipo' => 'required|exists:caracter,caracter',
            'asistencia' => 'required|between:0,1'
        ]);

        Log::info('Procesando archivo para inscripción masiva.');
        $csv = $request->file('csvFile');
        $ruta = $csv->storeAs('tmp', $csv->getClientOriginalName(), 'public');
        if ($ruta === false) {
            Log::error('Error al subir el archivo.');
            abort(500);
        } else
            $this->procesarCsv($request, public_path().'/storage'.'/'.$ruta);
        return redirect('/perfiles');
    }
}
