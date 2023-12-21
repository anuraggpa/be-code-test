<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(array $attributes): Organisation
    {
        $organisation = new Organisation();

        return $organisation;
    }

    public function listAll($filter = null)
    {
        $query = Organisation::withTrashed()->where('deleted_at', NULL)->get();

        if ($filter === 'subbed') {
            $query->where('subscribed', true);
        } elseif ($filter === 'trail') {
            $query->where('subscribed', false);
        }

        $listOrganisation = $query->get();

        return $listOrganisation;
    }
}
