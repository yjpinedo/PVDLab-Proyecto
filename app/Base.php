<?php

namespace App;

use App\Traits\Uppercase;
use Illuminate\Database\Eloquent\Model;
use Spatie\Menu\Helpers\Str;

/**
 * @property string name
 * @property mixed layout
 */
class Base extends Model
{
    use Uppercase;

    /**
     * The mutated attributes that should be added for arrays.
     *
     * @var array
     */
    protected $appends = [
        'full_name', 'select_value'
    ];

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['data'];

    // Methods

    /**
     * Get the data to build the layout.
     *
     * @return array
     */
    public function getLayout(): array
    {
        return $this->layout;
    }

    /**
     * Set baseQuery variable
     *
     * @param string $field
     * @return array
     */
    public function select($field = 'select_value')
    {
        return $this->get()->sortBy($field)->pluck($field, 'id');
    }

    // Mutator

    /**
     * Mutator for the full name
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return $this->name;
    }

    /**
     * Mutator for the value to show in the select
     *
     * @return string
     */
    public function getSelectValueAttribute()
    {
        return $this->name;
    }
}
