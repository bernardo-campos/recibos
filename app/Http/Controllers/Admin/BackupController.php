<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    public function index()
    {
        $spfileinfos = $this->getFiles(true);

        return view('admin.backups.index', [
            'files' => $spfileinfos,
        ]);
    }


    // TODO: llevar a un helper o a un service

    public function getFiles($basename = false, $folder = '')
    {

        $files = [];
        $pattern = '*.zip';
        $fullPath = storage_path('backups/' . env('APP_NAME', 'laravel-backup')) . '/' . $folder;

        abort_if(!is_dir($fullPath), 403, "El directorio $fullPath no existe");

        $listObject = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($fullPath, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::CHILD_FIRST
        );

        foreach ($listObject as $fileinfo) {
            if (!$fileinfo->isDir() && strtolower(pathinfo($fileinfo->getRealPath(), PATHINFO_EXTENSION)) == explode('.', $pattern)[1]) {
                $files[] = $fileinfo;
            }
        }

        arsort($files);

        return array_values($files);
    }
}
