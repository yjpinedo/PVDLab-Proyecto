<?php

namespace App\Http\Controllers\Beneficiary;

use App\Article;
use App\Http\Controllers\BaseController;
use App\Loan;

class LoanArticleController extends BaseController
{
    private $id;

    /**
     * Create a controller instance.
     *
     * @param Article $entity
     */
    public function __construct(Article $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.loans.article';

        $this->middleware(function ($request, $next) {
            $this->id = $request->loan;
            $loan = Loan::whereId($this->id)->with('articles')->first();
            if ( !is_null($loan) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.loans'),
                    'subtitle' => __('app.titles.beneficiary.loan.articles'),
                    'tools' => [
                        'create' => false,
                        'reload' => false,
                        'export' => true,
                        'to_return' => true,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['code', 'name', 'brand', 'stock'],
                        'active' => false,
                        'actions' => false,
                    ],
                    'form' => [],
                ]]);
                $request->request->add(['article_id' => $loan->id]);
                $this->model = $loan->articles->sortByDesc('created_at');

                return $next($request);
            }

            return abort(404);
        });
    }
}
