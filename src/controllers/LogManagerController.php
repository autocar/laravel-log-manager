<?php
namespace autocar\LaravelLogManager;

use Illuminate\Support\Facades\View;

class LogManagerController extends \Illuminate\Routing\Controller
{

    public function index()
    {
        if (\Request::get('l')) {
            LaravelLogManager::setFile(base64_decode(\Request::get('l')));
        }
        if (\Request::get('d')) {
            $log_file = glob(storage_path().'/logs'.'/'.base64_decode(\Request::get('d')));
            \File::delete($log_file);
            return redirect()->back();
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
