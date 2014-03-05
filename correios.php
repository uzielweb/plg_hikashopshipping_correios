<?php
/**
 * @package	HikaShop for Joomla!
 * @version	2.3.0
 * @author	hikashop.com
 * @copyright	(C) 2010-2014 HIKARI SOFTWARE. All rights reserved.
 * @license	GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */
defined('_JEXEC') or die('Restricted access');
?><?php
jimport('joomla.log.log');

class plgHikashopshippingCorreios extends hikashopShippingPlugin
{
	var $correios_methods = array(
		array('key' => 1, 'code' => '40010', 'name' => 'Sedex Sem Contrato (40010)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 2, 'code' => '40096', 'name' => 'Sedex Com Contrato (40096)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 3, 'code' => '81019', 'name' => 'E-Sedex Com Contrato (81019)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 4, 'code' => '41106', 'name' => 'PAC Sem Contrato (41106)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 5, 'code' => '41068', 'name' => 'PAC Com Contrato (41068)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 6, 'code' => '40215', 'name' => 'Sedex 10 (40215)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 7, 'code' => '40290', 'name' => 'Sedex HOJE (40290)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
		array('key' => 8, 'code' => '40045', 'name' => 'Sedex A Cobrar (40045)', 'countries' => 'BRAZIL', 'zones' => array('country_Brazil_30') , 'destinations' => array('country_Brazil_30')),
	);

	var $convertUnit=array(
		'kg' => 'KGS',
		'lb' => 'LBS',
		'cm' => 'CM',
		'in' => 'IN',
		'kg2' => 'kg',
		'lb2' => 'lb',
		'cm2' => 'cm',
		'in2' => 'in',
	);

	var $constraints_box=array(
		'40010' => array('max_weight' => 30, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'40096' => array('max_weight' => 30, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'81019' => array('max_weight' => 15, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'41106' => array('max_weight' => 30, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'41068' => array('max_weight' => 15, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'40215' => array('max_weight' => 10, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'40290' => array('max_weight' => 10, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
		'40045' => array('max_weight' => 30, 'min_length' => 16, 'max_length' => 105, 'min_width' => 11, 'max_width' => 105, 'min_height'=> 2, 'max_height' => 105, 'max_sum' => 200),
	);

	var $constraints_roll=array(
		array('code' => '40010', 'max_weight' => 30, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '40096', 'max_weight' => 30, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '81019', 'max_weight' => 15, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '41106', 'max_weight' => 30, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '41068', 'max_weight' => 15, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '40215', 'max_weight' => 10, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '40290', 'max_weight' => 10, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
		array('code' => '40045', 'max_weight' => 30, 'min_length' => 18, 'max_length' => 105, 'min_width' => 5, 'max_width' => 91, 'max_sum' => 200),
	);

	var $constraints_envelope=array(
		array('code' => '40010', 'max_weight' => 30, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '40096', 'max_weight' => 30, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '81019', 'max_weight' => 15, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '41106', 'max_weight' => 30, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '41068', 'max_weight' => 15, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '40290', 'max_weight' => 10, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
		array('code' => '40045', 'max_weight' => 30, 'min_length' => 16, 'max_length' => 60, 'min_width' => 11, 'max_width' => 60),
	);

	var $multiple = true;
	var $name = 'correios';
	var $doc_form = 'correios';

	public $nbpackage = 0;
	/*public function __construct(){
		$lang = JFactory::getLanguage();
		$extension = 'plg_hikashopshipping_correios';
		$base_dir = JPATH_SITE;
		$language_tag = null;
		$reload = true;
		$lang->load($extension, $base_dir, $language_tag, $reload);
	}*/
	function shippingMethods(&$main){
		$methods = array();
		if(!empty($main->shipping_params->methodsList)){
			$main->shipping_params->methods=unserialize($main->shipping_params->methodsList);
		}
		if(!empty($main->shipping_params->methods)){
			foreach($main->shipping_params->methods as $method){
				$selected = null;
				foreach($this->correios_methods as $correios){
					if($correios['code']==$method) {
						$selected = $correios;
						break;
					}
				}
				if($selected){
					$methods[$main->shipping_id . '-' . $selected['key']] = $selected['name'];
				}
			}
		}
		return $methods;
	}

	function onShippingDisplay(&$order,&$dbrates,&$usable_rates,&$messages){
		$lang = JFactory::getLanguage();
		$extension = 'plg_hikashopshipping_correios';
		$base_dir = JPATH_SITE.'/plugins/hikashopshipping/correios';
		$language_tag = null;
		$reload = true;
		$lang->load($extension, $base_dir, $language_tag, $reload);

		if(!hikashop_loadUser())
			return false;
		$local_usable_rates = array();
		$local_messages = array();
		$ret = parent::onShippingDisplay($order, $dbrates, $local_usable_rates, $local_messages);
		if($ret === false)
			return false;

		$currentShippingZone = null;
		$currentCurrencyId = null;

		$usableWarehouses = array();
		$zoneClass=hikashop_get('class.zone');
		$zones = $zoneClass->getOrderZones($order);
		if(!function_exists('curl_init')){
			$app = JFactory::getApplication();
			$app->enqueueMessage('The CorreiosBR shipping plugin needs the CURL library installed but it seems that it is not available on your server. Please contact your web hosting to set it up.','error');
			return false;
		}
		foreach($local_usable_rates as $k => $rate){
			if(!empty($rate->shipping_params->warehousesList)){
				$rate->shipping_params->warehouses=unserialize($rate->shipping_params->warehousesList);
			}
			else{
				$messages['no_warehouse_configured'] = 'No warehouse configured in the CorreiosBR shipping plugin options';
				continue;
			}
			foreach($rate->shipping_params->warehouses as $warehouse){
				if(empty($warehouse->zone) ||$warehouse->zone=='-' || in_array($warehouse->zone,$zones)){
					$usableWarehouses[]=$warehouse;
				}
			}
			if(empty($usableWarehouses)){
				$messages['no_warehouse_configured'] = 'No available warehouse found for your location';
				continue;
			}
			if(!empty($rate->shipping_params->methodsList)){
				$rate->shipping_params->methods=unserialize($rate->shipping_params->methodsList);
			}
			else{
				$messages['no_shipping_methods_configured'] = 'No shipping methods configured in the CorreiosBR shipping plugin options';
				continue;
			}
			if($order->weight<=0 || ($order->volume<=0 && @$rate->shipping_params->exclude_dimensions !=1)  ){
				continue;
			}

			$this->freight=false;
			$this->classicMethod=false;
			$heavyProduct=false;

			if(!empty($rate->shipping_params->methods)){
				$this->classicMethod=true;
			}
			$data=null;

			if(empty($order->shipping_address)){
				return true;
			}

			$this->shipping_currency_id=$currency= hikashop_getCurrency();
			$db = JFactory::getDBO();
			$query='SELECT currency_code FROM '.hikashop_table('currency').' WHERE currency_id IN ('.$this->shipping_currency_id.')';
			$db->setQuery($query);
			$this->shipping_currency_code = $db->loadResult();
			$cart = hikashop_get('class.cart');
			$null = null;
			$cart->loadAddress($null,$order->shipping_address->address_id,'object', 'shipping');

			$receivedMethods=$this->_getBestMethods($rate, $order, $usableWarehouses, $heavyProduct, $null);

			if(empty($receivedMethods)){
				$messages['no_rates'] = JText::_('NO_SHIPPING_METHOD_FOUND');
				continue;
			}

			$i=0;
			$local_usable_rates = array();
			foreach($receivedMethods as $method){
				$local_usable_rates[$i]=(!HIKASHOP_PHP5) ? $rate : clone($rate);
				$local_usable_rates[$i]->shipping_price+=round($method['value'],2);
				$selected_method = '';
				$name = '';
				foreach($this->correios_methods as $correios_method){
					if($method['old_currency_code']=='CAD'){
						if($correios_method['code']== $method['code']){
							$selected_method = $correios_method['key'];
							$name = $correios_method['name'];
							break;
						}
					}else{
						if($correios_method['code']== $method['code'] && !isset($correios_method['double'])){
							$selected_method = $correios_method['key'];
							$name = $correios_method['name'];
							break;
						}
					}
				}
				$local_usable_rates[$i]->shipping_name = $name;
				if(!empty($selected_method))
					$local_usable_rates[$i]->shipping_id .= '-' . $selected_method;
				if($method['delivery_day']!=-1){
					$local_usable_rates[$i]->shipping_description.=' '.JText::sprintf( 'ESTIMATED_TIME_AFTER_SEND', $method['delivery_day']);
				}
				if($method['homeDelivery']==='S'){
					$local_usable_rates[$i]->shipping_description.='<br/>'.JText::sprintf( 'HOME_DELIVERY', JText::_('WORD_YES'));
				}
				else{
					$local_usable_rates[$i]->shipping_description.='<br/>'.JText::sprintf( 'HOME_DELIVERY', JText::_('WORD_NO'));
				}
				if($method['saturdayDelivery']==='S'){
					$local_usable_rates[$i]->shipping_description.='<br/>'.JText::sprintf( 'SATURDAY_DELIVERY', JText::_('WORD_YES'));
				}
				else{
					$local_usable_rates[$i]->shipping_description.='<br/>'.JText::sprintf( 'SATURDAY_DELIVERY', JText::_('WORD_NO'));
				}
				if($rate->shipping_params->group_package && $this->nbpackage>1) $local_usable_rates[$i]->shipping_description.='<br/>'.JText::sprintf('X_PACKAGES', $this->nbpackage);
				$i++;
			}

			foreach($local_usable_rates as $i => $rate){
				$usable_rates[$rate->shipping_id] = $rate;
			}
		}
	}

	function getShippingDefaultValues(&$element){
		$element->shipping_name='CorreiosBR';
		$element->shipping_description='';
		$element->group_package=0;
		$element->shipping_images='correios';
		$element->shipping_type=$this->correios;
		$element->shipping_params->post_code='';
		$element->shipping_currency_id = $this->main_currency;
		$element->shipping_params->pickup_type='01';
		$element->shipping_params->destination_type='auto';
	}

	function onShippingConfiguration(&$element){
		$config =& hikashop_config();
		$this->main_currency = $config->get('main_currency', 1);
		$currency = hikashop_get('class.currency');
		$this->currencyCode = $currency->get($this->main_currency)->currency_code;
		$this->currencySymbol = $currency->get($this->main_currency)->currency_symbol;

		$jinput = JFactory::getApplication()->input;
		$this->correios = $jinput->getCmd('name','correios');
		$this->categoryType = hikashop_get('type.categorysub');
		$this->categoryType->type = 'tax';
		$this->categoryType->field = 'category_id';

		parent::onShippingConfiguration($element);

		$elements = array($element);
		$key = key($elements);
		if(!empty($elements[$key]->shipping_params->warehousesList)){
			$elements[$key]->shipping_params->warehouse = unserialize($elements[$key]->shipping_params->warehousesList);
		}
		if(!empty($elements[$key]->shipping_params->methodsList)){
			$elements[$key]->shipping_params->methods = unserialize($elements[$key]->shipping_params->methodsList);
		}
		$js = '
function deleteRow(divName,inputName,rowName){
	var d = document.getElementById(divName);
	var olddiv = document.getElementById(inputName);
	if(d && olddiv){
		d.removeChild(olddiv);
		document.getElementById(rowName).style.display=\'none\';
	}
	return false;
}

function deleteZone(zoneName){
	var d = document.getElementById(zoneName);
	if(d){
		d.innerHTML="";
	}
	return false;
}
		';

	 	$js.='
function checkAllBox(id, type){
	var toCheck = document.getElementById(id).getElementsByTagName("input");
	for (i = 0 ; i < toCheck.length ; i++) {
		if (toCheck[i].type == "checkbox") {
			toCheck[i].checked = (type == "check");
		}
	}
}
';
		if(!HIKASHOP_PHP5) {
			$doc =& JFactory::getDocument();
		} else {
			$doc = JFactory::getDocument();
		}
		$doc->addScriptDeclaration( "<!--\n".$js."\n//-->\n" );
	}

	function onShippingConfigurationSave(&$elements){
		parent::onShippingConfiguration($elements);
		$jinput = JFactory::getApplication()->input;
		$warehouses = $jinput->getVar( 'warehouse', array(), '', 'array' );
		$cats = array();
		$methods=array();
		$db = JFactory::getDBO();
		$zone_keys='';
		if(isset($_REQUEST['data']['shipping_methods'])){
			foreach($_REQUEST['data']['shipping_methods'] as $method){
				foreach($this->correios_methods as $correiosMethod){
					$name=strtolower($correiosMethod['name']);
					$name=str_replace(' ','_', $name);
					if($name==$method['name']){
						$methods[strip_tags($method['name'])]=strip_tags($correiosMethod['code']);
					}
				}
			}
		}
		$elements->shipping_params->methodsList = serialize($methods);

		if(!empty($warehouses)){
			foreach($warehouses as $id => $warehouse){
				if(!empty($warehouse['zone']))
					$zone_keys.='zone_namekey='.$db->Quote($warehouse['zone']).' OR ';
			}
			$zone_keys=substr($zone_keys,0,-4);
			if(!empty($zone_keys)){
				$query=' SELECT zone_namekey, zone_id, zone_name_english FROM '.hikashop_table('zone').' WHERE '.$zone_keys;
				$db->setQuery($query);
				$zones = $db->loadObjectList();

			}
			foreach($warehouses as $id => $warehouse){
				$warehouse['zone_name']='';
				if(!empty($zones)){
					foreach($zones as $zone){
						if($zone->zone_namekey==$warehouse['zone'])
							$warehouse['zone_name']=$zone->zone_id.' '.$zone->zone_name_english;
					}
				}
				if(empty($_REQUEST['warehouse'][$id]['zip'])){
					$_REQUEST['warehouse'][$id]['zip']='-';
				}
				if(@$_REQUEST['warehouse'][$id]['zip']!='-'){
					$obj = new stdClass();
					$obj->name = strip_tags($_REQUEST['warehouse'][$id]['name']);
					$obj->zip = strip_tags($_REQUEST['warehouse'][$id]['zip']);
					$obj->city = strip_tags($_REQUEST['warehouse'][$id]['city']);
					$obj->country = strip_tags($_REQUEST['warehouse'][$id]['country']);
					$obj->zone = @strip_tags($_REQUEST['warehouse'][$id]['zone']);
					$obj->zone_name = $warehouse['zone_name'];
					$obj->units = strip_tags($_REQUEST['warehouse'][$id]['units']);
					$obj->currency = strip_tags($_REQUEST['warehouse'][$id]['currency']);
					$cats[]=$obj;
				}
			}
			$elements->shipping_params->warehousesList = serialize($cats);
		}
		if(empty($cats)){
			$obj = new stdClass();
			$obj->name = '-';
			$obj->zip = '-';
			$obj->city = '-';
			$obj->country = '-';
			$obj->zone = '-';
			$void[]=$obj;
			$elements->shipping_params->warehousesList = serialize($void);
		}
		return true;
	}

	function _getBestMethods(&$rate, &$order, &$usableWarehouses, $heavyProduct, $null){
		$db = JFactory::getDBO();
		$zone_code='';

		$this->classicMethod=true;

		$currencies=array();
		foreach($usableWarehouses as $warehouse){
			$zone_code.=$warehouse->country.',';
			$currencies[$warehouse->currency]=(int)$warehouse->currency;
		}
		$zone_code=substr($zone_code,0,-1);

		$query='SELECT zone_id, zone_code_2 FROM '.hikashop_table('zone').' WHERE zone_id IN ('.$zone_code.')';
		$db->setQuery($query);
		$warehouses_namekey = $db->loadObjectList();
		if(!empty($warehouses_namekey)){
			foreach($usableWarehouses as $warehouse){
				foreach($warehouses_namekey as $zone){
					if($zone->zone_id==$warehouse->country){
						$warehouse->country_ID=$zone->zone_code_2;
					}
				}
			}
		}

		$query='SELECT currency_code, currency_id FROM '.hikashop_table('currency').' WHERE currency_id IN ('.implode(',',$currencies).')';
		$db->setQuery($query);
		$warehouses_currency_code = $db->loadObjectList();
		if(!empty($warehouses_currency_code)){
			foreach($usableWarehouses as $k => $warehouse){
				foreach($warehouses_currency_code as $currency_code){
					if($warehouse->currency==$currency_code->currency_id){
						$usableWarehouses[$k]->currency_code=$currency_code->currency_code;
					}
				}
			}
		}
		foreach($usableWarehouses as $k => $warehouse){
			$usableWarehouses[$k]->methods=$this->_getShippingMethods($rate, $order, $warehouse, $null);
		}
		if(empty($usableWarehouses)){
			return false;
		}

		foreach($usableWarehouses as $k => $warehouse){
			if(!empty($warehouse->methods)){
				foreach($warehouse->methods as $i => $method){
					if(!in_array($method['code'], $rate->shipping_params->methods)){
						unset($usableWarehouses[$k]->methods[$i]);
					}
				}
			}
		}
		$bestPrice=99999999;
		foreach($usableWarehouses as $id => $warehouse){
			if(!empty($warehouse->methods)){
				foreach($warehouse->methods as $method){
					if($method['value']<$bestPrice){
						$bestPrice=$method['value'];
						$bestWarehouse=$id;
					}
				}
			}
		}
		if(isset($bestWarehouse)){
			return $usableWarehouses[$bestWarehouse]->methods;
		}
		return false;
	}

	function _getShippingMethods(&$rate, &$order, &$warehouse, $null){
		$data['userId']=$rate->shipping_params->user_id;
		$data['accessLicenseNumber']=$rate->shipping_params->access_code;
		$data['password']=$rate->shipping_params->password;
		$data['destCity']=$null->shipping_address->address_city;
		$data['format']=$rate->shipping_params->format;
		$data['ownHands']=$rate->shipping_params->own_hands;
		$data['declaredValue']=$rate->shipping_params->declared_value;
		$data['receipt']=$rate->shipping_params->receipt;
		$data['destZip']=$null->shipping_address->address_post_code;
		$data['destCountry']=$null->shipping_address->address_country->zone_code_2;
		$data['city']=$warehouse->city;
		$data['zip']=$warehouse->zip;
		$data['country']=$warehouse->country_ID;
		$data['units']=$warehouse->units;
		$data['currency']=$warehouse->currency;
		$data['currency_code']=$warehouse->currency_code;
		$data['old_currency']=$warehouse->currency;
		$data['old_currency_code']=$warehouse->currency_code;
		$data['shipperNumber']=$rate->shipping_params->shipper_number;
		$data['XMLpackage']='';
		$data['destType']='';

		foreach($order->products as $product){
			if($product->product_parent_id==0){
				if(isset($product->variants)){
					foreach($product->variants as $variant){
						$data['price']+=$variant->prices[0]->unit_price->price_value_with_tax;
						for($i=0;$i<$variant->cart_product_quantity;$i++){
							$data['XMLpackage'].=$this->_createPackage($data, $variant, $rate, $order, true);
						}
					}
				}
				else{
					if(isset($product->prices[0])){
						if(!isset($product->prices[0]->unit_price->price_value_with_tax))
							$data['price']+=$product->prices[0]->price_value_with_tax;
						else
							$data['price']+=$product->prices[0]->unit_price->price_value_with_tax;
					}
				}

				if (isset($product->product_width) && $product->product_width > 0){
					$data['width'] += $product->product_width;
				}
				else{
					$data['width'] += 11;
				}

				if (isset($product->product_length) && $product->product_length > 0){
					$data['length'] += $product->product_length;
				}
				else{
					$data['length'] += 16;
				}

				if (isset($product->product_height) && $product->product_height > 0){
					$data['height'] += $product->product_height;
				}
				else{
					$data['height'] += 2;
				}

				if (isset($product->product_weight) && $product->product_weight > 0){
					$data['weight'] += $product->product_weight;
				}
				else {
					$data['weight'] += $rate->shipping_params->shipping_min_weight;
				}
			}
		}

		if ($data['weight'] < $rate->shipping_params->shipping_min_weight){
			$data['weight'] = $rate->shipping_params->shipping_min_weight;
		}

		$i = 0;
		foreach ($rate->shipping_params->methods as $key=>$method) {
			$data['methods'] .= $method.",";
			$data['method'][$method] = true;
			$i++;
		}
		$data["methods"] = substr($data['methods'], 0, -1);

		$error = false;
		switch ($rate->shipping_params->format) {
			case 'box_pack':
				foreach($data['method'] as $key => $method) {
					if ($data['length'] < $this->constraints_box[$key]['min_length'] || $data['length'] > $this->constraints_box[$key]['max_length'])
						$error = true;
					if ($data['width'] < $this->constraints_box[$key]['min_width'] || $data['width'] > $this->constraints_box[$key]['max_width'])
						$error = true;
					if ($data['height'] < $this->constraints_box[$key]['min_height'] || $data['height'] > $this->constraints_box[$key]['max_height'])
						$error = true;
					if (($data['width'] + $data['length'] + $data['height']) > $this->constraints_box[$key]['max_sum'])
						$error = true;
				}
			case 'roll_prism':
			case 'envelope':
		}

		$usableMethods=$this->_CorreiosRequestMethods($data);

		if(empty($usableMethods)){
			return false;
		}
		$currencies=array();
		foreach($usableMethods as $method){
			$currencies[$method['currency_code']]='"'.$method['currency_code'].'"';
		}
		$db = JFactory::getDBO();
		$query='SELECT currency_code, currency_id FROM '.hikashop_table('currency').' WHERE currency_code IN ('.implode(',',$currencies).')';
		$db->setQuery($query);
		$currencyList = $db->loadObjectList();
		$currencyList=reset($currencyList);
		foreach($usableMethods as $i => $method){
			$usableMethods[$i]['currency_id']=$currencyList->currency_id;
		}

		$usableMethods=$this->_currencyConversion($usableMethods, $order);
		return $usableMethods;
	}

	function _createPackage(&$data, &$product, &$rate){
		if(empty($data['weight'])){
			$caracs=$this->_convertCharacteristics($product, $data);

			$data['weight_unit']=$caracs['weight_unit'];
			$data['dimension_unit']=$caracs['dimension_unit'];
			$data['weight']=round($caracs['weight'],2);
			$data['height']=round($caracs['height'],2);
			$data['length']=round($caracs['length'],2);
			$data['width']=round($caracs['width'],2);
		}
		$currencyClass=hikashop_get('class.currency');
		$config =& hikashop_config();
		$this->main_currency = $config->get('main_currency',1);

		if(isset($data['price'])){
			$price=$data['price'];
		}
		else{
			$price=$product->prices[0]->unit_price->price_value;
		}

		if($this->shipping_currency_id!=$data['currency']){
			$price=$currencyClass->convertUniquePrice($price, $this->shipping_currency_id,$data['currency']);
		}

		if(!empty($rate->shipping_params->weight_approximation)){
			$data['weight']=$data['weight']+$data['weight']*$rate->shipping_params->weight_approximation/100;
		}

		if($data['weight']<1){
			$data['weight'] =1;
		}

		if(!empty($rate->shipping_params->dim_approximation)){
			$data['height']=$data['height']+$data['height']*$rate->shipping_params->dim_approximation/100;
			$data['length']=$data['length']+$data['length']*$rate->shipping_params->dim_approximation/100;
			$data['width']=$data['width']+$data['width']*$rate->shipping_params->dim_approximation/100;
		}

		$xml = '';

		return $xml;
	}

	function _convertCharacteristics(&$product, $data, $forceUnit=false){
		$weightClass=hikashop_get('helper.weight');
		$volumeClass=hikashop_get('helper.volume');
		if(!isset($product->product_dimension_unit_orig)) $product->product_dimension_unit_orig = $product->product_dimension_unit;
		if(!isset($product->product_weight_unit_orig)) $product->product_weight_unit_orig = $product->product_weight_unit;
		if(!isset($product->product_weight_orig)) $product->product_weight_orig = $product->product_weight;
		if($forceUnit){
			$carac['weight']=$weightClass->convert($product->product_weight_orig, $product->product_weight_unit_orig, 'lb');
			$carac['weight_unit']='LBS';
			$carac['height']=$volumeClass->convert($product->product_height, $product->product_dimension_unit_orig, 'in' , 'dimension');
			$carac['length']=$volumeClass->convert($product->product_length, $product->product_dimension_unit_orig, 'in', 'dimension' );
			$carac['width']=$volumeClass->convert($product->product_width, $product->product_dimension_unit_orig, 'in', 'dimension' );
			$carac['dimension_unit']='IN';
			return $carac;
		}

		if($data['units']=='kg'){
			if($product->product_weight_unit_orig=='kg'){
				$carac['weight']=$product->product_weight_orig;
				$carac['weight_unit']=$this->convertUnit[$product->product_weight_unit_orig];
			}else{
				$carac['weight']=$weightClass->convert($product->product_weight_orig, $product->product_weight_unit_orig, 'kg');
				$carac['weight_unit']='KGS';
			}
			if($product->product_dimension_unit_orig=='cm'){
				$carac['height']=$product->product_height;
				$carac['length']=$product->product_length;
				$carac['width']=$product->product_width;
				$carac['dimension_unit']=$this->convertUnit[$product->product_dimension_unit_orig];
			}else{
				$carac['height']=$volumeClass->convert($product->product_height, $product->product_dimension_unit_orig, 'cm' , 'dimension');
				$carac['length']=$volumeClass->convert($product->product_length, $product->product_dimension_unit_orig, 'cm', 'dimension' );
				$carac['width']=$volumeClass->convert($product->product_width, $product->product_dimension_unit_orig, 'cm', 'dimension' );
				$carac['dimension_unit']='CM';
			}
		}else{
			if($product->product_weight_unit_orig=='lb'){
				$carac['weight']=$product->product_weight_orig;
				$carac['weight_unit']=$this->convertUnit[$product->product_weight_unit_orig];
			}else{
				$carac['weight']=$weightClass->convert($product->product_weight_orig, $product->product_weight_unit_orig, 'lb');
				$carac['weight_unit']='LBS';
			}
			if($product->product_dimension_unit_orig=='in'){
				$carac['height']=$product->product_height;
				$carac['length']=$product->product_length;
				$carac['width']=$product->product_width;
				$carac['dimension_unit']=$this->convertUnit[$product->product_dimension_unit_orig];
			}else{
				$carac['height']=$volumeClass->convert($product->product_height, $product->product_dimension_unit_orig, 'in' , 'dimension');
				$carac['length']=$volumeClass->convert($product->product_length, $product->product_dimension_unit_orig, 'in', 'dimension' );
				$carac['width']=$volumeClass->convert($product->product_width, $product->product_dimension_unit_orig, 'in', 'dimension' );
				$carac['dimension_unit']='IN';
			}
		}
		return $carac;
	}

	function _CorreiosRequestMethods($data){

		/*$xml='
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <CalcPrecoPrazo xmlns="http://tempuri.org/">
	  <nCdEmpresa>'.$data['accessLicenseNumber'].'</nCdEmpresa>
	  <sDsSenha>'.str_replace('&','&amp;',$data['password']).'</sDsSenha>
	  <nCdServico>'.$data['methods'].'</nCdServico>
	  <sCepOrigem>'.$data['zip'].'</sCepOrigem>
	  <sCepDestino>'.$data['destZip'].'</sCepDestino>
	  <nVlPeso>'.$data['weight'].'</nVlPeso>
	  <nCdFormato>'.$data['format'].'</nCdFormato>
	  <nVlComprimento>'.$data['length'].'</nVlComprimento>
	  <nVlAltura>'.$data['height'].'</nVlAltura>
	  <nVlLargura>'.$data['width'].'</nVlLargura>
	  <nVlDiametro>0,00</nVlDiametro>
	  <sCdMaoPropria>'.$data['ownHands'].'</sCdMaoPropria>
	  <nVlValorDeclarado>'.$data['declaredValue'].'</nVlValorDeclarado>
	  <sCdAvisoRecebimento>'.$data['receipt'].'</sCdAvisoRecebimento>
	</CalcPrecoPrazo>
  </soap:Body>
</soap:Envelope>';*/

		$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?';
		$url .= 'nCdEmpresa='.$data['accessLicenseNumber'];
		$url .= '&sDsSenha='.$data['password'];
		$url .= '&nCdServico='.$data['methods'];
		$url .= '&sCepOrigem='.$data['zip'];
		$url .= '&sCepDestino='.$data['destZip'];
		$url .= '&nVlPeso='.$data['weight'];
		$url .= '&nCdFormato=';
		if ($data['format']=="box_pack")
			$url .= '1';
		else if ($data['format']=="roll_prism")
			$url .= '2';
		else
			$url .= '3';
		$url .= '&nVlComprimento='.$data['length'];
		$url .= '&nVlAltura='.$data['height'];
		$url .= '&nVlLargura='.$data['width'];
		$url .= '&nVlDiametro=0';
		$url .= '&sCdMaoPropria=';
		if ($data['ownHands'])
			$url .= 'S';
		else
			$url .= 'N';
		$url .= '&nVlValorDeclarado=';
		if ($data['declaredValue'])
			$url .= $data['price'];
		else
			$url .= '0';
		$url .= '&sCdAvisoRecebimento=';
		if ($data['receipt'])
			$url .='S';
		else
			$url .= 'N';
		$url .= '&StrRetorno=xml&nIndicaCalculo=3';

		$session = curl_init();
		curl_setopt($session, CURLOPT_URL, $url);
		curl_setopt($session, CURLOPT_FAILONERROR, 1);
		curl_setopt($session, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($session, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($session,CURLOPT_TIMEOUT, 30);

		$result=curl_exec($session);

		if(!empty($result)){
			$xml = strstr($result, '<?');

			$results = new SimpleXMLElement($xml);

			$i=0;
			$shipment= array();
			$app = JFactory::getApplication();
			foreach ($results->cServico as $service)
			{
				$shipment[$i]['code'] = (string) $service->Codigo;
				$shipment[$i]['value'] = (float) $service->Valor;
				$shipment[$i]['delivery_day'] = (int) $service->PrazoEntrega;
				$shipment[$i]['delivery_time'] = -1;
				$shipment[$i]['valueOwnHands'] = (float) $service->ValorMaoPropria;
				$shipment[$i]['valueDeclaredValue'] = (float) $service->ValorValorDeclarado;
				$shipment[$i]['valueReceipt'] = (float) $service->ValorAvisoRecebimento;
				$shipment[$i]['homeDelivery'] = (string) $service->EntregaDomiciliar;
				$shipment[$i]['saturdayDelivery'] = (string) $service->EntregaSabado;
				$shipment[$i]['err_code'] = (string) $service->Erro;
				$shipment[$i]['err_message'] = (string) $service->MsgErro;
				$shipment[$i]['currency_code'] = $data['currency_code'];

				switch ($shipment[$i]['err_code']){
					case '-3':
						$app->enqueueMessage(JText::_('INVALID_DESTINATION_ZIP_CODE'), 'error');
						break;
					case '-4':
						$app->enqueueMessage(JText::_('ITEMS_WEIGHT_TOO_BIG_FOR_SHIPPING_METHODS'), 'error');
						break;
					case '-10':
						$app->enqueueMessage(JText::_('PRICING_UNAVAILABLE_FOR_THIS_PATH'), 'error');
						break;
					case '-15':
					case '-28':
						$app->enqueueMessage(JText::_('LENGTH_CANNOT_EXCEED_105CM'), 'error');
						break;
					case '-16':
						$app->enqueueMessage(JText::_('WIDTH_CANNOT_EXCEED_105CM'), 'error');
						break;
					case '-17':
						$app->enqueueMessage(JText::_('HEIGHT_CANNOT_EXCEED_105CM'), 'error');
						break;
					case '-18':
						$app->enqueueMessage(JText::_('HEIGHT_CANNOT_BE_LESS_THAN_2CM'), 'error');
						break;
					case '-20':
					case '-44':
						$app->enqueueMessage(JText::_('WIDTH_CANNOT_BE_LESS_THAN_11CM'), 'error');
						break;
					case '-22':
					case '-42':
						$app->enqueueMessage(JText::_('LENGTH_CANNOT_BE_LESS_THAN_16CM'), 'error');
						break;
					case '-23':
						$app->enqueueMessage(JText::_('SUM_LENGTH_WIDTH_HEIGHT_CANNOT_EXCEED_200CM'), 'error');
						break;
					case '-30':
						$app->enqueueMessage(JText::_('LENGTH_CANNOT_BE_LESS_THAN_18CM'), 'error');
						break;
					case '-41':
						$app->enqueueMessage(JText::_('LENGTH_CANNOT_EXCEED_60CM'), 'error');
						break;
					case '-43':
						$app->enqueueMessage(JText::_('SUM_LENGTH_WIDTH_CANNOT_EXCEED_120CM'), 'error');
						break;
					case '-45':
						$app->enqueueMessage(JText::_('WIDTH_CANNOT_EXCEED_60CM'), 'error');
						break;
					case '008':
						$app->enqueueMessage(JText::_('SERVICE_UNAVAILABLE_FOR_THIS_PATH'), 'error');
						break;
					case '010':
						$app->enqueueMessage(JText::_('DESTINATION_ZIP_CODE_RISK_AREA'), 'error');
						break;
				}
				$i++;
			}
		} else {
			$app = JFactory::getApplication();
			$app->enqueueMessage('An error occurred. The connection to the CorreiosBR server could not be established: '.'\n'.curl_error($session).' -> '.curl_errno($session));
		}
		curl_close($session);
		if (isset($shipment))
			return $shipment;
		else
			return false;
	}

	function _currencyConversion(&$usableMethods){
		$currency= $this->shipping_currency_id;
		$currencyClass = hikashop_get('class.currency');
		foreach($usableMethods as $i => $method){
			if($method['currency_id']!=$currency){
				$usableMethods[$i]['value']=$currencyClass->convertUniquePrice($method['value'],$method['currency_id'], $currency);
				$usableMethods[$i]['old_currency_id']=$usableMethods[$i]['currency_id'];
				$usableMethods[$i]['old_currency_code']=$usableMethods[$i]['currency_code'];
				$usableMethods[$i]['currency_id']=$currency;
				$usableMethods[$i]['currency_code']=$this->shipping_currency_code;
			}
		}
		return $usableMethods;
	}


}
