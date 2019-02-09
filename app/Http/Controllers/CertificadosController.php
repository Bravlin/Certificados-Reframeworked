<?php

namespace App\Http\Controllers;

define("URL","http://www3.fi.mdp.edu.ar/cibercrimen/verificacion.php?verif=");

set_include_path(app_path().'/Librerias');

require_once 'fpdf.php';
require_once 'fpdi/autoload.php';
require_once 'phpqrcode/qrlib.php';

use App\Evento;
use App\Perfil;
use App\Certificado;
use App\Inscripcion;
use setasign\Fpdi\Fpdi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificadosController extends Controller
{
    /*
    * pdf->output
    * I: send the file inline to the browser. The PDF viewer is used if available.
    * D: send to the browser and force a file download with the name given by name.
    * F: save to a local file with the name given by name (may include a path).
    * S: return the document as a string.
    */
    private function genPdf($nombre, $param) {
        // initiate FPDI
        $pdf = new Fpdi('L','mm','A4');;
        // add a page
        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path().'/storage/templates/CERT.asistencia_ciberdefensa.pdf');
        // import page 1
        $tplIdx = $pdf->importPage(1);
        // use the imported page and place it at position 10,10 with a width of 100 mm
        $pdf->useTemplate($tplIdx);

        // now write some text above the imported page
        $pdf->SetFont('Helvetica','B',24);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(140 - $pdf->GetStringWidth($nombre)/2, 100);
        $pdf->Write(0, $nombre);

        // generación del qr
        $codeText = URL.$param;

        $l = $pdf->AddLink();
        $pdf->SetLink($l, 0, $codeText);

        $img = $this->grGenerator($codeText);
        $pic = 'data://text/plain;base64,' . base64_encode(($img));
        $pdf->Image($pic,118,152,45,45,'PNG',$codeText);

        $pdf->SetTextColor(0,0,255);
        $pdf->SetFont('Arial','B',12);
        $text = "Codigo Verificaci".hex2bin("c3b3")."n: ".$param;
        echo mb_detect_encoding($text)."<br>";
        if (mb_detect_encoding($text) == "ASCII") {
            $text = utf8_encode($text);
        }

        $pdf->SetXY(140 - $pdf->GetStringWidth($text)/2, 145);
        $pdf->Write(0, utf8_decode($text),$codeText);

        return $pdf;
    }

    private function grGenerator($url) {
        $codeContents = $url;
        $outerFrame = 4;
        $pixelPerPoint = 5;
        $jpegQuality = 95;

        // generating frame
        $frame = \QRcode::text($codeContents, false, QR_ECLEVEL_M);

        // rendering frame with GD2 (that should be function by real impl.!!!)
        $h = count($frame);
        $w = strlen($frame[0]);

        $imgW = $w + 2*$outerFrame;
        $imgH = $h + 2*$outerFrame;

        $base_image = imagecreate($imgW, $imgH);
        $logo = imagecreatefrompng("img/logofi2.png");

        $h_logo = imagesy($logo);
        $w_logo = strlen($logo[0]);

        $imgW_logo = $w_logo + 2*$outerFrame;
        $imgH_logo = $h_logo + 2*$outerFrame;

        $col[0] = imagecolorallocate($base_image,255,255,255); // BG, white
        $col[1] = imagecolorallocate($base_image,0,0,255);     // FG, blue

        imagefill($base_image, 0, 0, $col[0]);

        for ($y=0; $y<$h; $y++) {
            for ($x=0; $x<$w; $x++) {
                if ($frame[$y][$x] == '1') {
                    imagesetpixel($base_image,$x+$outerFrame,$y+$outerFrame,$col[1]);
                }
            }
        }

        // saving to file
        $target_image = imagecreate($imgW * $pixelPerPoint, $imgH * $pixelPerPoint);
        imagecopyresized(
            $target_image,
            $base_image,
            0, 0, 0, 0,
            $imgW * $pixelPerPoint, $imgH * $pixelPerPoint, $imgW, $imgH
        );

        $x_target = imagesx($target_image);
        $y_target = imagesy($target_image);

        $x_logo = imagesx($logo);
        $y_logo = imagesy($logo);

        $target_logo = imagecreate(intval($x_target/4*1.2), intval($y_target/4));
        imagecopyresized(
            $target_logo,
            $logo,
            0, 0, 0, 0,
            intval($x_target/4*1.2) , intval($y_target/4), $x_logo, $y_logo
        );

        echo ($x_target." ".$y_target." ".$x_logo." ".$y_logo." -- " );

        imagecopy($target_image, $target_logo, intval(($x_target/2)-(imagesx($target_logo)/2)), intval($y_target/2)-((imagesy($target_logo)/2)), 0, 0,  imagesx($target_logo), imagesy($target_logo));

        imagedestroy($base_image);
        imagedestroy($logo);
        ob_start();
        imagepng($target_image);
        imagepng($target_logo);
        $imagedata = ob_get_contents();
        ob_end_clean();
        imagedestroy($target_image);
        return $imagedata;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $certificados = Certificado::juntada(['evento_nombre', 'perfil_nombre', 'perfil_apellido']);
            return view('certificados.index', compact('certificados'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    public function indexEvento(Evento $evento)
    {
        try {
            $certificados = Certificado::juntada(
                ['perfil_nombre', 'perfil_apellido'],
                [['evento.id_evento', '=', (string) $evento->id_evento]]
            );
            return view('certificados.index', compact('certificados'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    public function indexPerfil(Perfil $perfil)
    {
        try {
            $certificados = Certificado::juntada(
                ['evento_nombre'],
                [['perfil.id', '=', (string) $perfil->id]]
            );
            return view('certificados.index', compact('certificados'));
        } catch (\Throwable $th) {
            abort(500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Inscripcion  $inscripcion
     */
    public function generarIndividual(Inscripcion $inscripcion)
    {
        if ($inscripcion->asistencia != 1)
            abort(409);
        else {
            $id = $inscripcion->id_inscripcion;
            $nombre = ucwords(strtolower($inscripcion->perfil->nombre));
            $apellido = ucwords(strtolower($inscripcion->perfil->apellido));
            $apiNombre = preg_replace('/\s+/', ' ', $nombre." ".$apellido);
            $apiNombre = utf8_decode($apiNombre);

            // Esta pregunta es contradictoria con el updateOrCreate
            if (Certificado::where('fk_inscripcion', $id)->count() == 0) {
                $param = $id.rand(1000, 9999);
                $param = str_pad($param, 8, '0', STR_PAD_LEFT);

                $pdf = $this->genPdf($apiNombre, $param);
                $file = "Certificado_jornada_cibercrimen_". utf8_decode(str_replace(' ', '_', $apiNombre));
                $file = preg_replace("/[^a-zA-Z0-9\_\-]+/", "_", $file);
                $file = $file.".pdf";

                $pdf->Output('F', public_path().'/storage/tmp/'.$file);
                $pdf->Output('F', public_path().'/storage/certificados/'.$file);

                $bId = $id;
                $bNombreCertificado = $file;
                $bAleatorio = $param;
                Certificado::updateOrCreate(
                    ['fk_inscripcion' => $bId],
                    [
                        'fk_inscripcion' => $bId,
                        'nombre_certificado' => $bNombreCertificado,
                        'aleatorio' => $bAleatorio
                    ]
                );
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Certificado $certificado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Certificado  $certificado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificado $certificado)
    {
        $archivo = 'certificados/'.$certificado->nombre_certificado;
        if (Storage::disk('public')->exists($archivo)) {
            Storage::disk('public')->delete('certificados/'.$certificado->nombre_certificado);
            $certificado->delete();
        }
        else
            abort(500);
    }
}
