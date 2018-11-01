<?php

namespace RuLong\Area;

use Illuminate\Support\Facades\DB;
use RuLong\Area\Exceptions\AddressException;
use RuLong\Area\Models\UserAddress;
use Validator;

// 地址管理
class Address
{

    public function store($data)
    {
        $validator = Validator::make($data, [
            'name'        => 'required',
            'mobile'      => 'required',
            'province_sn' => 'required',
            'city_sn'     => 'required',
            'area_sn'     => 'required',
            'address'     => 'required',
        ], [
            'name.required'        => '收货人必须填写',
            'mobile.required'      => '手机号必须填写',
            'province_sn.required' => '省份必须选择',
            'city_sn.required'     => '城市必须选择',
            'area_sn.required'     => '区域必须选择',
            'address.required'     => '收货地址必须填写',
        ]);
        if ($validator->fails()) {
            throw new AddressException($validator->errors()->first());
        }
        return UserAddress::create($data);
    }

    public function update(UserAddress $address, $data)
    {
        $validator = Validator::make($data, [
            'name'        => 'required',
            'mobile'      => 'required',
            'province_sn' => 'required',
            'city_sn'     => 'required',
            'area_sn'     => 'required',
            'address'     => 'required',
        ], [
            'name.required'        => '收货人必须填写',
            'mobile.required'      => '手机号必须填写',
            'province_sn.required' => '省份必须选择',
            'city_sn.required'     => '城市必须选择',
            'area_sn.required'     => '区域必须选择',
            'address.required'     => '收货地址必须填写',
        ]);
        if ($validator->fails()) {
            throw new AddressException($validator->errors()->first());
        }
        return $address->update($data);
    }

    public function destroy($id)
    {
        return UserAddress::where('id', $id)->delete();
    }

    public function setDefault(UserAddress $address)
    {
        try {
            DB::transaction(function () use ($address) {
                $address->def = 1;
                $address->save();
                UserAddress::where('user_id', $address->user_id)->where('id', '<>', $address->id)->update(['def' => 0]);
            });
            return true;
        } catch (\Exception $e) {
            throw new AddressException($e->getMessage());
        }
    }

}
