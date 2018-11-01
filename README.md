# 用户收货地址管理


## 使用方法

### 1.Trait模式

```
use RuLong\Area\Traits\UserHasAddress;
 
class User extends Authenticatable
{
    use UserHasAddress;
    public $guarded = [];
}

```

#### // 用户地址列表

```
$user->addresses;
```

#### // 用户默认地址

```
$user->getDefaultAddress;

```

### 2.Facade模式
#### //地址数据

```
$data = [
	'name'      => $name, //收货人姓名
	'mobile'       => $mobile, //收货人电话
	'address'       => $address, //收货人地址
	'province_sn'   => $province_sn, //省份编码
	'city_sn'    => $city_sn, //城市编码
	'area_sn' => $area_sn, //区域编码
];

```

#### // 新增地址

```
Address::store($data);
```

#### // 更新地址

```
Address::update(UserAddress $address, $data);

```

#### // 删除地址

```
Address::destroy($id);

```

#### // 获取区域列表

```
//$psn=0 返回所有省份列表，$psn=省份sn 返回省份所有城市列表，$psn=城市sn 返回城市所有区域列表。
Area::index($psn);
 
```

