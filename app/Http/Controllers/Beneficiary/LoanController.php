<?php

namespace App\Http\Controllers\Beneficiary;

use App\Article;
use App\Beneficiary;
use App\Http\Controllers\BaseController;
use App\Loan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoanController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Loan $entity
     */
    public function __construct(Loan $entity)
    {
        parent::__construct($entity);

        $this->crud = 'beneficiary.loans';

        $this->middleware(function ($request, $next) {
            $beneficiary = Beneficiary::whereId(Auth::user()['model_id'])->with('loans.articles', 'loans.employee')->first();

            if ( !is_null($beneficiary) ) {
                $request->request->add(['data' => [
                    'title' => __('app.titles.loans'),
                    'subtitle' => __('app.titles.beneficiary.loan.list_loans'),
                    'tools' => [
                        'create' => true,
                        'reload' => false,
                        'export' => false,
                    ],
                    'table' => [
                        'check' => false,
                        'fields' => ['id', 'name', 'employee_id', 'start', 'state'],
                        'active' => false,
                        'actions' => true,
                    ],
                    'form' => [],
                ]]);

                $request->request->add(['beneficiary_id' => $beneficiary->id]);
                $this->model = $beneficiary->loans->sortByDesc('created_at');
                return $next($request);
            }
            return abort(404);
        });
    }

    public function create()
    {
        return view('beneficiaries.loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'place' => 'required|min:3|max:50',
            'description' => 'min:3|max:500',
            'refund' => 'required|date|after:today',
        ]);

        $input = $request->except(['article_id_table', 'quantity_table', 'article_id', 'quantity']);
        $input['beneficiary_id'] = Auth::user()['model_id'];
        $loan = Loan::create($input);

        foreach ($request->input('article_id_table') as $index => $article_id) {
            $quantity = $request->input('quantity_table')[$index];
            $loan->articles()->attach($article_id, ['quantity' => $quantity]);
        }

        return response()->json([
            'data' => $loan,
            'message' => __('base.messages.store', ['name' => 'Préstamo']),
            'reload' => false,
        ]);
    }

    public function getArticleById(Request $request)
    {
        $sumStock = 0;
        $article = Article::whereId($request->input('article_id'))->with('warehouses')->first();
        foreach ($article->warehouses as $warehouse) {
            $sumStock += $warehouse->pivot->stock;
        }
        if ($sumStock >= intval($request->input('quantity'))) {
            $response = [
                'data' => $article,
                'message' => '',
                'error' => false,
            ];
        } else {
            $response = [
                'error' => true,
                'message' => __('app.messages.loan.validate_quantity', ['quantity' => $sumStock]),
            ];
        }
        return response()->json($response);
    }
}
