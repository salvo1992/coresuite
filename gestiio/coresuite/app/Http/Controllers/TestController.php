<?php

namespace App\Http\Controllers;


class TestController extends Controller
{


    public function __invoke()
    {

        abort(404);

    }

    protected function letturaPdf()
    {
        $parser = new \Smalot\PdfParser\Parser();
        $path1 = public_path('/testlettura/f1.pdf');
        $path2 = public_path('/testlettura/f2.pdf');
        $pdf = $parser->parseFile($path1);
        $text = explode(PHP_EOL, $pdf->getText());


        $nome = 1;
        $pdr = 18;
        $importo = 45;

        dd($this->getCoordinates($path2));
        dd($text[$nome], $text[$pdr], $text[$importo], $text);
    }

    protected function getCoordinates($pdfPath)
    {
        $config = new \Smalot\PdfParser\Config();
        // add configs stuff
        $parser = new \Smalot\PdfParser\Parser([], $config);
        $pdf = $parser->parseFile($pdfPath);
        $coordinates = [];
        $currentPage = 1;

        foreach ($pdf->getPages() as $page) {
            $details = $page->getDetails();
            $coordinates[] = "\n[Page : $currentPage, width = {$details['MediaBox'][2]}, height = {$details['MediaBox'][3]}]";
            foreach ($page->getDataTm() as $data) {
                $x = $data[0][4];
                // Calculate y from the bottom
                $y = $details['MediaBox'][3] - $data[0][5];
                $w = $data[0][0];
                $h = $data[0][3];
                // Parser add \\r when a line on 1 row is too long so discard it
                $s = mb_convert_encoding(str_replace("\\\r", '', $data[1]), 'UTF-8');
                $coordinates[] = "[x:$x, y:$y, w: $w, h:$h]{$s}";
            }
            $currentPage++;
        }
        if ($coordinates === [])
            return back()->with('error', 'Coordinates not .');
        return $coordinates;
    }

    protected function ricalcolaGuadagnoAgenzia()
    {
        $guadagno = GuadagnoAgenzia::firstOrNew(['anno' => 2023, 'mese' => 1]);
        $guadagno->calcolaGuadagnoContratti();
    }


    protected function creaFattureProforma()
    {
        $fattura = new FatturaProformaService(2023, 2);
        dd($fattura->creaFattureProformaTutti());
    }


}
