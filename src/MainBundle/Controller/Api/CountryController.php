<?php

namespace MainBundle\Controller\Api;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as FosRest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @FosRest\NamePrefix("api_countries_")
 */
class CountryController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function getAction()
    {
        $countries = $this
            ->get('main.country.service')
            ->getCountries();

        $serializer = $this->get('serializer');

        return $serializer->serialize(
            $countries,
            'json',
            SerializationContext::create()->setGroups(array('list'))
        );
    }

    /**
     * @Security("has_role('ROLE_USER')")
     */
    public function detailsAction()
    {
        $countries = $this
            ->get('main.country.service')
            ->getCountries();

        $serializer = $this->get('serializer');

        return $serializer->serialize(
            $countries,
            'json',
            SerializationContext::create()->setGroups(array('Default', 'details'))
        );
    }
}
