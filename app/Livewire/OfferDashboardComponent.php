<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;
use App\Models\Item;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Storage;

class OfferDashboardComponent extends Component
{
    public $offers;
    public $games;
    public $category;
    public $offerId;

    public function pauseOffer($offerId, $pause) {
        $pause = $pause == 0 ? 1 : 0;
        $category = $this->category;

        $offer = Item::find($offerId);
        $offer->update([
                'pause' => $pause,
            ]);

        $this->offers = Item::where('seller_id', auth()->id())->with('categoryGame.attributes', 'categoryGame.game')->whereHas('categoryGame', function ($query) use  ($category){
            return $query->where('category_id', $category->id);
        })->orderBy('created_at', 'desc')->get();

        $this->games = Game::whereHas('categoryGames', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();

        $pause = $pause == 0 ? 'Active' : 'Paused';
        
        $this->dispatch('componentUpdate');

        if($pause == 'Active'){
            $this->dispatch('toast.success', message: "Offer ".$pause);
        }else {
            $this->dispatch('toast.changed', message: "Offer ".$pause);
        }
    }

    #[On('update-offer-id')]
    public function updateOfferId($offerId) {
        $this->offerId = $offerId;
    }

    #[On('del-offer')]
    public function delOffer(){
        $offer = Item::find($this->offerId);
        $category = $this->category;

        $images = json_decode($offer->images, true);

        // Loop and delete each file from storage
        // if (is_array($images)) {
        //     foreach ($images as $image) {
        //         $path = public_path($offer->images_path . $image);

        //         if (file_exists($path)) {
        //             unlink($path);
        //         }
        //     }

        //     foreach ($images as $image) {
        //         $path = public_path($offer->images_path . 'thumbnails/' . $image);
        //         if (file_exists($path)) {
        //             unlink($path);
        //         }
        //     }
        // }

        $offer->delete();

        $this->offers = Item::where('seller_id', auth()->id())->with('categoryGame.attributes', 'categoryGame.game')->whereHas('categoryGame', function ($query) use  ($category){
            return $query->where('category_id', $category->id);
        })->orderBy('created_at', 'desc')->get();

        $this->games = Game::whereHas('categoryGames', function($query) use ($category) {
            $query->where('category_id', $category->id);
        })->get();

        $this->dispatch('toast.success', message: "Offer deleted successfully!");
        $this->dispatch('componentUpdate');
    }

    #[On('update-offer-price')]
    public function updateOfferPrice($price, $offerId){
        $offer = Item::find($offerId);

        if($price != $offer->price){
            $offer->update([
                'price' => $price,
            ]);

        }

        $this->dispatch('toast.success', message: "Price updated successfully!");
    }

    #[On('game-filter')]
    public function gameFilter($gameId, $pause, $search) {
        $category = $this->category;

        $offers = Item::where('seller_id', auth()->id())->with('categoryGame.attributes', 'categoryGame.game')->whereHas('categoryGame', function ($query) use  ($category, $gameId){
            return $query->where('category_id', $category->id);
        })->orderBy('created_at', 'desc');
        
        if($gameId != "") {

            $offers = $offers->whereHas('categoryGame', function ($query) use ($gameId){
                return $query->where('game_id', $gameId);
            });

        }

        if($pause != "") {

            $offers = $offers->where('pause', $pause);

        }

        if($search != "") {
            $offers = $offers->where('title', 'like', '%' . $search . '%');
        }

        $this->offers = $offers->get();

        $this->dispatch('componentUpdate');
    }

    public function render()
    {
        return view('livewire.offer-dashboard-component');
    }
}
