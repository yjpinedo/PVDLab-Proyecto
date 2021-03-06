<?php

namespace App\Http\Controllers;

use App\Article;
use App\Loan;
use App\Mail\LoanStateUpdate;
use App\Movement;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoanController extends BaseController
{
    /**
     * Create a controller instance.
     *
     * @param Loan $entity
     */
    public function __construct(Loan $entity)
    {
        parent::__construct($entity, false);
        $this->model = $this->entity->with('articles', 'beneficiary', 'employee')->orderBy('created_at', 'DESC');
    }

    public function create()
    {
        return view('loans.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'place' => 'required|min:3|max:50',
            'description' => 'min:3|max:500',
            'refund' => 'required|date|after:today',
            'beneficiary_id' => 'required|exists:beneficiaries,id',
        ]);

        $input = $request->except(['article_id_table', 'quantity_table', 'article_id', 'quantity']);
        $input['employee_id'] = auth()->user()->id;
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

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateState(Request $request)
    {
        $loan = $this->entity::whereId($request->input('id'))->with(['articles.warehouses', 'beneficiary'])->first();

        if (is_null($loan)) return abort(404);

        if ($loan->state !== 'RECHAZADO') {
            if (is_null($loan->employee)) {
                $loan->employee_id = auth()->user()->id;
            }

            if ($loan->employee->id != auth()->user()->id) {
                $loan->employee_id = auth()->user()->id;
            }

            if ($request->input('state') === 'RECHAZADO') {
                $message = 'RECHAZADO';
                $error = true;
            }

            if ($request->input('state') === 'APROBADO') {
                $message = 'APROBADO';
                $error = false;
                foreach ($loan->articles as $article) {
                    $quantity = $article->pivot->quantity;
                    foreach ($article->warehouses as $key => $warehouses) {
                        $quantityStock = $quantity - $warehouses->pivot->stock;
                        if ($quantityStock <= 0) {
                            $quantityStock = ($quantityStock * (-1));
                            $warehouses->articles()->updateExistingPivot($article->id, ['stock' => $quantityStock]);
                            Movement::create([
                                'type' => 'SALIDA',
                                'stock' => $quantity,
                                'origin_id' => $warehouses->id,
                            ]);
                            break;
                        } else {
                            $warehouses->articles()->updateExistingPivot($article->id, ['stock' => '0']);
                            Movement::create([
                                'type' => 'SALIDA',
                                'stock' => $quantity,
                                'origin_id' => $warehouses->id,
                            ]);
                            $quantity = $quantityStock;
                        }
                    }
                }
            }

            $loan->state = $request->input('state');
            $loan->save();

            $body = [
                'loan' => $loan,
                'url' => $request->root() . "/beneficiary/loans",
            ];

            Mail::to($loan->beneficiary->email)->send(new LoanStateUpdate($body));

            return response()->json([
                'data' => $loan,
                'message' => __("app.messages.loan.$message"),
                'error' => $error
            ]);
        } else {
            return response()->json([
                'error' => true,
                'message' => __('app.messages.loan.update'),
            ]);
        }
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
