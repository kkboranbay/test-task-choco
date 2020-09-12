<?php

class PromotionController
{
    public function index()
    {
        $promotions = PromotionModel::getAll();

        if (Request::wantsJson()) {
            return Response::json($promotions);
        }

        return view('index', [
            'promotions' => $promotions,
        ]);
    }

    public function show($id)
    {
        $promotion = PromotionModel::getById($id);

        if (Request::wantsJson()) {
            return Response::json($promotion);
        }

        return view('show', [
            'promotion' => $promotion,
        ]);
    }

    public function update($id)
    {
        if (PromotionModel::update($id)) {
            if (Request::wantsJson()) {
                return Response::json('Updated');
            }

            redirect('.');
        }
    }
}