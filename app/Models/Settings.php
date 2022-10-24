<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 */
class Settings extends Model
{

    protected $table='settings';
    protected $guarded=[];

    public static function getSetting($key){
        $settings =  \Cache::rememberForever('settings',  function () {
            return Settings::first();
          });
        if(isset($settings->{$key})){
            return $settings->{$key};
        } else {
            return false;
        }
    }
}
