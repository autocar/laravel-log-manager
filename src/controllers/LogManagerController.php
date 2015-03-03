<?php
namespace autocar\LaravelLogManager;

use Illuminate\Support\Facades\View;

class LogManagerController extends \Illuminate\Routing\Controller
{

    public function index()
    {
        if (\Input::get('l')) {
            LaravelLogManager::setFile(base64_decode(\Input::get('l')));
        }
        if (\Input::get('d')) {
            $log_file = glob(storage_path().'/logs'.'/'.base64_decode(\Input::get('d')));
            \File::delete($log_file);
            return redirect()->to('logs');
        }
        $logs = LaravelLogManager::all();
        View::addNamespace('laravel-log-manager', __DIR__.'/../views');

        return View::make('laravel-log-manager::log', [
            'logs' => $logs,
            'files' => LaravelLogManager::getFiles(true),
            'current_file' => LaravelLogManager::getFileName()
        ]);
    }

}
