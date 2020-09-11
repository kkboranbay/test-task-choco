<?php

class PromotionController
{
    public function index()
    {
        $promotions = App::get('database')->selectAll('promotions');

        if (Request::wantsJson()) {
            return Response::json($promotions);
        }

        return view('index', [
            'promotions' => $promotions,
        ]);
    }

    public function show($id)
    {
        $promotion = App::get('database')->selectOne('promotions', $id);

        if (Request::wantsJson()) {
            return Response::json($promotion);
        }

        return view('show', [
            'promotion' => $promotion,
        ]);
    }

    public function update($id)
    {
        $promotion = App::get('database')->selectOne('promotions', $id);

        if ($promotion->status == 1) {
            $params = ['status' => 0];
        } else {
            $params = ['status' => 1];
        }

        if (App::get('database')->update('promotions', $id, $params)) {
            if (Request::wantsJson()) {
                return Response::json('Updated');
            }

            redirect('.');
        }
    }
}