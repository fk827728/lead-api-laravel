<?php
/**
 * LeadResource.php
 * php version 8.2.3
 *
 * @category Resources
 * @package  Resources
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * LeadResource Class
 * php version 8.2.3
 *
 * @category Resources
 * @package  Resources
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request Request
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "phone" => $this->phone,
            "electric_bill" => $this-> electric_bill,
            "address" => [
                "street" => $this->address->street,
                "city" => $this->address->city,
                "state_abbreviation" => $this->address->state_abbreviation,
                "zip_code" => $this->address->zip_code,
            ],
        ];
    }
}
