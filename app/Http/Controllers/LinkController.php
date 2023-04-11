<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LinkService;
use App\Http\Requests\SaveLinkRequest;
use App\Http\Requests\DestroyLinkRequest;
use App\Events\LinkAccessed;
use Illuminate\Support\Facades\Redirect;

class LinkController extends Controller
{
    private LinkService $linkService;
    
    public function __construct(
        LinkService $linkService
    ) {
        $this->linkService = $linkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $links = $this->linkService->getCurrentUserLinks();
        return view('links.index', ['links' => $links]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->cannot('create', Link::class)) {
            return redirect()
                ->route('links.index')
                ->withErrors([__('links.max_links_count_reached')]);
        }
        return view('links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\SaveLinkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveLinkRequest $request)
    {
        $success = $this->linkService->createLinkWithCurrentUser($request->get('original'));
        if(!$success){
            abort(500);
        }
        return redirect()->route('links.index')
            ->with('success', __('links.short_link_created_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Requests\DestroyLinkRequest $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyLinkRequest $request)
    {
        $this->linkService->destroyLink($request->route('link'));
        return redirect()->route('links.index')
            ->with('success', __('links.short_link_deleted_success'));
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $shortLink
     * @param \Illuminate\Http\Request $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function redirection(Request $request, string $shortLink)
    {
        $source = $this->linkService->getOriginalByShortLink($shortLink);
        if($source){
            event(new LinkAccessed($request));
            return Redirect::to($source);
        }
        else{
            abort(404);
        }
    }

    
}
