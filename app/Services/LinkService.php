<?php

namespace App\Services;

use App\Models\Link;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class LinkService
{
    /**
     * Get current user all links.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCurrentUserLinks() : Collection
    {
        $user = auth()->user();
        
        return $user->links()->get();
    }

    /**
     * Get current user links count.
     *
     * @return int
     */
    public function getCurrentUserLinksCount() : int
    {
        return $this->getCurrentUserLinks()->count();
    }

    /**
     * Get a user links count.
     * @param \App\Models\User $user
     * @return int
     */
    public function getUserLinksCount(User $user) : int
    {
        return $user->links()->count();
    }


    /**
     * Create link.
     *
     * @param String $original
     * @return boolean
     */
    public function createLinkWithCurrentUser(String $original) : bool
    {
        $user = auth()->user();
        $link = Link::create([
            'original' => $original,
            'user_id' => $user->id
        ]);
        if(!$link->wasRecentlyCreated){
            return false;
        }
        return true;
    }

    /**
     * Links count.
     *
     * @return int
     */
    public function countLinks() : int
    {
        return Link::count();
    }

    /**
     * Delete oldest link.
     *
     * @return boolean
     */
    public function deleteOldestLink() : bool
    {
        $oldestLink = Link::oldest()->first();
        return $oldestLink->delete();
    }

    /**
     * Destroy link.
     *
     * @param int $linkId
     * @return boolean
     */
    public function destroyLink(int $linkId) : bool
    {
        $link = Link::find($linkId);
        return $link->delete();
    }

    /**
     * Get original link by short one.
     *
     * @param string $shortLink
     * @return string|null
     */
    public function getOriginalByShortLink(string $shortLink) : ?string
    {
        $link = Link::where('converted', $shortLink)->first();
        return $link ? $link->original : null;
    }
}
