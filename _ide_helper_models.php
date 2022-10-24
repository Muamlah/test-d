<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @mixin \Eloquent
 * @property string|null $access_life_time
 * @property string|null $phone
 * @property string|null $second_password
 * @property string|null $user_type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|Admin permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereAccessLifeTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereSecondPassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUserType($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\BalanceRequest
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property float|null $amount
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string|null $description
 * @property string|null $ref
 * @property string|null $file
 * @property-read \App\Models\CreditCard $credit
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereRef($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BalanceRequest whereUserId($value)
 */
	class BalanceRequest extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletMuamlah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $bank_name
 * @property string|null $number
 * @property string|null $beneficiary_name
 * @property string|null $account_number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereBeneficiaryName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BankAccount whereUserId($value)
 */
	class BankAccount extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChatbotMessage
 *
 * @property int $id
 * @property string $chatId
 * @property int $user_id
 * @property string $type
 * @property string $message
 * @property string $file
 * @property string $response
 * @property string $status
 * @property string $sent_at
 * @property string $delivered_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereChatId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereDeliveredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotMessage whereUserId($value)
 * @mixin \Eloquent
 */
	class ChatbotMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChatbotSession
 *
 * @property int $id
 * @property string $chatID
 * @property string $type
 * @property string $message
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereChatID($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatbotSession whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ChatbotSession extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Config
 *
 * @property int $id
 * @property string $key
 * @property string $val
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Config newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Config query()
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Config whereVal($value)
 * @mixin \Eloquent
 */
	class Config extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Coupon
 *
 * @property int $id
 * @property string|null $code
 * @property string $type
 * @property int|null $instances_count
 * @property int $number_of_use
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $discount
 * @property int|null $owner_id
 * @property string|null $owner_discount
 * @property int|null $max_discount
 * @property string $discount_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CouponInstance[] $Instances
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon query()
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereInstancesCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereNumberOfUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Coupon whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Coupon extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CouponInstance
 *
 * @property int $id
 * @property int|null $user_id
 * @property int $coupon_id
 * @property string|null $code
 * @property string $type
 * @property int $number_of_use
 * @property string $start_date
 * @property string|null $end_date
 * @property string|null $discount
 * @property int|null $owner_id
 * @property string|null $owner_discount
 * @property int|null $max_discount
 * @property string $discount_type
 * @property string|null $amount
 * @property int|null $entity_id
 * @property string|null $entity_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $owner
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance query()
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCouponId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereDiscountType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereMaxDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereNumberOfUse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereOwnerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CouponInstance whereUserId($value)
 * @mixin \Eloquent
 */
	class CouponInstance extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $bank_name
 * @property string $name
 * @property string|null $email
 * @property string $account_number
 * @property string|null $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard query()
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereAccountNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereBankName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CreditCard whereUserId($value)
 * @mixin \Eloquent
 */
	class CreditCard extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Faq
 *
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $type
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Faq whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Favorite
 *
 * @property int $user_id
 * @property string $favoriteable_type
 * @property int $favoriteable_id
 * @property-read \App\Models\User|null $provider
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoriteableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereFavoriteableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Favorite whereUserId($value)
 * @mixin \Eloquent
 */
	class Favorite extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property float $client_platform_fee
 * @property float $client_less_than_3300
 * @property float $client_less_than_1000
 * @property float $client_cancellation
 * @property float $offer_platform_fee
 * @property float $offer_cancellation
 * @property float $service_platform_fee
 * @property float $service_client_fees
 * @property float $service_cancellation
 * @property float $value_added_tax
 * @property float $payment_gateway_fee
 * @property float $payment_gateway_cancellation_fee
 * @property float $payment_gateway_refunded
 * @property string $bank_fees
 * @property float $bank_cancellation_fee
 * @property float $bank_refunded
 * @property float $staff_commission
 * @property float $marketers_commission
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Fees newModelQuery()
 * @method static Builder|Fees newQuery()
 * @method static Builder|Fees query()
 * @mixin \Eloquent
 * @property float $public_order_platform_fee
 * @property float $public_order_cancellation
 * @property float $public_order_added_tax
 * @property float $public_order_less_than_3300
 * @property float $public_order_less_than_1000
 * @property float $offer_less_than_3300
 * @property float $offer_added_tax
 * @property float|null $offer_less_than_1000
 * @method static Builder|Fees whereBankCancellationFee($value)
 * @method static Builder|Fees whereBankFees($value)
 * @method static Builder|Fees whereBankRefunded($value)
 * @method static Builder|Fees whereClientCancellation($value)
 * @method static Builder|Fees whereClientLessThan1000($value)
 * @method static Builder|Fees whereClientLessThan3300($value)
 * @method static Builder|Fees whereClientPlatformFee($value)
 * @method static Builder|Fees whereCreatedAt($value)
 * @method static Builder|Fees whereId($value)
 * @method static Builder|Fees whereMarketersCommission($value)
 * @method static Builder|Fees whereOfferAddedTax($value)
 * @method static Builder|Fees whereOfferCancellation($value)
 * @method static Builder|Fees whereOfferLessThan1000($value)
 * @method static Builder|Fees whereOfferLessThan3300($value)
 * @method static Builder|Fees whereOfferPlatformFee($value)
 * @method static Builder|Fees wherePaymentGatewayCancellationFee($value)
 * @method static Builder|Fees wherePaymentGatewayFee($value)
 * @method static Builder|Fees wherePaymentGatewayRefunded($value)
 * @method static Builder|Fees wherePublicOrderAddedTax($value)
 * @method static Builder|Fees wherePublicOrderCancellation($value)
 * @method static Builder|Fees wherePublicOrderLessThan1000($value)
 * @method static Builder|Fees wherePublicOrderLessThan3300($value)
 * @method static Builder|Fees wherePublicOrderPlatformFee($value)
 * @method static Builder|Fees whereServiceCancellation($value)
 * @method static Builder|Fees whereServiceClientFees($value)
 * @method static Builder|Fees whereServicePlatformFee($value)
 * @method static Builder|Fees whereStaffCommission($value)
 * @method static Builder|Fees whereUpdatedAt($value)
 * @method static Builder|Fees whereValueAddedTax($value)
 */
	class Fees extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FirebaseToken
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $token
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $eservices_orders_notifications
 * @property string $public_private_orders_notifications
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken query()
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereEservicesOrdersNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken wherePublicPrivateOrdersNotifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FirebaseToken whereUserId($value)
 * @mixin \Eloquent
 */
	class FirebaseToken extends \Eloquent {}
}

namespace App\Models{
/**
 * Class FollowingOrder
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $master_order
 * @property int|null $parent_order
 * @property int|null $main_order_id
 * @property string $user_phone
 * @property string $service_provider_phone
 * @property string $duration
 * @property string $price
 * @property string $details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder query()
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereMainOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereServiceProviderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FollowingOrder whereUserPhone($value)
 */
	class FollowingOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord query()
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ForbiddenWord whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ForbiddenWord extends \Eloquent {}
}

namespace App\Models{
/**
 * Class CreditCard
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $order_id
 * @property string $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read eservices_orders|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoices whereUserId($value)
 * @mixin \Eloquent
 */
	class Invoices extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Log
 *
 * @property int $id
 * @property int|null $admin_id
 * @property string|null $admin_name
 * @property string|null $admin_email
 * @property string|null $action
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Log newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Log query()
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereAdminEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereAdminName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Log whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Log extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $user_id2
 * @property int|null $admin_id
 * @property string|null $name
 * @property string|null $email
 * @property string $subject
 * @property string $message
 * @property int|null $parent_id
 * @property string|null $seen
 * @property string|null $file
 * @property int|null $entity_id
 * @property string|null $entity_type
 * @property string|null $reply_at
 * @property string|null $reply
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $seen_by_admin
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Admin[] $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Message[] $children
 * @property-read int|null $children_count
 * @property-read Message|null $parent
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Message chatUsers($user_id)
 * @method static \Illuminate\Database\Eloquent\Builder|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereAdminId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEntityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereEntityType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReply($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereReplyAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSeenByAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Message whereUserId2($value)
 * @mixin \Eloquent
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderLog
 *
 * @package App\Models
 * @property int $id
 * @property int $order_id
 * @property float|null $fees
 * @property float|null $provider_fees
 * @property float|null $price
 * @property float|null $value_added_tax
 * @property float|null $provider_value_added_tax
 * @property float|null $total_amount
 * @property float|null $provider_total_amount
 * @property float|null $deserved_price
 * @property float|null $diff_amount
 * @property string|null $provider_discount
 * @property string|null $amount
 * @property string|null $payment_gateway_checkout_data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereDiffAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrderLog whereValueAddedTax($value)
 * @mixin \Eloquent
 */
	class OrderLog extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderService
 *
 * @package App\Models
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrderService query()
 * @mixin \Eloquent
 */
	class OrderService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Page
 *
 * @property int $id
 * @property string|null $image
 * @property string $title
 * @property string|null $details
 * @property string $type
 * @property string|null $key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $category
 * @property string|null $base_type
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereBaseType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PaymentMathod
 *
 * @property int $id
 * @property string|null $payment_gateway_type
 * @property string|null $payment_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\eservices_orders|null $eserviceOrder
 * @property-read \App\Models\PrivateOrder|null $privateOrder
 * @property-read \App\Models\PublicOrder|null $publicOrder
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod query()
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod wherePaymentDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod wherePaymentGatewayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PaymentMathod whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class PaymentMathod extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property int $master_order
 * @property int $parent_order
 * @property int $user_phone
 * @property int $service_provider_phone
 * @property float $price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float|null $payment_gateway_fee
 * @property string $details
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string $pay_status
 * @property string $status
 * @property string $cancellation
 * @property string $verify
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder query()
 * @mixin \Eloquent
 * @property int|null $instance_id
 * @property string|null $agent_id
 * @property int|null $status_id
 * @property int|null $provider_id
 * @property float|null $deserved_price
 * @property string $deadline
 * @property float $proposed_value
 * @property string|null $verify_code
 * @property float|null $payable_service_provider
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $edit_details
 * @property string|null $edit_deadline
 * @property float|null $edit_price
 * @property int|null $payment_mathod_id
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property string|null $update_price
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \Illuminate\Database\Eloquent\Collection|PrivateOrder[] $followingOrders
 * @property-read int|null $following_orders_count
 * @property-read \App\Models\PrivateOrderInstance|null $instance
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrderInstance[] $instanceOrders
 * @property-read int|null $instance_orders_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $providerById
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereEditPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereInstanceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProposedValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereServiceProviderPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUpdatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereUserPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrder whereVerifyCode($value)
 */
	class PrivateOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PrivateOrderInstance
 *
 * @property int $id
 * @property int $order_id
 * @property float $price
 * @property float|null $deserved_price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float $payable_service_provider
 * @property float|null $payment_gateway_fee
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $payment_gateway_checkout_data
 * @property int|null $payment_status
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $update_price
 * @property-read \App\Models\PrivateOrder|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance query()
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereUpdatePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PrivateOrderInstance whereValueAddedTax($value)
 * @mixin \Eloquent
 */
	class PrivateOrderInstance extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property string $details
 * @property int $status
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder query()
 * @mixin \Eloquent
 * @property string|null $agent_id
 * @property string $title
 * @property float|null $price
 * @property float|null $deserved_price
 * @property float|null $fees
 * @property float|null $total_amount
 * @property float|null $client_cancellation
 * @property float|null $value_added_tax
 * @property float|null $payment_gateway_fee
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string|null $deadline
 * @property int|null $provider_id
 * @property int|null $verify_code
 * @property string $pay_status
 * @property int $master_order
 * @property int $parent_order
 * @property string $cancellation
 * @property int|null $payment_mathod_id
 * @property string|null $verify
 * @property float|null $payable_service_provider
 * @property float|null $provider_fees
 * @property float|null $provider_value_added_tax
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \Illuminate\Database\Eloquent\Collection|PublicOrder[] $followingOrders
 * @property-read int|null $following_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|PublicOrder[] $followingOrdersMaster
 * @property-read int|null $following_orders_master_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrderOffer[] $offers
 * @property-read int|null $offers_count
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $provider
 * @property-read \App\Models\Status|null $st
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereMasterOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereParentOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePayableServiceProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrder whereVerifyCode($value)
 */
	class PublicOrder extends \Eloquent {}
}

namespace App\Models{
/**
 * Class OrderFees
 *
 * @package App\Models
 * @property int $id
 * @property int $user_id
 * @property float $price
 * @property int $duration
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $provider
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer query()
 * @mixin \Eloquent
 * @property int $order_id
 * @property \Illuminate\Support\Carbon|null $deadline
 * @property string|null $time
 * @property string|null $date
 * @property float|null $tax_amount
 * @property float|null $fees
 * @property float|null $deserved_price
 * @property float|null $value_added_tax
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\PublicOrder $order
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereTaxAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicOrderOffer whereValueAddedTax($value)
 */
	class PublicOrderOffer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $user_id
 * @property int $provider_id
 * @property int $order_id
 * @property string $order_type
 * @property float $quality_of_service
 * @property float $execution_speed
 * @property float $professionalism_in_dealing
 * @property float $communication
 * @property float $deal_with_him_again
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCommunication($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereDealWithHimAgain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereExecutionSpeed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProfessionalismInDealing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereQualityOfService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Review whereUserId($value)
 * @mixin \Eloquent
 */
	class Review extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SearchedWord
 *
 * @property int $id
 * @property string $word
 * @property int $count
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord query()
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SearchedWord whereWord($value)
 * @mixin \Eloquent
 */
	class SearchedWord extends \Eloquent {}
}

namespace App\Models{
/**
 * Class Settings
 *
 * @package App\Models
 * @property int $id
 * @property string|null $sitename
 * @property string|null $sitemail
 * @property string|null $siteurl
 * @property string|null $	active_posts
 * @property string|null $active_users
 * @property string|null $active_comment
 * @property string|null $status_site
 * @property string|null $payment
 * @property int|null $profit
 * @property string|null $status_message
 * @property string|null $contact_us_info
 * @property string|null $keywords
 * @property string|null $discription
 * @property string|null $test_secret_key
 * @property string|null $test_publish_key
 * @property string|null $live_secret_key
 * @property string|null $live_publish_key
 * @property int|null $active_offer
 * @property int|null $vat
 * @property int|null $services_limit
 * @property string|null $logo
 * @property string|null $icon
 * @property string|null $signature
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @mixin \Eloquent
 * @property string|null $	active_posts
 * @property string|null $active_order
 * @property float|null $order_price_limit
 * @property float|null $private_order_limit
 * @property float|null $electronic_order_limit
 * @property float|null $public_order_limit
 * @property float|null $offers_public_order_limit
 * @property float|null $electronic_order_provider_limit
 * @property string|null $script_google_analytics
 * @property string|null $iframe_google_analytics
 * @property string|null $eservices_orders_status
 * @property string|null $public_orders_status
 * @property string|null $private_orders_status
 * @property string|null $payment_gateway_type
 * @property int|null $production
 * @property string|null $reference_code_discount_for_owner
 * @property string|null $reference_code_discount_for_user
 * @property string|null $eservice_time
 * @property string|null $public_order_time
 * @property string|null $agent_per
 * @property string|null $email
 * @method static \Illuminate\Database\Eloquent\Builder|Settings where	activePosts($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereActiveComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereActiveOffer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereActiveOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereActiveUsers($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereContactUsInfo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereDiscription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereElectronicOrderLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereElectronicOrderProviderLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereEserviceTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereEservicesOrdersStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereIframeGoogleAnalytics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereLivePublishKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereLiveSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereOffersPublicOrderLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereOrderPriceLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePaymentGatewayType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePrivateOrderLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePrivateOrdersStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereProduction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereProfit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePublicOrderLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePublicOrderTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePublicOrdersStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereReferenceCodeDiscountForOwner($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereReferenceCodeDiscountForUser($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereScriptGoogleAnalytics($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereServicesLimit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSignature($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSitemail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSitename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereSiteurl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereStatusMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereStatusSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereTestPublishKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereTestSecretKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereVat($value)
 * @property string|null $	active_posts
 * @method static \Illuminate\Database\Eloquent\Builder|Settings where	activePosts($value)
 */
	class Settings extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletMuamlah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Status newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Status query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $status
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Status whereUpdatedAt($value)
 */
	class Status extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletMuamlah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction query()
 * @mixin \Eloquent
 * @property int|mixed user_id
 * @property mixed|string type
 * @property int|mixed order_id
 * @property mixed description
 * @property float|mixed amount
 * @property int|mixed order_type
 * @property int $id
 * @property int $user_id
 * @property int|null $order_id
 * @property string|null $order_type
 * @property float|null $amount
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Transaction whereUserId($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $logo
 * @property string|null $name
 * @property string $phone
 * @property string|null $email
 * @property string|null $password
 * @property int|null $city
 * @property string|null $level
 * @property string|null $api_token
 * @property int $active
 * @property string|null $verification_code
 * @property \Illuminate\Support\Carbon|null $phone_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property mixed $available_balance
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @mixin \Eloquent
 * @property string|null $full_name
 * @property string|null $reference_code
 * @property string|null $file
 * @property string|null $address
 * @property string|null $nationality
 * @property string|null $is_agent
 * @property string|null $in_review
 * @property float $total_balance
 * @property float $pinding_balance
 * @property string $status
 * @property string|null $image
 * @property string|null $commercial_register
 * @property string|null $bio
 * @property string|null $work_status
 * @property int $verified
 * @property string|null $activation_type
 * @property string|null $email_code
 * @property string|null $phone_code
 * @property string|null $v_code
 * @property int|null $agent_id
 * @property string|null $balance_withdrawal
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $linkedin
 * @property string|null $twitter
 * @property string|null $whatsapp
 * @property string|null $added_to_zoho
 * @property string|null $zoho_response_code
 * @property string|null $zoho_response
 * @property-read User|null $Agent
 * @property-read \Illuminate\Database\Eloquent\Collection|User[] $AgentUsers
 * @property-read int|null $agent_users_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $Transactions
 * @property-read int|null $transactions_count
 * @property-read BankAccount|null $bank
 * @property-read \App\Models\Coupon|null $coupon
 * @property-read CreditCard|null $creditCard
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\eservices_orders[] $eservicesOrders
 * @property-read int|null $eservices_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\eservices_orders[] $eservicesOrdersReport
 * @property-read int|null $eservices_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrder[] $privateOrders
 * @property-read int|null $private_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PrivateOrder[] $privateOrdersReport
 * @property-read int|null $private_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrder[] $publicOrders
 * @property-read int|null $public_orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PublicOrder[] $publicOrdersReport
 * @property-read int|null $public_orders_report_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Review[] $reviews
 * @property-read int|null $reviews_count
 * @property-read \Illuminate\Database\Eloquent\Collection|eservices[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FirebaseToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActivationType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddedToZoho($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvailableBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBalanceWithdrawal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCommercialRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLinkedin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereNationality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePindingBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTotalBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerificationCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWhatsapp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWorkStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZohoResponse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereZohoResponseCode($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserLog
 *
 * @property int $id
 * @property int|null $user_id
 * @property string|null $user_name
 * @property string|null $user_email
 * @property string|null $price
 * @property string|null $action
 * @property string|null $description
 * @property string|null $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserLog whereUserName($value)
 * @mixin \Eloquent
 */
	class UserLog extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WalletMuamlah
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah query()
 * @mixin \Eloquent
 * @property int $id
 * @property int|null $order_id
 * @property string|null $order_type
 * @property float|null $amount
 * @property float|null $balance
 * @property string $type
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PrivateOrder|null $order
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereOrderType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WalletMuamlah whereUpdatedAt($value)
 */
	class WalletMuamlah extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WpAbusmoApplications
 *
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WpAbusmoApplications query()
 * @mixin \Eloquent
 */
	class WpAbusmoApplications extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\eservices
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $img
 * @property string $service_name
 * @property string $details
 * @property int $price
 * @property string $status
 * @property string $section_id
 * @property string $how_do
 * @property int|null $views
 * @property int|null $shares
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $customers
 * @property-read int|null $customers_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $providers
 * @property-read int|null $providers_count
 * @property-read \App\Models\sections|null $sections
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|eservices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices query()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereHowDo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereServiceName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereShares($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices whereViews($value)
 * @mixin \Eloquent
 */
	class eservices extends \Eloquent {}
}

namespace App\Models{
/**
 * Class eservices_orders
 *
 * @package App\Models
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $eservice_id
 * @property int $user_id
 * @property string|null $agent_id
 * @property int $provider_id
 * @property string $details
 * @property float $fees
 * @property float $value_added_tax
 * @property float $total_amount
 * @property float $price
 * @property float $deserved_price
 * @property string|null $verify_code
 * @property int $status
 * @property string $pay_status
 * @property int $payment_gateway_fee
 * @property string|null $payment_gateway_checkout_data
 * @property string|null $payment_status
 * @property string $client_cancellation
 * @property int $verify
 * @property float $provider_total_amount
 * @property float $provider_fees
 * @property float $provider_value_added_tax
 * @property int|null $payment_mathod_id
 * @property string|null $reference_code
 * @property string|null $owner_discount
 * @property string|null $user_discount
 * @property string|null $order_log
 * @property string|null $agent_per
 * @property string|null $cancel_reason
 * @property string|null $invoice_code
 * @property-read \App\Models\User|null $agent
 * @property-read \App\Models\CouponInstance|null $coupone_instance
 * @property-read \App\Models\eservices|null $eservices
 * @property-read \App\Models\PaymentMathod|null $paymentMathod
 * @property-read \App\Models\User|null $provider
 * @property-read \App\Models\User|null $providers
 * @property-read \App\Models\User $user
 * @property-read \App\Models\User $users
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WalletMuamlah[] $wallets
 * @property-read int|null $wallets_count
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders query()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders userOrAgent()
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereAgentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereAgentPer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereCancelReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereClientCancellation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereDeservedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereEserviceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereInvoiceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereOrderLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereOwnerDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePayStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentGatewayCheckoutData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentGatewayFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentMathodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePaymentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderFees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereProviderValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereReferenceCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereTotalAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUserDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereValueAddedTax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereVerify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|eservices_orders whereVerifyCode($value)
 * @mixin \Eloquent
 */
	class eservices_orders extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\sections
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $name
 * @property string $img
 * @method static \Illuminate\Database\Eloquent\Builder|sections newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|sections query()
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|sections whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class sections extends \Eloquent {}
}

