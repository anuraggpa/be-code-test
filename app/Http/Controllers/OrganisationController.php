<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\OrganisationService;
use App\Http\Requests\ApiValidateOrganisationRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailAlert;
use Carbon\Carbon;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    protected $organisationService;

    public function __construct(OrganisationService $organisationService)
    {
        $this->organisationService = $organisationService;
    }
    /**
     * @param OrganisationService             $service
     * @param ApiValidateOrganisationRequest $request
     *
     * @return JsonResponse
     */
    public function store(OrganisationService $service, ApiValidateOrganisationRequest $request): JsonResponse
    {
        // Validate the request
        $validatedData = $request->validated();

        // Trail end calcualtion: todays date + 30 days
        /** @var Organisation $organisation */
        $organisation = $this->organisationService->createOrganisation(
            array_merge($validatedData, ['trial_end' => Carbon::now()->addDays(30)])
        );
 
        // fetch the current login user object for fetching the email address for sending alert
        $user = auth()->user();

        if($organisation->id){
         Mail::to($user->email)->send(new SendEmailAlert($organisation, $user));
        }

        $userTransformer = new UserTransformer();
        $user = $userTransformer->transform($user);
 
        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }

    public function listAll(OrganisationService $service)
    {
        $filter = $_GET['filter'];
        if(isset($filter))
        {
            $listOrganisation = $this->organisationService->listAll($filter);
        }
        return $this
            ->transformCollection('organisation', $listOrganisation, ['user'])
            ->respond();
    }
}
