<?php
/**
 * LeadController.php
 * php version 8.2.3
 *
 * @category Api
 * @package  Api
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\InvalidRequestException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LeadCreateFormRequest;
use App\Http\Requests\LeadUpdateFormRequest;
use App\Http\Resources\LeadResource;
use App\Http\Resources\LeadResourceCollection;
use App\Repositories\LeadRepository;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * LeadController Class
 * php version 8.2.3
 *
 * @category Api
 * @package  Api
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class LeadController extends Controller
{
    /**
     * LeadRepository
     *
     * @var LeadRepository
     */
    protected LeadRepository $leadRepository;

    /**
     * Construct
     *
     * @param LeadRepository $leadRepository LeadRepository
     */
    public function __construct(LeadRepository $leadRepository)
    {
        $this->leadRepository = $leadRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request Request
     *
     * @throws InvalidRequestException
     * @return LeadResourceCollection
     */
    public function index(Request $request): LeadResourceCollection
    {
        return $this->leadRepository->getLeads($request->query('quality'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LeadCreateFormRequest $request LeadCreateFormRequest
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function store(LeadCreateFormRequest $request): LeadResource
    {
        return $this->leadRepository->createLead($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param string $id id
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function show(string $id): LeadResource
    {
        return $this->leadRepository->getLead($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param LeadUpdateFormRequest $request LeadUpdateFormRequest
     * @param string                $id      id
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function update(LeadUpdateFormRequest $request, string $id): LeadResource
    {
        return $this->leadRepository->updateLead($request->validated(), $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id id
     *
     * @throws InvalidRequestException
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        return $this->leadRepository->deleteLead($id);
    }
}
