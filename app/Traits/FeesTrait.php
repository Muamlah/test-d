<?php

namespace App\Traits;

use App\Models\Fees;

/**
 * Trait GrupoTrait
 * @package App\Traits
 */
trait FeesTrait
{
    private function CalculateFees($price)
    {
        $fees = Fees::first();

        if ($price >= 3300) {
            $fees['fee'] = $price * ($fees->client_platform_fee / 100); // 0.035
            $fees['offer_fee'] =  $price * ($fees->offer_platform_fee / 100);

        }

        if ($price < 3300 && $price >= 1000) {
            $fees['fee'] = $fees->client_less_than_3300;
        }

        if ($price < 1000) {
            $fees['fee'] = $fees->client_less_than_1000;
        }

        $fees['client_cancellation'] = $fees->client_cancellation;
        $fees['value_added_tax'] = $fees->value_added_tax;
        $fees['tax_amount'] = ($fees->value_added_tax /100) * $fees['fee'] ;
        $fees['payment_gateway_fee'] = $fees->payment_gateway_fee;

        return $fees;

    }


    private function CalculatePublicOrderFees($price)
    {
        $fees = Fees::first();
        if ($price >= 3300) {
            $feesPublic['order_fee'] = $price * ($fees->public_order_platform_fee / 100); // 1000*3.5 / 100 = 30.5
            $feesPublic['order_added_tax'] = ($feesPublic['order_fee'] * $fees->public_order_added_tax)/100 ; // 30.5 * 15 /100

            $feesPublic['offer_fee'] =  $price * ($fees->offer_platform_fee / 100);
            $feesPublic['offer_added_tax'] =  ($feesPublic['offer_fee'] * $fees->offer_added_tax)/100;
        }

        if ($price < 3300 && $price >= 1000) {
            $feesPublic['order_fee'] = $fees->public_order_less_than_3300;
            $feesPublic['order_added_tax'] = $fees->public_order_less_than_3300 * ($fees->public_order_added_tax/100);
            $feesPublic['offer_fee'] = $fees->offer_less_than_3300;
            $feesPublic['offer_added_tax'] = $fees->offer_less_than_3300 * ($fees->offer_added_tax/100);
        }

        if ($price < 1000) {
            $feesPublic['order_fee'] = $fees->public_order_less_than_1000;
            $feesPublic['order_added_tax'] = $fees->public_order_less_than_1000 * ($fees->public_order_added_tax/100);

            $feesPublic['offer_fee'] = $fees->offer_less_than_1000;
            $feesPublic['offer_added_tax'] = $fees->offer_less_than_1000 * ($fees->offer_added_tax/100);
        }

        $feesPublic['payment_gateway_fee'] = $fees->payment_gateway_fee;

        return $feesPublic;
    }

    private function CalculateServicesFees($price)
    {
        $fees = Fees::first();
            $fee['order_fee'] = $price * ($fees->service_client_fees / 100); // 1000*3.5 / 100 = 30.5
            $fee['order_added_tax'] = ($fee['order_fee'] * $fees->value_added_tax)/100 ; // 30.5 * 15 /100

            $fee['offer_fee'] =  $price * ($fees->service_platform_fee / 100);
            $fee['offer_added_tax'] =  ($fee['offer_fee'] * $fees->value_added_tax)/100;


        $fee['payment_gateway_fee'] = $fees->payment_gateway_fee;

        return $fee;
    }





}
