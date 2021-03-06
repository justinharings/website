<?php
if($mb->_runFunction("cart", "countCartItems") == 0)
{
	require_once(__DIR__ . "/cart.php");
}
else
{
	?>
	<div class="container-mobile">
		<h1 class="no-margin"><?= $mb->_translateReturn("cart", "your-order") ?></h1>
		<h2 class="margin"><?= $mb->_translateReturn("cart", "your-order-eg") ?></h2>
		
		<form id="book" method="post" action="/library/php/posts/book.php">
			<div class="page-menu hide-mobile">
				<div class="cart follow-scroll">
					<strong><?= $mb->_translateReturn("cart", "shoppingcart") ?></strong><br/>
					<small>
						<?= $mb->_runFunction("cart", "countCartItems") ?>
						<?= $mb->_translateReturn("cart", "articles") ?>
						- <a href="/<?= _LANGUAGE_PACK ?>/system/cart.html"><?= $mb->_translateReturn("cart", "edit") ?><a/><br/>
					</small>
					<br/>
					
					<ul>
						<?php
						foreach($_SESSION['cart'] AS $key => $item)
						{
							$product = $mb->_runFunction("catalog", "loadProduct", array($item['productID']));
							
							$name = $product['name'];
					
							if($product[strtoupper(_LANGUAGE_PACK) . '_name'] != "")
							{
								$name = $product[strtoupper(_LANGUAGE_PACK) . '_name'];
							}
							
							print "<li>" . $name . "</li>";
						}
						?>
					</ul>
				</div>
			</div>
			
			<div class="page-content large-margin no-mobile-padding">
				<input type="hidden" name="merchantID" id="merchantID" value="<?= $mb->_merchant_id() ?>" />
				<input type="hidden" name="locationID" id="locationID" value="0" />
				<input type="hidden" name="paymentID" id="paymentID" value="0" />
				<input type="hidden" name="shipmentID" id="shipmentID" value="0" />
				<input type="hidden" name="_website_language_pack" id="_website_language_pack" value="<?= $_GET['language_pack'] ?>" />
				
				<div class="checkout-form">
					<table>
						<tr>
							<td width="175" class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-name") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-name") ?></strong>
								<input type="text" name="name" id="name" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['name'] : "" ?>" req="text" />
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-company") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile">
									<?= $mb->_translateReturn("cart", "form-company") ?>
									<small><?= $mb->_translateReturn("cart", "form-optional") ?></small>
								</strong>
								<input type="text" name="company" id="company" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['company'] : "" ?>" />
								<small class="hide-mobile"><?= $mb->_translateReturn("cart", "form-optional") ?></small>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-address") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-address") ?></strong>
								<input type="text" name="address" id="address" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['address'] : "" ?>" req="text" />
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-zipcode") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-zipcode") ?></strong>
								<input type="text" name="zipcode" id="zipcode" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['zip_code'] : "" ?>" req="text" class="small" />
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-city") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-city") ?></strong>
								<input type="text" name="city" id="city" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['city'] : "" ?>" req="text" />
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-country") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-country") ?></strong>
								<select name="country" id="country" req="text">
									<option value=""></option>
									<?php
									$_countries = $mb->_allCountries();
									
									foreach($_countries AS $value)
									{
										?>
										<option <?= isset($_SESSION['customer']) && $_SESSION['customer']['country'] == $value ? "selected=\"selected\"" : "" ?> value="<?= $value ?>"><?= $value ?></option>
										<?php
									}
									?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-phone") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile">
									<?= $mb->_translateReturn("cart", "form-phone") ?>
									<small><?= $mb->_translateReturn("cart", "form-optional") ?></small>
								</strong>
								<input type="text" name="phone" id="phone" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['phone'] : "" ?>" />
								<small class="hide-mobile"><?= $mb->_translateReturn("cart", "form-optional") ?></small>
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-mobile") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-mobile") ?></strong>
								<input type="text" name="mobile_phone" id="mobile_phone" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['mobile_phone'] : "" ?>" req="text" />
							</td>
						</tr>
						
						<tr>
							<td class="hide-mobile"><strong><?= $mb->_translateReturn("cart", "form-email") ?></strong></td>
							<td>
								<strong class="placeholder show-mobile"><?= $mb->_translateReturn("cart", "form-email") ?></strong>
								<input type="text" name="email_adres" id="email_adres" value="<?= isset($_SESSION['customer']) ? $_SESSION['customer']['email_address'] : "" ?>" req="email" />
							</td>
						</tr>
					</table>
				</div>
				
				<hr/>
				
				<ul class="checkout-choices" inputname="shipmentID">
					<?php
					if(count($_SESSION['shipment_array']) > 0)
					{
						?>
						<li id="0" class="first">
							<div class="choice">
								<span class="fa <?= !isset($_SESSION['shipment']) || $_SESSION['shipment'] == 0 ? "fa-check active" : "fa-circle" ?>"></span>
							</div>
							
							<div class="data">
								<strong><?= $mb->_translateReturn("cart", "delivery") ?>&nbsp;</strong>
								<small><?= $mb->_translateReturn("cart", "delivery-eg") ?></small><br/>
								<br/>
								
								<?php
								print $mb->_translateReturn("cart", "delivery-text") . "<br/><br/>";
									
								$fees = array();
									
								foreach($_SESSION['shipment_array'] AS $shipment)
								{
									$shipment_data = $mb->_runFunction("cart", "loadShipment", array($shipment));
									
									$name = $shipment_data['name'];
									$price = $shipment_data['price'];
									
									print $_currencies_symbols[$_SESSION['currency']];
									print " <strong>" . _frontend_float($mb->replaceCurrency($price, $_SESSION['currency']), $_SESSION['currency']) . "</strong> - " . $name . "<br/>";
									
									foreach($shipment_data['fees'] AS $fValue)
									{
										$fValue['country'] = str_replace(" ", "_", $fValue['country']);
										
										if(!isset($fees[$fValue['country']]))
										{
											$fees[$fValue['country']] = array();
										}
										
										$fees[$fValue['country']] = floatval($fees[$fValue['country']]) + floatval($fValue['fee']);
									}
									
									$total_ship += $price;
								}
								
								foreach($fees AS $country => $fee)
								{
									print '<input type="hidden" name="fee_' . $country . '" id="fee_' . $country . '" value="' . $_currencies_symbols[$_SESSION['currency']] . " " . _frontend_float($mb->replaceCurrency($fee, $_SESSION['currency']), $_SESSION['currency']) . '" class="fee_' . $country . '" />';
								}
								?>
							</div>
						</li>
				
						<li class="extra-field red export-fee">
							<strong><?= $mb->_translateReturn("cart", "export-fee") ?></strong><br/>
							<?= $mb->_translateReturn("cart", "export-fee-text") ?> <strong><span class="amount"></span></strong>.
						</li>
						<?php
					}

					$shipments = $mb->_runFunction("cart", "shipmentMethods", array());	
					$num = 0;
					
					foreach($shipments AS $shipment)
					{
						if	(
								(
									$shipment['maximum'] > 0 
									&& ($shipment['used'] >= $shipment['maximum'])
								)
								|| $shipment['free_choice'] == 0
							)
						{
							continue;
						}
						
						?>
						<li id="<?= $shipment['shipmentID'] ?>" <?= count($_SESSION['shipment_array']) > 0 || $num > 0 ? '' : 'class="first"' ?>>
							<div class="choice">
								<span class="fa fa-<?= (!isset($_SESSION['shipment']) && count($_SESSION['shipment_array']) == 0 && $num == 0) || (isset($_SESSION['shipment']) && $shipment['shipmentID'] == $_SESSION['shipment']) ? "check active" : "circle" ?>"></span>
							</div>
							
							<div class="data">
								<strong><?= $shipment['name'] ?></strong>
								
								<?php
								if($settings['show_shipment'])
								{
									?>
									- <small><?= $_currencies_symbols[$_SESSION['currency']] . " " . _frontend_float($mb->replaceCurrency($shipment['price'], $_SESSION['currency']), $_SESSION['currency']) ?></small>
									<?php
								}
								?>
							</div>
						</li>
						<?php
							
						$num++;
					}
					?>
				</ul>
				
				<hr/>
				
				<ul class="checkout-choices" inputname="paymentID">
					<?php	
					$payments = $mb->_runFunction("cart", "paymentMethods", array());
					$num = 0;
					
					foreach($payments AS $payment)
					{
		 				if($payment['webshop'] == 0 || ($payment['maximum_amount'] > 0 && ($_SESSION['grand_total'] > $payment['maximum_amount'])))
						{
							continue;
						}
						
						$description = $payment['description'];
						
						if($payment[strtoupper(_LANGUAGE_PACK) . '_description'] != "")
						{
							$description = $payment[strtoupper(_LANGUAGE_PACK) . '_description'];
						}
						?>
						
						<li id="<?= $payment['paymentID'] ?>" <?= $num == 0 ? "class=\"first\"" : "" ?>>
							<div class="choice">
								<span class="fa fa-<?= (!isset($_SESSION['payment']) && $num == 0) || (isset($_SESSION['payment']) && $_SESSION['payment'] == $payment['paymentID']) ? "check active" : "circle" ?>"></span>
							</div>
							
							<div class="data">
								<strong><?= $payment['name'] ?>&nbsp;</strong>
								<small>
									<?= $description ?>
									
									<?php
									if($payment['agreements'] != "")
									{
										?>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&#187;&nbsp;<span click="<?= $payment['agreements'] ?>"><?= ucfirst($mb->_translateReturn("footer_menu", "terms_and_conditions")) ?> <?= ucfirst($payment['name']) ?></span>
										<?php
									}
									?>
								</small>
							</div>
						</li>
						
						<?php
						if	(
								$payment['required_dob'] == 1
								// || ADD MORE HERE
							)
						{
							?>
							<li class="extra-field extra-<?= $payment['paymentID'] ?>">
								<?php
								if($payment['required_dob'] == 1)
								{
									?>
									<?= $mb->_translateReturn("cart", "dob") ?>:<br/>
									<input type="text" name="dob" id="dob" value="" class="date-mask-field" />
									<?php
								}
								
								// ADD MORE HERE
								?>
							</li>
							<?php
						}
							
						$num++;
					}
					?>
				</ul>
			</div>
			
			<hr/>
			
			<div class="conditions">
				<a href="/<?= _LANGUAGE_PACK ?>/service/terms-and-conditions.html"><?= $mb->_translateReturn("cart", "conditions-check") ?></a>
			</div>
			
			<input type="submit" name="book_order" id="book_order" value="<?= $mb->_translateReturn("cart", "happy-book-order") ?>" class="right" style="background-color: <?= $mb->_translateReturn("colors", "main_color") ?> !important;" />
			<input type="button" name="return" id="return" value="<?= $mb->_translateReturn("cart", "return-to-shop") ?>" class="right white mobile-return" click="/<?= _LANGUAGE_PACK ?>/" />
		</form>
	</div>
	<?php
}
?>