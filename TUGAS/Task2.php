<?php

function printNumbers($n) {
    for ($i = 1; $i <= $n; $i++) {
        if ($i % 4 === 0 && $i % 6 === 0) {
            echo "Pemrograman Website 2024" . PHP_EOL;
        }
        elseif ($i % 5 === 0) {
            echo "2024" . PHP_EOL;
        }
        elseif ($i % 4 === 0) {
            echo "Pemrograman" . PHP_EOL;
        }
        elseif ($i % 6 === 0) {
            echo "Website" . PHP_EOL;
        }
        else {
            echo $i . PHP_EOL;
        }
    }
}

while (true) {
    echo "Masukkan bilangan bulat positif atau ketik 'exit' untuk keluar: ";
    $input = trim(fgets(STDIN));

    if (strtolower($input) === "exit") {
        echo "Program selesai." . PHP_EOL;
        break;
    }

    $n = intval($input);
    if ($n > 0) {
        printNumbers($n);
    } else {
        echo "Harap masukkan bilangan bulat positif." . PHP_EOL;
    }
}

?>
