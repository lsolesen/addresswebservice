<?php
/**
 * Communicates with the Address Web Service provided by the
 * Danish state.
 *
 * API is in alpha - so don't rely on it
 *
 * PHP4 and PHP5
 *
 * Usage:
 * $aws = new Services_AddressWebService;
 * print_r($aws->query('Kirketorvet', 2, 'Tranbjerg J'));
 *
 * @package Services_AddressWebService
 * @author  Lars Olesen <lars@legestue.net>
 * @since   0.1.0
 * @version @package-version@
 * @license Share-Alike
 * @link    http://aws.oio.dk/
 */

require_once 'nusoap/nusoap.php';

class Services_AddressWebService {

    var $options = array(
        'trace' => 1,
        'exceptions' => 1
    );

    var $client;

    function Services_AddressWebService($url = 'http://rep.oio.dk/altforintet_dk/findaddressservice.wsdl') {
        $this->client = new SoapClient(
            $url,
            $this->options
        );
    }

    /**
     * @param string  $address
     * @param integer $number
     * @param string  $district
     */

    function query($address, $number, $district) {
        $district = array(
            'DistrictName' => $district,
            'InluceNeighbour' => true
        );
        $params = array(
            array(
                'NamedStreetTextInput' => $address,
                'StreetBuildingIdentifier' => $number,
                'DistrictSearch' => $district
            )
        );

        $result = $this->client->call('FindAddressAccess', $params);

        return $result;
    }

}

$aws = new Services_AddressWebService;
print_r($aws->query('Kirketorvet', 2, 'Tranbjerg J'));

?>