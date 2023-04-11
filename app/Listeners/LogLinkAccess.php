<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use App\Events\LinkAccessed;
use App\Services\LogService;

class LogLinkAccess
{
    private LogService $logService;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        LogService $logService
    ) {
        $this->logService = $logService;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\LinkAccessed $event
     * @return void
     */
    public function handle(LinkAccessed $event)
    {
        $this->logService->createLinkLogFromRequest($event->request);
    }
}
