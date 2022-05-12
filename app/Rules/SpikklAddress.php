<?php

namespace App\Rules;

use App\Http\Support\SpikklClient;
use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\Rule;

class SpikklAddress implements Rule, DataAwareRule
{
    /** @var SpikklClient */
    protected $spikklClient;

    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->spikklClient = app(SpikklClient::class);
    }

    /**
     * Set the data under validation.
     *
     * @param  array  $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!$this->data['zipcode'] || !$value) {
            return false;
        }

        $lookup = $this->spikklClient->lookup($this->data['zipcode'], $value);

        return $lookup->status === 'ok';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be valid dutch postalcode at spikkl platform.';
    }
}
