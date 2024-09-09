<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Store;

class ReviewController extends Controller
{
    // 口コミ投稿
    public function store(Request $request, $storeId)
    {
        $request->validate([
            'comment' => 'required|string|max:400',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'required|image|mimes:jpeg,png|max:2048',
        ]);

        // 口コミ有無確認
        $existingReview = Review::where('user_id', auth()->id())->where('store_id', $storeId)->first();
        if ($existingReview) {
            return redirect()->back()->withErrors(['review' => 'この店舗には既に口コミを投稿済みです。']);
        }

            $image = $request->file('image');
            $imagePath = $image->store('images/reviews', 'public');

        Review::create([
            'user_id' => auth()->id(),
            'store_id' => $storeId,
            'comment' => $request->comment,
            'rating' => $request->rating,
            'image_path' => $imagePath,
        ]);

        return redirect()->back()->with('success', '口コミを投稿しました。');
    }

    // 口コミ編集
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        if ($review->user_id !== auth()->id()) {
            abort(403, 'この口コミを編集する権限がありません。');
        }

        return view('store_reviews.store_edit', compact('review'));
    }
    
    // 口コミ更新
    public function update(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string|max:400',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|mimes:jpeg,png|max:2048',
        ]);

        $review = Review::findOrFail($id);

        if ($review->user_id !== auth()->id()) {
            abort(403, 'この口コミを編集する権限がありません。');
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images/reviews', 'public');
            $review->image_path = $imagePath;
        }

        $review->update([
            'comment' => $request->comment,
            'rating' => $request->rating,
        ]);

        return redirect()->route('review_list', $review->store_id)->with('success', '口コミを更新しました。');
    }

    
    // 口コミ削除
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        if (auth()->user()->is_admin || $review->user_id === auth()->id()) {
            $review->delete();
            return redirect()->back()->with('success', '口コミを削除しました。');
        } else {
            abort(403);
        }
    }

    // 口コミ一覧表示
    public function review_index($id)
    {
        $store = Store::findOrFail($id);
        $reviews = $store->reviews; // 口コミを取得する
        return view('store_reviews.review_list', compact('store', 'reviews'));
    }

    // 現在のユーザーが指定した店舗に対してレビューを投稿しているか確認
        public function hasReviewed($storeId)
    {
        return Review::where('store_id', $storeId)
            ->where('user_id', auth()->id())
            ->exists();
    }

    // 口コミ一覧ページを表示するメソッドを追加
    public function reviewPage($storeId)
    {
        $store = Store::findOrFail($storeId);
        $reviews = Review::where('store_id', $storeId)->latest()->get();

        return view('store_reviews.store_review', [
            'store' => $store,
            'reviews' => $reviews,
        ]);
    }

    // 口コミ評価ソート機能
    public function index(Request $request)
    {
        $query = Store::query();

        // エリアとジャンルのフィルタリング
        if ($request->filled('area_id')) {
            $query->where('area_id', $request->area_id);
        }

        if ($request->filled('genre_id')) {
            $query->where('genre_id', $request->genre_id);
        }

        // ソート機能
        if ($request->filled('sort')) {
            switch($request->sort) {
                case 'high_rating':
                    $query->withAvg('review', 'rating')->orderByDesc('reviews_avg_rating');
                    break;
                case 'low_rating';
                    $query->withAvg('review', 'rating')->orderBy('reviews_avg_rating');
                    break;
                case 'random':
                    $query->inRandomOrder();
                    break;
            }
        }

        $stores = $query->get();

        return view('store.index', compact('stores', 'selectedAreaId', 'selectedGenreId', 'keyword' ));
    }
}

