<?php

/**
 * Checks if the input contains only valid braces and scopes
 *
 * @param  string $input    Input given of the braces
 * @return boolean          If the input is valid
 */
function validBraces($input){
  $valid_scopes = [
      '()',
      '{}',
      '[]',
  ];
  return validateBraces($valid_scopes, $input);
}

/**
 * Removes valid braces from the given data
 * Repeats the function recursive until no valid braces are left
 *
 * @param  array $valid_scopes  Contains all the valid scopes
 * @param  string $data         Contains the remaining data string
 * @return boolean              Return true if the remaining string is empty
 */
function validateBraces($valid_scopes, $data)
{
    // Loop over the valid braces
    foreach ($valid_scopes as $valid_scope) {
        // Pop the valid scope from the data, if present
        $data = str_replace($valid_scope, '', $data);
    }
    // Set inital
    $has_remaining_scopes = false;
    // Loop once more after popping valid braces
    foreach ($valid_scopes as $valid_scope) {
        // Check if child scope(s) still remains
        if (strpos($data, $valid_scope) !== false) {
            $has_remaining_scopes = true;
        }
    }
    // Return recursive if we still have remaining child scope(s) left
    if ($has_remaining_scopes) {
        return validateBraces($valid_scopes, $data);
    }
    // The result is valid if the remaining string is empty
    return empty($data);
}

// Define test cases
$test_cases = [
    "()" => true,
    "[]" => true,
    "{}" => true,
    "(){}[]" => true,
    "([{}])" => true,
    "(}" => false,
    "[(])" => false,
    "({})[({})]" => true,
    "(})" => false,
    "(({{[]}}))" => true,
    "{}({})[]" => true,
    ")(}{][" => false,
    "()({}}{()][][" => false,
    "(((({{" => false,
    "}}]])}])" => false,
    "[({})](]" => false
];

// Run test cases trough the function
foreach ($test_cases as $test_case => $expected_outcome) {
    // Display the output
    echo validBraces($test_case) === $expected_outcome ? 'Passed<br>' : '<b>Failed</b><br>'; // true
}
