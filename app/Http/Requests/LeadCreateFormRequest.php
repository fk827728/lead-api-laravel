<?php
/**
 * LeadCreateFormRequest.php
 * php version 8.2.3
 *
 * @category Requests
 * @package  Requests
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Http\Requests;

use App\Exceptions\InvalidRequestException;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

/**
 * LeadCreateFormRequest Class
 * php version 8.2.3
 *
 * @category Requests
 * @package  Requests
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class LeadCreateFormRequest extends FormRequest
{
    const UNPROCESSABLE_CONTENT_STATUS_CODE = 422;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'electric_bill' => 'required|integer',
            'address.street' => 'required|string|max:255',
            'address.city' => 'required|string|max:255',
            'address.state_abbreviation' => 'required|string|size:2',
            'address.zip_code' => 'required|string|size:5',
        ];
    }

    /**
     * Failed Validation
     *
     * @param Validator $validator Validator
     *
     * @throws InvalidRequestException
     * @return void
     */
    public function failedValidation(Validator $validator): void
    {
        throw new InvalidRequestException(
            $validator->errors()->first(),
            self::UNPROCESSABLE_CONTENT_STATUS_CODE
        );
    }
}
