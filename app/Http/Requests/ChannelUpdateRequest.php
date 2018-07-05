<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ChannelUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $channel_id = Auth::user()->channel()->first()->id;

        return [
            'name' => 'required|max:255|unique:channels,name,' . $channel_id,
            'slug' => 'required|max:255|alpha_num|unique:channels,slug,' . $channel_id,
            'visibility' => 'required|in:public,private',
            'description' => 'max:1000'
        ];
    }
}
