<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Loan extends Model
{
    /**
     * @return BelongsToMany
     */
    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_loan')->withPivot('quantity')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    /**
     * @return BelongsTo
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
