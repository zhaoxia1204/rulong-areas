<?php

namespace RuLong\Area;

use GuzzleHttp\Client;

/**
 * 腾讯位置服务
 */
class TencentIbs
{
    protected $baseURL = 'https://apis.map.qq.com/ws/';
    protected $key = 'M2CBZ-LRN3X-CKU4Q-7TN6N-AJZQT-BVFAT';
    protected $params = [];

    /**
     * 地址解析(地址转坐标)
     * @param [type] $address [description]
     * @return array [经纬度坐标]
     */
    public function getLocation($address)
    {
        $apiUrl = $this->baseURL . 'geocoder/v1/';
        $data['address'] = $address;
        $this->setParams($data);
        $result = $this->dopost($apiUrl);
        if (is_object($result)) {
            $location = [
                'lng' => $result->location->lng,
                'lat' => $result->location->lat,
            ];
            return $location;
        } else {
            return $result;
        }
    }

    /**
     * 地址解析(地址转坐标)
     * @param [type] $keywords [description]
     * @return array [地址解析内容]
     */
    public function getAddressCode($keywords)
    {
        $apiUrl = $this->baseURL . 'geocoder/v1/';
        $data['address'] = $keywords;
        $this->setParams($data);
        $result = $this->dopost($apiUrl);
        if (is_object($result)) {
            $address_code = [
                'title' => $result->title,
                'location' => [
                    'lng' => $result->location->lng,
                    'lat' => $result->location->lat,
                ],
                'address' => [
                    'province' => $result->address_components->province,
                    'city' => $result->address_components->city,
                    'district' => $result->address_components->district,
                    'street' => $result->address_components->street,
                    'street_number' => $result->address_components->street_number,
                ],
            ];
            return $address_code;
        } else {
            return $result;
        }
    }

    /**
     * 距离两点计算
     * @param $from_lat, $from_lon, [起点经纬度]
     * @param $to_lat,$to_lon [终点经纬度]
     * @param $radius [可选，默认为地球的半径]
     * @return float [返回两地距离，单位千米]
     */

    public function getDistance($from_lat, $from_lon, $to_lat,$to_lon,$radius = 6378.137)
    {
        $rad = floatval(M_PI / 180.0);

        $from_lat = floatval($from_lat) * $rad;
        $from_lon = floatval($from_lon) * $rad;
        $to_lat = floatval($to_lat) * $rad;
        $to_lon = floatval($to_lon) * $rad;

        $theta = $to_lon - $from_lon;

        $dist = acos(sin($from_lat) * sin($to_lat) +
            cos($from_lat) * cos($to_lat) * cos($theta)
        );

        if ($dist < 0 ) {
            $dist += M_PI;
        }

        return $dist = $dist * $radius;//返回千米
    }


    public function setParams(array $params)
    {
        $this->params = $params;
        $this->params['key'] = $this->key;
    }

    private function dopost($url)
    {
        try {
            $Client = new Client();
            $response = $Client->get($url, ['query' => $this->params]);
            $result = json_decode($response->getBody()->getContents());
            if ($result->status == 0) {
                return $result->result;
            } else {
                return $result->message;
            }
        } catch (\Exception $e) {
            return $e->getmessage();
        }
    }
}
