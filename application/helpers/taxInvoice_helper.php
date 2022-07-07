<?php
// Helper function used to do the invoice calculation
function calculateItemTotals($quantityArray, $unitPriceArray, $tax, $discount, $discountType) {
    $totalPriceArray = array();
    $subTotalWithoutTax = 0;
    $grandTotal = 0;
    foreach($quantityArray as $quantityKey => $quantity) {
        $totalPriceValue = $quantity * $unitPriceArray[$quantityKey];
        $subTotalWithoutTax = $subTotalWithoutTax + $totalPriceValue;
        array_push($totalPriceArray, $totalPriceValue);
    }
    $totalPrice = implode("|", $totalPriceArray);

    if($tax <= 0) {
        $subTotalWithTax = $subTotalWithoutTax;
    } else {
        $taxAmount = ($subTotalWithoutTax/100) * $tax; 
        $subTotalWithTax = $subTotalWithoutTax + $taxAmount;
    }

    if($discountType == "amount") {
        $discountAmount = $discount;
        $grandTotal = $subTotalWithTax - $discountAmount;
    } else {
        $discountAmount = ($subTotalWithTax/100) * $discount;
        $grandTotal = $subTotalWithTax - $discountAmount;
    }

    $result = array(
        "totalPrice" => $totalPrice,
        "taxAmount" => $taxAmount,
        "subTotalWithoutTax" => $subTotalWithoutTax,
        "subTotalWithTax" => $subTotalWithTax,
        "discount" => $discountAmount,
        "grandTotal" => $grandTotal
    );
    return $result;
}
?>