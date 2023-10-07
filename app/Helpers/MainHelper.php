<?php

use Illuminate\Support\Facades\Storage;

if (!function_exists('getFile')) {
    function getFile($url = null)
    {
        if (!empty($url)) {
            if (filter_var($url, FILTER_VALIDATE_URL)) {
                return $url;
            }
            if (Storage::disk('public')->exists($url)) {

                return asset('storage/' . $url);
            } else {
                return asset('default.png');
            }
        }
        return asset('default.png');

    }
}

if (!function_exists('pagination_url')) {
    function pagination_urls($model)
    {
        if (is_object($model)) {
            $paginate_data ['current_page'] = $model->currentPage();
            $paginate_data ['first_page_url'] = $model->firstItem();
            // $paginate_data ['from'] = $model->from();
            $paginate_data ['last_page'] = $model->lastPage();
            $paginate_data ['last_page_url'] = $model->lastPage();
            $paginate_data ['next_page_url'] = $model->nextPageUrl();
            $paginate_data ['path'] = $model->path();
            $paginate_data ['per_page'] = $model->perPage();
            $paginate_data ['prev_page_url'] = $model->previousPageUrl();
            // $paginate_data ['to'] = $model->to();
            $paginate_data ['total'] = $model->total();
            // $paginate_data ['items'] = $model->items(); /* data */
            $paginate_data ['isEmpty'] = $model->isEmpty();
            $paginate_data ['isNotEmpty'] = $model->isNotEmpty();
            $paginate_data ['hasMorePages'] = $model->hasMorePages();
            $paginate_data ['hasPages'] = $model->hasPages();
            return $paginate_data;
        }
        return [];
    }
}
