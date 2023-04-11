<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LogService;

class LogController extends Controller
{
    private LogService $logService;
    
    public function __construct(
        LogService $logService
    ) {
        $this->logService = $logService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = $this->logService->getPaginatedLinksLog();
        return view('logs.index', ['logs' => $logs]);
    }
}
