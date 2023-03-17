<?php
/**
 * InvalidRequestException.php
 * php version 8.2.3
 *
 * @category Exceptions
 * @package  Exceptions
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * InvalidRequestException Class
 *
 * @category Exceptions
 * @package  Exceptions
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class InvalidRequestException extends Exception
{
    /**
     * Construct
     *
     * @param string         $message  message
     * @param int            $code     code
     * @param Throwable|null $previous throwable
     */
    public function __construct(
        string $message = "",
        int $code = 0,
        ?Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }

    /**
     * Render
     *
     * @param Request $request request
     *
     * @return JsonResponse
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(['error_message' => $this->message], $this->code);
    }
}
