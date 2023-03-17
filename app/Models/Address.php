<?php
/**
 * Address.php
 * php version 8.2.3
 *
 * @category Models
 * @package  Models
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Address Class
 * php version 8.2.3
 *
 * @category Models
 * @package  Models
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class Address extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'street',
        'city',
        'state_abbreviation',
        'zip_code',
        'lead_id',
    ];

    /**
     * Lead
     *
     * @return BelongsTo
     */
    public function lead(): BelongsTo
    {
        return $this->belongsTo(Lead::class);
    }
}
