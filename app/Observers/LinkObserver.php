<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Str;
use App\Services\LinkService;

class LinkObserver
{
    private LinkService $linkService;
    
    public function __construct(
        LinkService $linkService
    ) {
        $this->linkService = $linkService;
    }
    
    /**
     * Handle the Link "creating" event.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Link $link
     * @return void
     */
    public function creating(Link $link)
    {
        if(
            $this->linkService->getUserLinksCount($link->user) === 5 ||
            $link->user->role !== 'user'
        )
        {
            return false;
        }
        $link->converted = Str::random(6);
        return true;
    }

    /**
     * Handle the Link "created" event.
     *
     * @param  \App\Models\Link $link
     * @return void
     */
    public function created(Link $link)
    {
        if($this->linkService->countLinks() === 21){
            $this->linkService->deleteOldestLink();
        }
        return true;
    }

}