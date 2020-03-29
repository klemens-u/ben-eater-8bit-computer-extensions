<?php
// Creates a binary .bin file for EEPROM programmer
// Uses the same filename as the scriptname, but with .bin extension. E.g. 8x8display_create_binary.bin
// Call with "php 8x8display_create_binary.php"
// 
// Linux: use the xxd command to check the binary contents of the file:
// xxd -b -c 1 binarytest.bin
//
// 2020-02-28 klemens-u@k.ull.at
// 
// References:
// https://blog-en.openalfa.com/how-to-work-with-binary-data-in-php
// https://www.php.net/manual/en/function.pack.php

$array = [
  0b00000000,
  0b00000110,
  0b00011111,
  0b01111110,
  0b11111100,
  0b01111110,
  0b00011111,
  0b00000110,

  0b00000000,
  0b00000000,
  0b11111111,
  0b10001001,
  0b10001001,
  0b10001001,
  0b00000000,
  0b00000000,
];

// Get this filename
$scriptname = $_SERVER['argv'][0]; 

// Output to the same filename as the scriptname but with .bin extension
$path_parts = pathinfo($scriptname);
$fp = fopen($path_parts['filename'] . '.bin', 'wb'); // 'w' = write, 'b' = binary

foreach ($array as $value) {
    // Assign a binary byte to a variable
    $data = pack("C*", $value);
 
    // Write the byte to the file
    fwrite($fp, $data);
}
fclose($fp);
