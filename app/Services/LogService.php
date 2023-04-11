<?php

namespace App\Services;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Location;

class LogService
{
    
    /**
     * Create link.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    public function createLinkLogFromRequest(Request $request) : bool
    {
        $user = auth()->user();
        $ip = $request->ip();
        $link = Log::create([
            'source' => $request->shortLink,
            'ip' => $ip,
            'country' => \Location::get($ip)->countryName ?? null,
            'user_agent' => $request->header('user-agent'),
            'user_id' => $user !== null ? $user->id : null,
        ]);
        if(!$link->wasRecentlyCreated){
            return false;
        }
        return true;
    }

    /**
     * Get paginated links log.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getPaginatedLinksLog() : LengthAwarePaginator
    {
        return Log::with('user')->paginate(5);
    }

}
