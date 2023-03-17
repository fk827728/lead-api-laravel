<?php
/**
 * AddressFields.php
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
 * AddressFields Enum
 * php version 8.2.3
 *
 * @category Constants
 * @package  Constants
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
enum AddressFields: string
{
    case Street = 'street';
    case City = 'city';
    case StateAbbreviation = 'state_abbreviation';
    case ZipCode = 'zip_code';
}
