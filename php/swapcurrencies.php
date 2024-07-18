<?php 
/**
 * Swaps the values of two variables.
 * $fromCurrencySelect The value to be swapped from the first variable.
 * $toCurrencySelect The value to be swapped from the second variable.
 */
function swapCurrencies($fromCurrencySelect, $toCurrencySelect) {
    // Store the value of $fromCurrencySelect in a temporary variable.
    $tempValue = $fromCurrencySelect;
    
    // Assign the value of $toCurrencySelect to $fromCurrencySelect.
    $fromCurrencySelect = $toCurrencySelect;
    
    // Assign the value of $tempValue to $toCurrencySelect.
    $toCurrencySelect = $tempValue;
}

