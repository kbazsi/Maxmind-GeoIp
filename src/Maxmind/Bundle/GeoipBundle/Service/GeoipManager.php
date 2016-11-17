<?php

namespace Maxmind\Bundle\GeoipBundle\Service;

use Maxmind\lib\GeoIp;
use Maxmind\lib\GeoIpRegionVars;

class GeoipManager
{
    /**
     * Maxmind Geoip.
     *
     * @var Maxmind\lib\GeoIp
     */
    protected $geoip;

    /**
     * The maxmind file path.
     *
     * @var string
     */
    protected $filePath;

    /**
     * GeoipManager record.
     *
     * @var Maxmind\lib\GeoIpRecord
     */
    protected $record;

    /**
     * The constructor.
     *
     * @param string $filePath
     */
    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Returns the Maxmind Geoip.
     *
     * @return Maxmind\lib\GeoIp
     */
    protected function getGeoip()
    {
        if (!$this->geoip instanceof GeoIp) {
            $this->geoip = new GeoIp($this->filePath);
        }
        
        return $this->geoip;
    }

    /**
     * Returns the ip.
     *
     * @param string $ip
     *
     * @return GeoipManager | false if no record found.
     */
    public function lookup($ip)
    {
        $this->record = $this->getGeoip()->geoip_record_by_addr($ip);

        if ($this->record) {
            return $this;
        }

        return false;
    }

    /**
     * Returns the country code.
     *
     * @param string|null $ip
     *
     * @return string | null if the country code was not found.
     */
    public function getCountryCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->country_code;
        }

        return null;
    }

    /**
     * Returns the country code 3.
     *
     * @param string|null $ip
     *
     * @return string | null if the country code 3 was not found.
     */
    public function getCountryCode3($ip = null)
    {
        if ($ip){
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->country_code3;
        }

        return null;
    }

    /**
     * Returns the country name.
     *
     * @param string|null $ip
     *
     * @return string | null if the country code was not found.
     */
    public function getCountryName($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->country_name;
        }

        return null;
    }

    /**
     * Returns the region code.
     *
     * @param string|null $ip
     *
     * @return string | null if the region code was not found.
     */
    public function getRegionCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
          return $this->record->region;
        }

        return null;
    }
    /**
     * Returns the region.
     *
     * @param string|null $ip
     *
     * @return string | null if the region was not found.
     */
    public function getRegion($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record
            && $this->record->country_code
            && $this->record->region
        ) {
            return GeoIpRegionVars::$GEOIP_REGION_NAME
                [$this->record->country_code]
                [$this->record->region]
            ;
        }

        return null;
    }
    /**
     * Returns the city.
     *
     * @param string|null $ip
     *
     * @return string | null if the city was not found.
     */
    public function getCity($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->city;
        }

        return null;
    }
    /**
     * Returns the postal code.
     *
     * @param string|null $ip
     *
     * @return string | null if the postal code was not found.
     */
    public function getPostalCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->postal_code;
        }

        return null;
    }
    /**
     * Returns the latitude.
     *
     * @param string|null $ip
     *
     * @return string | null if the latitude was not found.
     */
    public function getLatitude($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->latitude;
        }

        return null;
    }
    /**
     * Returns the longitude.
     *
     * @param string|null $ip
     *
     * @return string | null if the longitude was not found.
     */
    public function getLongitude($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->longitude;
        }

        return null;
    }
    /**
     * Returns the area code.
     *
     * @param string|null $ip
     *
     * @return string | null if the area code was not found.
     */
    public function getAreaCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->area_code;
        }

        return null;
    }
    /**
     * Returns the metro code.
     *
     * @param string|null $ip
     *
     * @return string | null if the metro code was not found.
     */
    public function getMetroCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->metro_code;
        }

        return null;
    }
    /**
     * Returns the continent code.
     *
     * @param string|null $ip
     *
     * @return string | null if the continent code was not found.
     */
    public function getContinentCode($ip = null)
    {
        if ($ip) {
            $this->lookup($ip);
        }

        if (null !== $this->record) {
            return $this->record->continent_code;
        }

        return null;
    }
}
