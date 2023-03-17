<?php
/**
 * LeadRepository.php
 * php version 8.2.3
 *
 * @category Repositories
 * @package  Repositories
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */

declare(strict_types=1);

namespace App\Repositories;

use App\Constants\AddressFields;
use App\Constants\LeadFields;
use App\Exceptions\InvalidRequestException;
use App\Http\Resources\LeadResource;
use App\Http\Resources\LeadResourceCollection;
use App\Models\Address;
use App\Models\Lead;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Constants\Quality;

/**
 * LeadRepository Class
 * php version 8.2.3
 *
 * @category Repositories
 * @package  Repositories
 * @author   Louis Fang <fk827728@gmail.com>
 * @license  GNU General Public License version 1 or later; see LICENSE
 * @link     http://www.google.com
 */
class LeadRepository
{
    const ELECTRIC_BILL_THRESHOLD = 'app.electric_bill_threshold';
    const ID_FIELD = 'id';
    const ELECTRIC_BILL_FIELD = 'electric_bill';
    const ADDRESS_FIELD = 'address';
    const LEAD_ID_FIELD = 'lead_id';

    /**
     * Get Leads
     *
     * @param ?string $quality quality
     *
     * @throws InvalidRequestException
     * @return LeadResourceCollection
     */
    public function getLeads(?string $quality): LeadResourceCollection
    {
        try {
            $electricBillThreshold = config(self::ELECTRIC_BILL_THRESHOLD);
            if ($quality) {
                if (!in_array(
                    $quality,
                    [Quality::Standard->value, Quality::Premium->value]
                )
                ) {
                    throw new InvalidRequestException('quality is invalid.', 422);
                }
                $leads = Lead::with(self::ADDRESS_FIELD)
                    ->whereNotNull(LeadFields::FirstName->value)
                    ->where(
                        self::ELECTRIC_BILL_FIELD,
                        $quality == Quality::Standard->value ? '<=' : '>',
                        $electricBillThreshold
                    )
                    ->get();
            } else {
                $leads = Lead::whereNotNull(LeadFields::FirstName->value)
                    ->get();
            }
        } catch (Exception $e) {
            throw new InvalidRequestException($e->getMessage(), 400);
        }
        return new LeadResourceCollection($leads);
    }

    /**
     * Get Lead
     *
     * @param string $id id
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function getLead(string $id): LeadResource
    {
        try {
            $lead = Lead::with(self::ADDRESS_FIELD)
                ->whereNotNull(LeadFields::FirstName->value)
                ->findOrFail($id);
        } catch (Exception $e) {
            throw new InvalidRequestException($e->getMessage(), 400);
        }

        return new LeadResource($lead);
    }

    /**
     * Create Lead
     *
     * @param array $data data
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function createLead(array $data): LeadResource
    {
        try {
            $newLead = Lead::create($data);
            Address::create(
                array_merge(
                    $data['address'],
                    [self::LEAD_ID_FIELD => $newLead[self::ID_FIELD]]
                )
            );
            $lead = Lead::with(self::ADDRESS_FIELD)
                ->whereNotNull(LeadFields::FirstName->value)
                ->findOrFail($newLead[self::ID_FIELD]);
        } catch (Exception $e) {
            throw new InvalidRequestException($e->getMessage(), 400);
        }

        return new LeadResource($lead);
    }

    /**
     * Update Lead
     *
     * @param array  $data data
     * @param string $id   id
     *
     * @throws InvalidRequestException
     * @return LeadResource
     */
    public function updateLead(array $data, string $id): LeadResource
    {
        try {
            $lead = Lead::whereNotNull(LeadFields::FirstName->value)
                ->findOrfail($id);
            $lead->update($data);
            $lead = Lead::with(self::ADDRESS_FIELD)
                ->whereNotNull(LeadFields::FirstName->value)
                ->findOrfail($id);
        } catch (Exception $e) {
            throw new InvalidRequestException($e->getMessage(), 400);
        }
        return new LeadResource($lead);
    }

    /**
     * Delete Lead
     *
     * @param string $id id
     *
     * @throws InvalidRequestException
     * @return JsonResponse
     */
    public function deleteLead(string $id): JsonResponse
    {
        try {
            $lead = Lead::whereNotNull(LeadFields::FirstName->value)
                ->findOrFail($id);
            $address = Address::where(self::LEAD_ID_FIELD, $id)->first();
            if ($lead && $address) {
                $deletedLead = [];
                foreach (LeadFields::cases() as $field) {
                    $deletedLead[$field->value] = null;
                }
                $lead->update($deletedLead);

                $deletedAddress = [];
                foreach (AddressFields::cases() as $field) {
                    $deletedAddress[$field->value] = null;
                }
                $address->update($deletedAddress);
            }
        } catch (Exception $e) {
            throw new InvalidRequestException($e->getMessage(), 400);
        }

        return response()->json(['success' => true]);
    }
}
