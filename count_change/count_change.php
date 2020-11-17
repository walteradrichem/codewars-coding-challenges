<?php

/**
 * Get all combinations of the given money and coins. Gets all combinations of payment with the money and coins given
 *
 * @param  int $money       Amount of money available
 * @param  array $coins     Type of coins available
 * @return int
 */
function countChange($money, $coins) {
    // Get all combinations
    $coin_combinations = getCoinCombinations($money, $coins, 0, []);
    // Count the results
    $result_count = count($coin_combinations);
    // DEBUGGING - SHOW OUTCOME
    echo $result_count.' combinations available<br>';

    if ($result_count > 0) {
        // Print all combinations for debugging purposes
        foreach ($coin_combinations as $coin_combination) {
            echo implode('+', $coin_combination).'<br>';
        }
    }

    // Return the amount of results
    return $result_count;
}
/**
 * Recursive function to get all combinations with the given parameters
 *
 * @param  int $money                   Amount of money available
 * @param  array $coins                 Type of coins available
 * @param  int $index                   Current index of coin
 * @param  array $current_combination   Current combination stored
 * @return array
 */
function getCoinCombinations($money, $coins, $index, $current_combination) {
    // Validate amount of money and index
    if ($money < 0 || !isset($coins[$index])) {
        return [];
    }
    // Current combination is valid
    if ($money == 0) {
        return [$current_combination];
    }
    // Add the coin to the combinations list
    $new_combination = array_merge(
        $current_combination,
        [$coins[$index]]
    );
    // Call recursive current coin with the remaining money and new combination
    $current_coin_combinations = getCoinCombinations(
        $money - $coins[$index],
        $coins,
        $index,
        $new_combination
    );
    // Try getting more combinations with the next coin(s) and current combination
    $next_coin_combinations = getCoinCombinations(
        $money,
        $coins,
        $index + 1,
        $current_combination
    );

    return array_merge(
        $current_coin_combinations,
        $next_coin_combinations
    );
}

// Define test cases
$test_cases = [
    ['money' => 4, 'coins' => [1,2], 'expected_outcome' => 3],
    ['money' => 10, 'coins' => [5,2,3], 'expected_outcome' => 4],
    ['money' => 11, 'coins' => [5,7], 'expected_outcome' => 0],
    ['money' => 31, 'coins' => [3,6,7], 'expected_outcome' => 6]
];
// Run test cases and display the outcome
foreach ($test_cases as $test_case) {
    echo countChange($test_case['money'], $test_case['coins']) === $test_case['expected_outcome'] ? '<b>Passed</b><br><br>' : '<b>Failed</b><br><br>'; // true
}
