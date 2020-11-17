<?php
/**
 * Parse a markdown string into HTML
 *
 * @param  string $input    The given markdown string
 * @return string           HTML output
 */
function markdown_parser ($input) {
    // Trim the input
    $input = trim($input);
    // Get first 6 chars
    $heading_chars = substr($input, 0, 6);
    // Define the heading type
    $heading_type = substr_count($heading_chars, '#');
    // Validate heading type
    if ($heading_type < 1) {
      return $input;
    }
    // Get all text after heading data
    $text = substr($input, $heading_type);

    return "<h".$heading_type.">".trim($text)."</h".$heading_type.">";
}

// Define our test cases
$test_cases = [
    "#### Lorem ipsum dolor sit amet, consectetur adipiscing elit" => "<h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h4>",
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit",
    "##Lorem ipsum dolor sit amet, consectetur adipiscing elit" => "<h2>Lorem ipsum dolor sit amet, consectetur adipiscing elit</h2>",
    "###Lorem ipsum dolor sit # amet, consectetur adipiscing elit" => "<h3>Lorem ipsum dolor sit # amet, consectetur adipiscing elit</h3>"
];
// Run test cases and display results
foreach ($test_cases as $test_case_input => $expected_outcome) {
    echo markdown_parser($test_case_input) == $expected_outcome ? 'Passed<br>' : '<b>Failed</b><br>';
}
