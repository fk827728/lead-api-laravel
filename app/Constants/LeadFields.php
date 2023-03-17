<?php
/**
 * LeadFields.php
 * php version 8.2.3
 *
 * @category Constants
 * @package  Constants
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

namespace App\Constants;


/**
 * LeadFields Enum
 * php version 8.2.3
 *
 * @category Constants
 * @package  Constants
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
enum LeadFields: string
{
    case FirstName = 'first_name';
    case LastName = 'last_name';
    case Email = 'email';
    case Phone = 'phone';
    case ElectricBill = 'electric_bill';
}
