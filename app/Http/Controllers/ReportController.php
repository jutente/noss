<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use JasperPHP\JasperPHP;

use App\Servidor;
use App\Historico;
use App\Setor;

use Response;
use Auth;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Illuminate\Validation\Rule;


class ReportController extends Controller
{
/**
     * Reporna um array com os parametros de conexão
     * @return Array
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getDatabaseConfig()
    {
        return [
            'driver'   => env('DB_CONNECTION'),
            'host'     => env('DB_HOST'),
            'port'     => env('DB_PORT'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'database' => env('DB_DATABASE'),
            'jdbc_dir' => base_path() . env('JDBC_DIR', '/vendor/lavela/phpjasper/src/JasperStarter/jdbc'),
        ];
    }
    
    public function index($id)
    {

        // receber parametros

        $historico = Historico::findorfail($id);
        $servidor = Servidor::findorfail($historico->idservidor);
        $setororigem = Setor::findorfail($historico->idsetororigem);
        $setordestino = Setor::findorfail($historico->idsetordestino);
         
    
        // coloca na variavel o caminho do novo relatório que será gerado
        $output = public_path() . '/reports/' . time() . '_Clientes';
        // instancia um novo objeto JasperPHP
         
        $report = new JasperPHP;
        // chama o método que irá gerar o relatório
        // passamos por parametro:
        // o arquivo do relatório com seu caminho completo
        // o nome do arquivo que será gerado
        // o tipo de saída
        // parametros ( nesse caso não tem nenhum) 
        
        $nome = $servidor->servidor;
        $matricula = $servidor->matricula;
        $quadrofuncional = $servidor->situacao;
        $jornada = $servidor->jornada;
        $lotacaoorigem = $setororigem->setor;
        $codlotacaoorigem = $setororigem->centrocusto;
        $lotacaodestino = $setordestino->setor;
        $codlotacaodestino = $setordestino->centrocusto;
        $dtmudanca =\Carbon\Carbon::parse($historico->dtmudanca)->format('d/m/Y');

        $report->process(
            public_path() . '/reports/guia_transferencia.jrxml',
            $output,
            ['pdf'],
            ['nome' => $nome,
            'matricula' => $servidor->matricula,
            'quadrofuncional' => $servidor->situacao,
            'jornada' => $servidor->jornada,
            'lotacaoorigem' => $setororigem->setor,
            'codlotacaoorigem' => $setororigem->centrocusto,
            'lotacaodestino' => $setordestino->setor,
            'codlotacaodestino' => $setordestino->centrocusto,
            'dtmudanca' => $dtmudanca,],
            $this->getDatabaseConfig()
        )->execute();
   
        $file = $output . '.pdf';
        $path = $file;
        
        // caso o arquivo não tenha sido gerado retorno um erro 404
        if (!file_exists($file)) {
            abort(404);
        }
//caso tenha sido gerado pego o conteudo
        $file = file_get_contents($file);
//deleto o arquivo gerado, pois iremos mandar o conteudo para o navegador
        unlink($path);
// retornamos o conteudo para o navegador que íra abrir o PDF
        return response($file, 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="guia_transferencia.pdf"');
     
    }
}